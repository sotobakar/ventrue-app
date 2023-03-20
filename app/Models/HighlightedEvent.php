<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HighlightedEvent extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['event_id'];

    /**
     * The event of that will be highlighted.
     * 
     */
    public function event() {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
