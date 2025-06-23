<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Venue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function PHPUnit\Framework\isEmpty;

class VenueController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->query('limit', 5);

        $venues = Venue::with('images')->paginate((int) $limit);

        if ($venues->count() === 0) {
            return response()->json([
                'message' => 'Venue Not Found'
            ], 404);
        }

        return response()->json([
            'data' => $venues->items(),
            'message' => 'Venue tersedia',
            'meta' => [
                'current_page' => $venues->currentPage(),
                'total' => $venues->total(),
                'per_page' => $venues->perPage(),
                'last_page' => $venues->lastPage()
            ]
        ], 200);
    }

    public function show($id)
    {
        $venue = Venue::with('images')->find($id);

        if (!$venue) {
            return response()->json([
                'message' => 'Venue Not Found'
            ], 404);
        }

        return response()->json([
            'data' => $venue
        ], 200);
    }

    public function getAll()
    {
        $venues = Venue::with('images')->get();

        if ($venues->isEmpty()) {
            return response()->json([
                'message' => 'Venue Not Found'
            ], 404);
        }

        return response()->json([
            'data' => $venues
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'location' => 'required|string|min:1',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $venue = Venue::create($validated);

        return response()->json([
            'message' => 'Venue telah ditambahkan',
            'data' => $venue
        ], 201);
    }
}
