<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Form;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Display activity logs for all forms
     */
    public function index(Request $request)
    {
        $query = ActivityLog::with(['subject', 'causer'])
            ->orderBy('created_at', 'desc');

        // Filter by log name if provided
        if ($request->has('log_name') && $request->log_name) {
            $query->where('log_name', $request->log_name);
        }

        // Filter by event if provided
        if ($request->has('event') && $request->event) {
            $query->where('event', $request->event);
        }

        // Filter by date range if provided
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $logs = $query->paginate(20);

        return view('activity-logs.index', compact('logs'));
    }

    /**
     * Display activity logs for a specific form
     */
    public function form(Form $form, Request $request)
    {
        $query = ActivityLog::with(['subject', 'causer'])
            ->where(function($q) use ($form) {
                $q->where('subject_type', Form::class)
                  ->where('subject_id', $form->id)
                  ->orWhere('properties->form_name', $form->name);
            })
            ->orderBy('created_at', 'desc');

        // Filter by event if provided
        if ($request->has('event') && $request->event) {
            $query->where('event', $request->event);
        }

        $logs = $query->paginate(20);

        return view('activity-logs.form', compact('logs', 'form'));
    }

    /**
     * Get activity statistics
     */
    public function stats(Request $request)
    {
        $stats = [
            'total_activities' => ActivityLog::count(),
            'form_activities' => ActivityLog::where('log_name', 'form')->count(),
            'submission_activities' => ActivityLog::where('log_name', 'submission')->count(),
            'field_activities' => ActivityLog::where('log_name', 'field')->count(),
            'recent_submissions' => ActivityLog::where('log_name', 'submission')
                ->where('created_at', '>=', now()->subDays(7))
                ->count(),
            'most_active_forms' => ActivityLog::where('log_name', 'submission')
                ->whereNotNull('properties->form_name')
                ->selectRaw('properties->form_name as form_name, count(*) as count')
                ->groupBy('properties->form_name')
                ->orderBy('count', 'desc')
                ->limit(5)
                ->get(),
        ];

        return response()->json($stats);
    }

    /**
     * Export activity logs
     */
    public function export(Request $request)
    {
        $query = ActivityLog::with(['subject', 'causer'])
            ->orderBy('created_at', 'desc');

        // Apply same filters as index
        if ($request->has('log_name') && $request->log_name) {
            $query->where('log_name', $request->log_name);
        }

        if ($request->has('event') && $request->event) {
            $query->where('event', $request->event);
        }

        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $logs = $query->get();

        $filename = 'activity_logs_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($logs) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'Date',
                'Time',
                'Activity Type',
                'Event',
                'Description',
                'Subject',
                'IP Address',
                'User Agent'
            ]);

            // CSV data
            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->created_at->format('Y-m-d'),
                    $log->created_at->format('H:i:s'),
                    ucfirst($log->log_name),
                    ucfirst($log->event ?? 'N/A'),
                    $log->description,
                    $log->subject ? get_class($log->subject) . ' #' . $log->subject_id : 'N/A',
                    $log->ip_address ?? 'N/A',
                    $log->user_agent ?? 'N/A'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}