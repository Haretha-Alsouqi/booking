<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\EventRepositoryInterface;


class EventController extends Controller
{
    protected $events;

    public function __construct(EventRepositoryInterface $events)
    {
        $this->events = $events;
    }

    public function index()
    {
        return Inertia::render('events/Index', [
            'events' => $this->events->all()
        ]);
    }

    public function create()
    {
        return Inertia::render('events/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'capacity' => 'required',
            'price' => 'required',
            'date' => 'required|date',
        ]);

        $this->events->create($request->all());
        return redirect()->route('events.index')->with('success', 'Event created.');
    }

    public function edit($id)
    {
        return Inertia::render('events/Edit', [
            'event' => $this->events->find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'capacity' => 'required',
            'price' => 'required',
            'date' => 'required|date',
        ]);

        $this->events->update($id, $request->all());
        return redirect()->route('events.index')->with('success', 'Event updated.');
    }

    public function destroy($id)
    {
        $this->events->delete($id);
        return redirect()->route('events.index')->with('success', 'Event deleted.');
    }
}
