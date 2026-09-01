<?php

use App\Models\Share;

it('shows the share', function () {
    $share = Share::factory()->create();
    $this->actingAs($share->user);

    $this->get(route('share.show', $share))
        ->assertOk()
        ->assertSee($share->title)
        ->assertSee($share->description);
});

it('requires the user to be authenticated', function () {
    $share = Share::factory()->create();

    $this->get(route('share.show', $share))
        ->assertRedirectToRoute('login.index');
});
