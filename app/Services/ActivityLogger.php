<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogger
{
    /**
     * Log an activity
     */
    public static function log(
        string $logName,
        string $description,
        string $event = null,
        $subject = null,
        $causer = null,
        array $properties = [],
        Request $request = null
    ): ActivityLog {
        $data = [
            'log_name' => $logName,
            'description' => $description,
            'event' => $event,
            'properties' => $properties,
        ];

        // Set subject if provided
        if ($subject) {
            $data['subject_type'] = get_class($subject);
            $data['subject_id'] = $subject->id;
        }

        // Set causer if provided
        if ($causer) {
            $data['causer_type'] = get_class($causer);
            $data['causer_id'] = $causer->id;
        }

        // Add request info if available
        if ($request) {
            $data['ip_address'] = $request->ip();
            $data['user_agent'] = $request->userAgent();
        }

        return ActivityLog::create($data);
    }

    /**
     * Log form creation
     */
    public static function logFormCreated($form, $causer = null, Request $request = null): ActivityLog
    {
        return self::log(
            'form',
            "Form '{$form->name}' was created",
            'created',
            $form,
            $causer,
            ['form_name' => $form->name],
            $request
        );
    }

    /**
     * Log form update
     */
    public static function logFormUpdated($form, $causer = null, Request $request = null): ActivityLog
    {
        return self::log(
            'form',
            "Form '{$form->name}' was updated",
            'updated',
            $form,
            $causer,
            ['form_name' => $form->name],
            $request
        );
    }

    /**
     * Log form deletion
     */
    public static function logFormDeleted($form, $causer = null, Request $request = null): ActivityLog
    {
        return self::log(
            'form',
            "Form '{$form->name}' was deleted",
            'deleted',
            $form,
            $causer,
            ['form_name' => $form->name],
            $request
        );
    }

    /**
     * Log field creation
     */
    public static function logFieldCreated($field, $form, $causer = null, Request $request = null): ActivityLog
    {
        return self::log(
            'field',
            "Field '{$field->label}' ({$field->type}) was added to form '{$form->name}'",
            'created',
            $field,
            $causer,
            [
                'field_name' => $field->name,
                'field_label' => $field->label,
                'field_type' => $field->type,
                'form_name' => $form->name
            ],
            $request
        );
    }

    /**
     * Log field update
     */
    public static function logFieldUpdated($field, $form, $causer = null, Request $request = null): ActivityLog
    {
        return self::log(
            'field',
            "Field '{$field->label}' was updated in form '{$form->name}'",
            'updated',
            $field,
            $causer,
            [
                'field_name' => $field->name,
                'field_label' => $field->label,
                'field_type' => $field->type,
                'form_name' => $form->name
            ],
            $request
        );
    }

    /**
     * Log field deletion
     */
    public static function logFieldDeleted($field, $form, $causer = null, Request $request = null): ActivityLog
    {
        return self::log(
            'field',
            "Field '{$field->label}' was removed from form '{$form->name}'",
            'deleted',
            $field,
            $causer,
            [
                'field_name' => $field->name,
                'field_label' => $field->label,
                'field_type' => $field->type,
                'form_name' => $form->name
            ],
            $request
        );
    }

    /**
     * Log form submission
     */
    public static function logFormSubmitted($submission, $form, $causer = null, Request $request = null): ActivityLog
    {
        return self::log(
            'submission',
            "New submission received for form '{$form->name}'",
            'submitted',
            $submission,
            $causer,
            [
                'submission_id' => $submission->submission_id,
                'form_name' => $form->name,
                'submitted_by' => $submission->submitted_by
            ],
            $request
        );
    }

    /**
     * Log submission status change
     */
    public static function logSubmissionStatusChanged($submission, $form, $oldStatus, $newStatus, $causer = null, Request $request = null): ActivityLog
    {
        return self::log(
            'submission',
            "Submission status changed from '{$oldStatus}' to '{$newStatus}' for form '{$form->name}'",
            $newStatus,
            $submission,
            $causer,
            [
                'submission_id' => $submission->submission_id,
                'form_name' => $form->name,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'submitted_by' => $submission->submitted_by
            ],
            $request
        );
    }

    /**
     * Log data export
     */
    public static function logDataExported($form, $format, $causer = null, Request $request = null): ActivityLog
    {
        return self::log(
            'export',
            "Data exported from form '{$form->name}' in {$format} format",
            'exported',
            $form,
            $causer,
            [
                'form_name' => $form->name,
                'export_format' => $format
            ],
            $request
        );
    }
}
