<?php

namespace App\Http\Controllers;

use App\Models\Theatre;
use Illuminate\Http\Request;

class TheatreController extends Controller
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
        $data = $request->validate([
            "theatre_name" => ["required"],
            "rows" => ["required", "integer"],
            "columns" => ["required", "integer"],
        ]);

        $seats = [];

        for ($row = 1; $row <= $data["rows"]; $row++) {
            for ($column = 1; $column <= $data["columns"]; $column++) {
                $seats[$row][$column] = false;
            }
        }

        $data["seats"] = $seats;

        Theatre::create($data);

        return response()->json(["message" => "Theatre Added Successfully"], 201);
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
