<?php

use App\Models\User;

it('logs out a user', function () {
    $this->actingAs(User::factory()->create());

    $this->assertAuthenticated();
    $this->post(route('logout'));
    $this->assertGuest();
});
