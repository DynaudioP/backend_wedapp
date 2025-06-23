<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Organizers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrganizersController extends Controller
{
    public function index()
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
}
