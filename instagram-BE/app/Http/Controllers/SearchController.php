<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchUsers(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('name', 'LIKE', "%$query%")
            ->orWhere('username', 'LIKE', "%$query%")
            ->get();

        return response()->json([
            'users' => $users,
        ]);
    }
}