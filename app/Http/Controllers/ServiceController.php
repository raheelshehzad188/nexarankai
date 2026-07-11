<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function show(Service $service): View
    {
        if (! $service->status) {
            abort(404);
        }

        $service->load('serviceCategory');

        $recentServices = Service::where('status', true)
            ->where('id', '!=', $service->id)
            ->with('serviceCategory')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->limit(5)
            ->get(['id', 'title', 'slug', 'service_category_id']);

        return view('frontend.services.show', compact('service', 'recentServices'));
    }
}
