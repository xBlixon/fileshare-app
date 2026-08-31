<?php

use App\Http\Requests\RegistrationRequest;

it('requires the user to be a guest', function () {
    $request = new RegistrationRequest();
    $this->assertEquals($request->authorize(), auth()->guest());
});
