<?php

it('shows login form', function () {
    $this->get(route('login.index'))
        ->assertStatus(200)
        ->assertSee('Log in to your account');
});
