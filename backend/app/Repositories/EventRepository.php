<?php

namespace App\Repositories;

use App\Models\Event;
use App\Repositories\Interfaces\EventRepositoryInterface;

class EventRepository implements EventRepositoryInterface {
    public function all() {
        return Event::all();
    }

    public function find($id) {
        return Event::findOrFail($id);
    }

    public function create(array $data) {
        return Event::create($data);
    }

    public function update($id, array $data) {
        $event = Event::findOrFail($id);
        $event->update($data);
        return $event;
    }

    public function delete($id) {
        Event::destroy($id);
    }
}
