<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TicketController extends Controller
{
    // public static function middleware()
    // {
    //     return [new Middleware("auth:sanctum", except: ["index", "show"])];
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function order(Request $request)
    {
        $user_id = $request->user()->id;
        $movie_id = $request->movie_id;
        $seats = $request->ordered_seats;

        foreach ($seats as $seat) {
            $data = [
                "user_id" => $user_id,
                "movie_id" => $movie_id,
                "seat" => $seat
            ];

            Ticket::create($data);
        }



        return response()->json(["data" => $data]);
    }
}
