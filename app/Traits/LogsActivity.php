<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    public static function bootLogsActivity(): void
    {
        static::created(function ($model) {
            $model->recordActivity('created', 'dibuat');
        });

        static::updated(function ($model) {
            $changes = collect($model->getChanges())->except(['updated_at'])->all();
            if (empty($changes)) {
                return;
            }
            $old = collect($model->getOriginal())->only(array_keys($changes))->all();
            $model->recordActivity('updated', 'diperbarui', $changes, $old);
        });

        static::deleted(function ($model) {
            $model->recordActivity('deleted', 'dihapus');
        });
    }

    protected function recordActivity(string $action, string $verb, ?array $newValues = null, ?array $oldValues = null): void
    {
        $label = $this->name ?? $this->invoice_number ?? $this->opname_number ?? ('#'.$this->id);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'subject_type' => static::class,
            'subject_id' => $this->id,
            'description' => class_basename($this)." \"{$label}\" {$verb}",
            'properties' => $newValues ? ['old' => $oldValues, 'new' => $newValues] : null,
            'ip_address' => request()?->ip(),
        ]);
    }
}