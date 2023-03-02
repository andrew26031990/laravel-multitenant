<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Str;

class TestController extends Controller
{
    public function index()
    {
        $tenant = Tenant::create([]);
        $tenant->domains()->create(['domain' => Str::random(10) . '.uz']);

        return $tenant->load(['domains']);
    }

    public function token()
    {
        return response()->json(User::findOrFail(1)->createToken('token-name')->accessToken);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
