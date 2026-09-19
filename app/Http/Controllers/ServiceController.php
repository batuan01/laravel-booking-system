<?php

namespace App\Http\Controllers;

use App\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->paginate(10);

        return view('services.index', compact('services'));
    }

    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }
}
