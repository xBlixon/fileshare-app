<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file): StreamedResponse
    {
        return Storage::response($file->path.$file->name);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file): void
    {
        //
    }
}
