<?php

use App\Models\File;
use App\Models\Share;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('returns file\'s share relation BelongsTo', function () {
    $file = new File;
    expect($file->share())->toBeInstanceOf(BelongsTo::class)
        ->and($file->share()->getRelated())->toBeInstanceOf(Share::class);
});
