<?php

it('shows homepage', function () {
    $this->get(route('home.index'))
        ->assertStatus(200)
        ->assertSee('Homepage');
});
