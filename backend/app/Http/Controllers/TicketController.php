<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Movie;
use App\Models\Theatre;
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
    public function store(Request $request)
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
    public function update(Request $request, Ticket $ticket)
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

        $movie = Movie::where("id", $movie_id)->first(["title", "theatre_id"]);
        $theatre_name = Theatre::where("id", $movie["theatre_id"])->first(["theatre_name"]);

        foreach ($seats as $seat) {
            $data = [
                "user_id" => $user_id,
                "movie_id" => $movie_id,
                "seat" => $seat,
                "title" => $movie["title"],
                "theatre_name" => $theatre_name["theatre_name"]
            ];

            Ticket::create($data);
        }

        return response()->json(["message" => $theatre_name], 201);
    }

    public function userTicket(Request $request)
    {
        $tickets = Ticket::where("user_id", $request->user()->id)->get();
        return response()->json(["tickets" => $tickets]);
    }
}
