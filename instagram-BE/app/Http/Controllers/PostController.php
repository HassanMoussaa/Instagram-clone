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
        $followingIds = $user->following()->pluck('users.id');

        $followingPosts = Post::whereIn('user_id', $followingIds)->with('user')->get();

        return response()->json([
            'message' => 'Following posts retrieved successfully',
            'posts' => $followingPosts,
        ]);
    }

    public function createPost(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('image')) {
            $file_extension = $request->image->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = 'images';
            $request->image->move($path, $file_name);
            $image_url = "http://127.0.0.1:8000/images/" . $file_name;
        } else {
            return response()->json([
                'message' => 'Image upload failed',
            ], 400);
        }

        $post = $user->posts()->create([
            'image_url' => $image_url,
            'likes' => 0,
        ]);

        return response()->json([
            'message' => 'Post created successfully',
            'post' => $post,
        ]);
    }

}