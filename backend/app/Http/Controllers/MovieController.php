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
        return response()->json(["movies" => Movie::all()], 200);
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
                "price" => ["required"]
            ]);

            $theatre = Theatre::where("id", $request->theatre_id)->first();

            $data["seats"] = [];

            for ($row = 1; $row <= $theatre["rows"]; $row++) {
                for ($column = 1; $column <= $theatre["columns"]; $column++) {
                    $data["seats"][$row][$column] = true;
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
    public function show(Movie $movie)
    {
        return response()->json(["movie" => $movie], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return response()->json(["message" => "Movie Deleted Successfully"], 200);
    }

    public function order(Request $request)
    {
        $seats = $request["seats"];
        $id = $request["id"];
        foreach ($seats as $rowIndex => $row) {
            foreach ($row as $columnIndex => $column) {
                if ($column === "selected") {
                    $seats[$rowIndex][$columnIndex] = false;
                }
            }
        }

        $data = [
            "seats" => $seats
        ];

        Movie::where("id", $id)->update($data);

        return response()->json($seats);
    }
}
