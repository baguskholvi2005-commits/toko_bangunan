<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::with('user')
            ->when(request('user_id'), fn($q) => $q->where('user_id', request('user_id')))
            ->when(request('action'), fn($q) => $q->where('action', request('action')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $users = User::orderBy('name')->get();

        return view('activity-logs.index', compact('logs', 'users'));
    }
}