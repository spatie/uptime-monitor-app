<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitors extends Model
{
    protected $table = 'monitors';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'environment', 'uptime_check_enabled', 'look_for_string', 'uptime_check_interval_in_minutes', 'uptime_status', 'uptime_check_failure_reason', 'uptime_check_times_failed_in_a_row', 'uptime_status_last_change_date', 'uptime_last_check_date', 'uptime_check_failed_event_fired_on_date', 'uptime_check_method', 'certificate_check_enabled', 'certificate_status', 'certificate_expiration_date', 'certificate_issuer', 'certificate_check_failure_reason'
    ];
}
