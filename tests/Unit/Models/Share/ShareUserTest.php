<?php

use App\Models\Share;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

it('returns share\'s user relation BelongsTo', function () {
    $share = new Share();
    expect($share->user())->toBeInstanceOf(BelongsTo::class)
        ->and($share->user()->getRelated())->toBeInstanceOf(User::class);
});
