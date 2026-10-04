<?php

namespace App\Actions;

use App\Models\File;
use App\Models\Share;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileActions
{
    public static function save(UploadedFile $file, Share $share): void
    {
        $path = "shares/$share->id/";
        $name = $file->getClientOriginalName();
        $file->storeAs($path, $name);
        $share->files()->create([
            'path' => $path,
            'name' => $name,
            'size' => $file->getSize(),
        ]);
    }

    /**
     * @param  UploadedFile[]  $files
     */
    public static function saveMany(array $files, Share $share): void
    {
        foreach ($files as $file) {
            self::save($file, $share);
        }
    }

    public static function remove(File $file): void
    {
        Storage::delete($file->path.$file->name);
        $file->delete();
    }

    /**
     * @param  iterable<File>  $files
     */
    public static function removeMany(iterable $files): void
    {
        foreach ($files as $file) {
            self::remove($file);
        }
    }
}
