<?php

use App\Models\File;
use App\Models\Share;
use Illuminate\Database\Eloquent\Relations\HasMany;

it('returns share\'s files relation HasMany', function () {
    $share = new Share;
    expect($share->files())->toBeInstanceOf(HasMany::class)
        ->and($share->files()->getRelated())->toBeInstanceOf(File::class);
});
