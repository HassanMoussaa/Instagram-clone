<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LikeController extends Controller
{

    public function likePost(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $user = Auth::user();

        if ($user->likes()->where('post_id', $postId)->exists()) {
            return response()->json([
                'message' => 'You already liked this post',
            ], 400);
        }

        $like = new Like();
        $like->user_id = $user->id;
        $post->likes()->save($like);

        $post->increment('likes_count');

        return response()->json([
            'message' => 'Post liked successfully',
        ]);
    }

    public function unlikePost(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $user = Auth::user();

        $like = $user->likes()->where('post_id', $postId)->first();

        if (!$like) {
            return response()->json([
                'message' => 'You have not liked this post',
            ], 400);
        }
        $post->decrement('likes_count');

        $like->delete();

        return response()->json([
            'message' => 'Post unliked successfully',
        ]);
    }


    public function isPostLikedByUser($postId)
    {
        $user = Auth::user();

        $liked = $user->likes()->where('post_id', $postId)->exists();

        return response()->json([
            'liked' => $liked,
        ]);
    }


}