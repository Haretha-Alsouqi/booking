<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\EventRepositoryInterface;
use Illuminate\Http\Request;

class EventController extends Controller
{

    protected $events;

    public function __construct(EventRepositoryInterface $events) {
        $this->events = $events;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->events->all());
    }

}
