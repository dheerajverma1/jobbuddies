<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomMeeting extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'zoom_meeting_id',
        'interviewer_id',
        'candidate_id',
        'created_by',
        'start_time',
        'duration',
        'topic',
        'agenda',
        'host_video',
        'participant_video',
    ];
}
