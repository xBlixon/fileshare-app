<?php

use App\Models\Share;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

it('returns user shares\' relation HasMany', function () {
    $user = new User;
    expect($user->shares())->toBeInstanceOf(HasMany::class)
        ->and($user->shares()->getRelated())->toBeInstanceOf(Share::class);
});
