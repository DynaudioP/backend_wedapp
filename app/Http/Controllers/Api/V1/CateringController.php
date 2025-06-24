<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Catering;
use App\Models\Venue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CateringController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->query('limit', 5);

        $caterings = Catering::with('images')->paginate((int) $limit);

        if ($caterings->count() === 0) {
            return response()->json([
                'message' => 'Catering Not Found'
            ], 404);
        }

        return response()->json([
            'data' => $caterings->items(),
            'message' => 'Catering tersedia',
            'meta' => [
                'current_page' => $caterings->currentPage(),
                'total' => $caterings->total(),
                'per_page' => $caterings->perPage(),
                'last_page' => $caterings->lastPage()
            ]
        ], 200);
    }

    public function show($id)
    {
        $catering = Catering::with('images')->find($id);

        if (!$catering) {
            return response()->json([
                'message' => 'Catering Not Found'
            ], 404);
        }

        return response()->json([
            'message' => 'Catering Tersedia',
            'data' => $catering
        ], 200);
    }

    public function getAll()
    {
        $catering = Catering::with('images')->get();

        if ($catering->isEmpty()) {
            return response()->json([
                'message' => 'Catering Not Found'
            ], 404);
        }

        return response()->json([
            'message' => 'Catering Tersedia',
            'data' => $catering
        ], 200);
    }

    public function search($name) {
        $caterings = Catering::with('images')->where('name', 'like', '%' . $name . '%')->orderBy('name')->get();

        if (count($name) > 0) {
            return response()->json([
                'data' => $caterings
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not Found',
                'data' => $caterings
            ], 404);
        }
    }
}
