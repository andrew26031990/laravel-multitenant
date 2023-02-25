<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
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
}
