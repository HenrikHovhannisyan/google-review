<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();
        return response()->json($feedbacks);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rate' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'experience' => 'required|string',
        ]);

        $feedback = Feedback::create($validatedData);
        return response()->json($feedback, 201);
    }

    public function show($id)
    {
        $feedback = Feedback::findOrFail($id);
        return response()->json($feedback);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'rate' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'experience' => 'required|string',
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->update($validatedData);
        return response()->json($feedback);
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
        return response()->json(null, 204);
    }

    /**
     * Get feedbacks for API.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getFeedbacks(Request $request)
    {
        $rateFilter = $request->input('rate', 'all');

        $query = Feedback::query();
        if ($rateFilter !== 'all') {
            $query->where('rate', $rateFilter);
        }
        $feedbacks = $query->orderBy('created_at', 'desc')->get();

        return response()->json($feedbacks);
    }
}
