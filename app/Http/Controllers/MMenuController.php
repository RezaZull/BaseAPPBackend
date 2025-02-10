<?php

namespace App\Http\Controllers;

use App\Models\MMenu;
use Illuminate\Http\Request;

class MMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'name' => 'hello'
        ]);
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
    public function show(MMenu $mMenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MMenu $mMenu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MMenu $mMenu)
    {
        //
    }
}
