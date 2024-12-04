<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Theatre;
use Exception;
use Illuminate\Http\Request;

class MovieController extends Controller
{
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
        try {
            $data = $request->validate([
                "theatre_id" => ["required"],
                "title" => ["required"],
                "genre" => ["required"],
                "start" => ["required"],
                "end" => ["required"],
            ]);

            $theatre = Theatre::where("id", $request->theatre_id)->first();

            $data["seats"] = [];

            for ($row = 1; $row <= $theatre["rows"]; $row++) {
                for ($column = 1; $column <= $theatre["columns"]; $column++) {
                    $data["seats"][$row][$column] = false;
                }
            }

            Movie::create($data);

            return response()->json(["message" => "Movie Added Successfully"], 201);

        } catch (Exception $error) {
            return response()->json(["message" => $error->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
