<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Venue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function PHPUnit\Framework\isEmpty;

class VenueController extends Controller
{
    public function index()
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
}
