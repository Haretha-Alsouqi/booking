<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\BookingsRepositoryInterface;

class BookingController extends Controller
{
    protected $bookings;

    public function __construct(BookingsRepositoryInterface $bookings)
    {
        $this->bookings = $bookings;
    }

    public function book(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'event_id' => 'required',
        ]);

        $this->bookings->create($request->all());
        return redirect()->route('users.index')->with('success', 'Booked successfully.');
    }
}
