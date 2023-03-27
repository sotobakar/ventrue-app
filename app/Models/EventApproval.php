<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventApproval extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['event_id', 'approved_at'];

    /**
     * Get the event's status.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return config('constants.EVENT.APPROVAL.STATUS')[(int) boolval($attributes['approved_at'])];
            },
        );
    }

    /**
     * The event of the approval request
     * 
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * The files of the approval request
     * 
     */
    public function files()
    {
        return $this->hasMany(EventApprovalFile::class, 'event_approval_id');
    }
}
