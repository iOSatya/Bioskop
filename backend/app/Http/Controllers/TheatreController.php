<?php

namespace App\Http\Controllers;

use App\Models\Theatre;
use Exception;
use Illuminate\Http\Request;

class TheatreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(["theatres" => Theatre::all()], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                "theatre_name" => ["required"],
                "rows" => ["required", "integer"],
                "columns" => ["required", "integer"],
            ]);
    
            Theatre::create($data);
    
            return response()->json(["message" => "Theatre Added Successfully"], 201);
        } catch (Exception $error) {
            return response()->json(["message" => $error->getMessage()], 400);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Theatre $theatre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Theatre $theatre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Theatre $theatre)
    {
        //
    }
}
