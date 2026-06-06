<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Realization;
use App\Models\Service;

class PagesController extends Controller
{
    public function home()
    {
        $questions = Faq::latest()->get();
        $services = Service::orderBy('created_at', 'asc')->get();
        $realizations = Realization::orderBy('created_at', 'asc')->get();

        return view('home', compact('questions', 'services', 'realizations'));
    }

    public function service(Service $service)
    {
        $otherServices = Service::whereKeyNot($service->getKey())
            ->orderBy('created_at', 'asc')
            ->get();

        return view('service', compact('service', 'otherServices'));
    }

    public function realization(Realization $realization)
    {
        $services = Service::orderBy('created_at', 'asc')->get();
        $otherRealizations = Realization::whereKeyNot($realization->getKey())
            ->orderBy('created_at', 'asc')
            ->limit(4)
            ->get();

        return view('realization', compact('realization', 'services', 'otherRealizations'));
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function contact()
    {
        return view('contact');
    }
}
