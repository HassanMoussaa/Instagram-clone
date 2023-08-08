<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FollowController extends Controller
{
    public function followUser(Request $request, $userId)
    {
        try {
            $userToFollow = User::findOrFail($userId);
            $user = Auth::user();

            $user->following()->attach($userToFollow);

            return response()->json([
                'message' => 'User followed successfully',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
            ], 500);
        }
    }

    public function unfollowUser(Request $request, $userId)
    {
        try {
            $userToUnfollow = User::findOrFail($userId);
            $user = Auth::user();

            $user->following()->detach($userToUnfollow);

            return response()->json([
                'message' => 'User unfollowed successfully',
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
            ], 500);
        }
    }


}