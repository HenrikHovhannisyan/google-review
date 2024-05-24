<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request)
    {
        $rateFilter = $request->input('rate', 'all');

        $query = Feedback::query();
        if ($rateFilter !== 'all') {
            $query->where('rate', $rateFilter);
        }
        $feedbacks = $query->paginate(10);

        return view('home', compact('feedbacks', 'rateFilter'));
    }
}
