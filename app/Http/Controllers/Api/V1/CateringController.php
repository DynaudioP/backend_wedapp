<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Catering;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CateringController extends Controller
{
    public function index()
    {
        $caterings = Catering::with('images')->get();

        if ($caterings->isEmpty()) {
            return response()->json([
                'message' => 'Catering Not Found'
            ], 404);
        }

        return response()->json([
            'data' => $caterings
        ], 200);
    }
}
