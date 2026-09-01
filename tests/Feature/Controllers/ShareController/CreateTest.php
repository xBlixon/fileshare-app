<?php

use App\Models\User;

it('shows share creation form', function () {
    $this->actingAs(User::factory()->create());
    $this->get(route('share.create'))
        ->assertStatus(200)
        ->assertSee('Share new files');
});

it('requires the user to be authenticated', function () {
    $this->get(route('share.create'))
        ->assertRedirect('login');
});
