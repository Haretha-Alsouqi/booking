<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Repositories\Interfaces\BookingsRepositoryInterface;

class BookingsRepository implements BookingsRepositoryInterface {

    public function find($id) {
        return Booking::findOrFail($id);
    }

    public function create(array $data) {
        return Booking::create($data);
    }

    public function delete($id) {
        Booking::destroy($id);
    }
}
