<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Event extends Model
{
    protected $fillable = ['title', 'capacity', 'price', 'date'];

    public function bookings(): MorphMany
    {
        return $this->morphMany(Booking::class, 'bookable');
    }

    public function getDiscountInfoAttribute()
    {
        $firstDiscount = (int) ($this->capacity * 0.3);
        $lastDiscount = (int) ($this->capacity * 0.1);

        $soldTickets = Booking::where('event_id', $this->event_id)->count();

        if ($soldTickets < $firstDiscount) {
            $discount = 0.10;
        } elseif ($soldTickets >= ($this->capacity - $lastDiscount)) {
            $discount = 0.20;
        } else {
            $discount = 0.0;
        }

        $discountedPrice = $this->price * (1 - $discount);

        return [
            'discount_percent' => $discount * 100,
            'discounted_price' => round($discountedPrice, 2),
            'original_price' => $this->price
        ];
    }

    public function getAvailableAttribute()
    {
        $available = $this->is_available;

        $soldTickets = Booking::where('event_id', $this->event_id)->count();

        if ($available && $soldTickets >= $this->capacity)
            $available = false;

        return $available;
    }

}
