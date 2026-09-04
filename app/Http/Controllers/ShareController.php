<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShareRequest;
use App\Models\Share;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
    public function store(StoreShareRequest $request): RedirectResponse
    {
        $share = auth()->user()->shares()->create($request->safe()->only(['title', 'description']));

        $files = $request->file('files');

        foreach ($files as $file) {
            $path = "shares/$share->id/";
            $name = $file->getClientOriginalName();
            $file->storeAs($path, $name);
            $share->files()->create([
                'path' => $path,
                'name' => $name,
                'size' => $file->getSize(),
            ]);
        }

        Inertia::flash('success', 'Your share has been created!');

        return to_route('share.show', $share);
    }

    /**
     * Display the specified resource.
     */
    public function show(Share $share): Response
    {
        $share->load('files:id,share_id,name,size');

        return Inertia::render('Share/Show',
            [
                'share' => $share,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Share $share): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Share $share): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Share $share): void
    {
        //
    }
}
