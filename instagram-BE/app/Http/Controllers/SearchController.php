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


    public function getAllUsers(Request $request)
    {
        $loggedInUser = Auth::user();
        $allUsers = User::where('id', '<>', $loggedInUser->id)->get();

        $usersWithFollowStatus = $allUsers->map(function ($user) use ($loggedInUser) {
            $isFollowed = $loggedInUser->isFollowing($user);
            return [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'image' => $user->image,
                'is_followed' => $isFollowed,
            ];
        });

        return response()->json([
            'message' => 'All users retrieved successfully',
            'users' => $usersWithFollowStatus,
        ]);
    }

}