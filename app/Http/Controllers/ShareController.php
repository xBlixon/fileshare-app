<?php

namespace App\Http\Controllers;

use App\Actions\FileActions;
use App\Http\Requests\ShareUpdateRequest;
use App\Http\Requests\StoreShareRequest;
use App\Models\File;
use App\Models\Share;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ShareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $shares = $request->user()->shares()->cardInfo()->get();

        return Inertia::render('Share/Index',
            [
                'shares' => $shares,
            ]);
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

        FileActions::saveMany($files, $share);

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
    public function edit(Share $share): Response
    {
        $share->load('files:id,share_id,name,size');

        return Inertia::render('Share/Edit',
            [
                'share' => $share,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShareUpdateRequest $request, Share $share): RedirectResponse
    {
        $newFiles = $request->file('newFiles') ?? [];

        /** @var Collection<int, File> $filesToRemove */
        $filesToRemove = File::where('share_id', $share->id)
            ->whereIn('id', $request->safe()['filesToRemove'])->get()->collect();

        $share->update($request->safe()->only(['title', 'description']));

        if (count($newFiles) > 0) {
            FileActions::saveMany($newFiles, $share);
        } elseif ($share->files->count() === $filesToRemove->count()) {
            Inertia::flash('error', 'Unable remove all files from a file share.');

            return to_route('share.show', ['share' => $share]);
        }

        FileActions::removeMany($filesToRemove);

        return to_route('share.show', ['share' => $share]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Share $share): RedirectResponse
    {
        Gate::authorize('delete', $share);

        Storage::deleteDirectory("shares/$share->id");
        $share->delete();

        return to_route('share.index');
    }
}
