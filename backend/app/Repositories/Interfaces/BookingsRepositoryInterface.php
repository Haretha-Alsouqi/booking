<?php

namespace App\Repositories\Interfaces;

interface BookingsRepositoryInterface {
    public function find($id);
    public function create(array $data);
    public function delete($id);
}
