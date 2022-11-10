<?php

namespace App\Http\Controllers\User;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Post $post, Request $request)
    {

        $rules = [
            'author_name'   => 'required',
            'author_email'  => 'nullable|email',
            'body'          => 'required'
        ];
        $message = [
            'body.required' => "Comment body can't be empty"
        ];
        $this->validate($request, $rules, $message);

        $input = $request->all();
        $input['post_id'] = $post->id;

        $comment = Comment::create($input);

        return redirect()->back()->with('create_message', 'Your comment added');
    }
}
