<?php

it('shows registration form', function () {
    $this->get(route('register.index'))
        ->assertStatus(200)
        ->assertSee('Create a new account');
});
