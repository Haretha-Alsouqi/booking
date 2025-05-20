<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\BookingsRepositoryInterface;
use Illuminate\Http\Response;

class BookingsController extends Controller
{
    protected $bookings;

    public function __construct(BookingsRepositoryInterface $bookings) {
        $this->bookings = $bookings;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        return response()->json($user->bookings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user_id = $request->user()->id;
            $event_id = isset($request['event_id']) ? $request['event_id'] : null;

            if (empty($event_id)) {
                return response()->json(
                    Response::HTTP_BAD_REQUEST,
                );
            }

            $data = array(
                'user_id' => $user_id,
                'event_id' => $event_id,
            );

            $this->bookings->create($data);

            return response()->json(
                Response::HTTP_CREATED,
            );
        } catch (\Exception $e) {
            return response()->json(
                $e->getCode(),
                $e->getMessage()
            );
        }
    }

}
