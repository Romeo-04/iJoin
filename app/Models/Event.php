<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'location', 'price', 'status', 'date', 'max_registrants', 'created_by'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function availableSpots()
    {
        return $this->max_registrants - $this->tickets()->count();
    }

    public function isFull()
    {
        return $this->availableSpots() <= 0;
    }
}
