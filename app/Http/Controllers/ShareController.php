<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShareRequest;
use App\Models\Share;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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
        //        Log::debug($request);

        //        /** @var Share $share */
        $share = auth()->user()->shares()->create($request->safe()->only(['title', 'description']));
        $request->collect('files')->each(
            function (/** @var UploadedFile $file */ $file) use ($share) {
                $path = $file->store("shares/$share->id");
                $share->files()->create([
                    'path' => $path,
                ]);
            });

        return back();
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
    public function update(Request $request, Share $share)
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
