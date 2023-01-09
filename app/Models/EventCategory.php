<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * 
     * 
     */
        /**
     * The events that belongs to the category.
     * 
     */
    public function events()
    {
        return $this->hasMany(Event::class, 'event_id', 'id');
    }
}
