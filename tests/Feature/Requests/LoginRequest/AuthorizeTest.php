<?php

use App\Http\Requests\LoginRequest;

it('requires the user to be a guest', function () {
    $request = new LoginRequest();
    $this->assertEquals($request->authorize(), auth()->guest());
});
