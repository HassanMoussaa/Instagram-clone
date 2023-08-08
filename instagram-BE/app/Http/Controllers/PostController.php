<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getFollowingPosts(Request $request)
    {
        $user = Auth::user();
        $followingIds = $user->following()->pluck('id');

        $followingPosts = Post::whereIn('user_id', $followingIds)->with('user')->get();

        return response()->json([
            'message' => 'Following posts retrieved successfully',
            'posts' => $followingPosts,
        ]);
    }
}