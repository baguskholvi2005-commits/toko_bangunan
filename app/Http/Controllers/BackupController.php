<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class BackupController extends Controller
{
    public function index()
    {
        $path = storage_path('app/backups');
        $files = [];

        if (is_dir($path)) {
            foreach (glob($path.'/*.sql') as $file) {
                $files[] = [
                    'name' => basename($file),
                    'size' => round(filesize($file) / 1024, 1).' KB',
                    'date' => date('d/m/Y H:i', filemtime($file)),
                ];
            }
            usort($files, fn($a, $b) => strcmp($b['date'], $a['date']));
        }

        return view('backups.index', compact('files'));
    }

    public function create()
    {
        $path = storage_path('app/backups');
        if (! is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $filename = 'backup-'.now()->format('Ymd_His').'.sql';
        $fullPath = $path.DIRECTORY_SEPARATOR.$filename;

        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');

        $mysqldump = env('DB_BACKUP_MYSQLDUMP_PATH', 'mysqldump');

        $command = sprintf(
            '%s -h %s -u %s %s --protocol=TCP %s > %s',
            escapeshellarg($mysqldump),
            escapeshellarg($host),
            escapeshellarg($username),
            $password ? '-p'.escapeshellarg($password) : '',
            escapeshellarg($database),
            escapeshellarg($fullPath)
        );

        $process = Process::fromShellCommandline($command);
        $process->setTimeout(300);

        // Wariskan environment variable penting Windows secara eksplisit,
        // supaya Winsock bisa diinisialisasi dengan benar oleh proses anak (mysqldump.exe)
        $process->setEnv([
            'SystemRoot' => getenv('SystemRoot') ?: 'C:\\Windows',
            'windir' => getenv('windir') ?: 'C:\\Windows',
            'PATH' => getenv('PATH'),
            'TEMP' => getenv('TEMP'),
            'TMP' => getenv('TMP'),
        ]);

        $process->run();

        if (! $process->isSuccessful() || ! file_exists($fullPath) || filesize($fullPath) === 0) {
            if (file_exists($fullPath) && filesize($fullPath) === 0) {
                unlink($fullPath); // bersihkan file kosong kalau gagal
            }
            return back()->with('error', 'Backup gagal: '.$process->getErrorOutput());
        }

        return back()->with('success', 'Backup berhasil dibuat: '.$filename);
    }

    public function download(string $filename)
    {
        $path = storage_path('app/backups/'.basename($filename));
        abort_unless(file_exists($path), 404);

        return response()->download($path);
    }

    public function destroy(string $filename)
    {
        $path = storage_path('app/backups/'.basename($filename));

        if (file_exists($path)) {
            unlink($path);
            return back()->with('success', 'File backup berhasil dihapus.');
        }

        return back()->with('error', 'File backup tidak ditemukan.');
    }

    public function restore(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file|max:51200', // maks 50MB
        ]);

        $tempPath = $request->file('backup_file')->store('backups/temp');
        $fullTempPath = storage_path('app/'.$tempPath);

        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');

        $mysql = env('DB_BACKUP_MYSQL_PATH', 'mysql');

        $command = sprintf(
            '%s -h %s -u %s %s --protocol=TCP %s < %s',
            escapeshellarg($mysql),
            escapeshellarg($host),
            escapeshellarg($username),
            $password ? '-p'.escapeshellarg($password) : '',
            escapeshellarg($database),
            escapeshellarg($fullTempPath)
        );

        $process = Process::fromShellCommandline($command);
        $process->setTimeout(300);

        $process->setEnv([
            'SystemRoot' => getenv('SystemRoot') ?: 'C:\\Windows',
            'windir' => getenv('windir') ?: 'C:\\Windows',
            'PATH' => getenv('PATH'),
            'TEMP' => getenv('TEMP'),
            'TMP' => getenv('TMP'),
        ]);

        $process->run();

        Storage::delete($tempPath);

        if (! $process->isSuccessful()) {
            return back()->with('error', 'Restore gagal: '.$process->getErrorOutput());
        }

        return back()->with('success', 'Database berhasil di-restore dari file backup.');
    }
}