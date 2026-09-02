<?php

use App\Http\Requests\StoreShareRequest;

it('requires the user to be a guest', function () {
    $request = new StoreShareRequest;
    $this->assertEquals($request->authorize(), auth()->check());
});
