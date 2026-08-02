<?php

namespace App\Http\Controllers;

use App\Models\Share;
use App\Http\Requests\StoreShareRequest;
use App\Http\Requests\UpdateShareRequest;
use Inertia\Inertia;
use Inertia\Response;

class ShareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Share/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Share/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShareRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Share $share)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Share $share)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShareRequest $request, Share $share)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Share $share)
    {
        //
    }
}
