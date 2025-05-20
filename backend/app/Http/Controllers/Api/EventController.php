<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Repositories\Interfaces\EventRepositoryInterface;
use Illuminate\Http\Request;

class EventController extends Controller
{

    protected $events;

    public function __construct(EventRepositoryInterface $events)
    {
        $this->events = $events;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return EventResource::collection($events);
    }

}
