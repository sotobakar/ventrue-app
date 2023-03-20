<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventApprovalFile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['event_approval_id', 'name', 'path'];

    /**
     * The approval request of the files
     * 
     */
    public function approval()
    {
        return $this->belongsTo(EventApproval::class, 'event_approval_id');
    }
}
