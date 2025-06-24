<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Organizers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrganizersController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->query('limit', 5);

        $organizers = Organizers::with('images')->paginate((int) $limit);

        if ($organizers->count() === 0) {
            return response()->json([
                'message' => 'Organizers Not Found'
            ], 404);
        }

        return response()->json([
            'data' => $organizers->items(),
            'message' => 'Event Organizers tersedia',
            'meta' => [
                'current_page' => $organizers->currentPage(),
                'total' => $organizers->total(),
                'per_page' => $organizers->perPage(),
                'last_page' => $organizers->lastPage()
            ]
        ], 200);
    }

    public function getAll()
    {
        $organizers = Organizers::with('images')->get();

        if ($organizers->isEmpty()) {
            return response()->json([
                'message' => 'Organizers Not Found'
            ], 404);
        }

        return response()->json([
            'data' => $organizers
        ], 200);
    }

    public function show($id)
    {
        $organizer = Organizers::with('images')->find($id);

        if (!$$organizer) {
            return response()->json([
                'message' => 'Event Organizers Not Found'
            ], 404);
        }

        return response()->json([
            'message' => 'Event Organizers Tersedia',
            'data' => $organizer
        ], 200);
    }

    public function search($name): void {
        $organizers = Organizers::with('images')->where('name', 'like', '%'.$name.'%')->orderBy('name')->get();
    
        if (count($name) > 0) {
            return response()->json([
                'data' => $organizers
            ], 200);
        } else {
            return response()->json([
                'message' => 'Event Organizers Not Found',
                'data' => $organizers
            ], 404);
        }
    }
}
