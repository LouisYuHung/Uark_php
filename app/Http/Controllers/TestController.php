<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        return 'Hello World';
    }

    public function show(string $id)
    {
        return ['id' => $id];
    }
}
