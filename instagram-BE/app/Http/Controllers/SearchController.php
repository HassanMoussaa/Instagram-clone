<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    public function getAllUsers()
    {
        $user = Auth::user();
        $users = User::where('id', '<>', $user->id)->get();

        return response()->json([
            'message' => 'All users retrieved successfully',
            'users' => $users,
        ]);
    }


}