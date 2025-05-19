<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface {
    public function all() {
        return User::all();
    }

    public function find($id) {
        return User::findOrFail($id);
    }

    public function update($id, array $data) {
        $event = User::findOrFail($id);
        $event->update($data);
        return $event;
    }

    public function delete($id) {
        User::destroy($id);
    }
}
