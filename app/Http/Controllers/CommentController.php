<?php

namespace App\Http\Controllers;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function addComment(Request $request, $postID)
	{
		$this->validate($request, [
			'commentName => required',
			'commentBody' => 'required'
		]);
		
		$comment = new Comment;
		$comment->commentName = $request->get('commentName');
		$comment->commentBody = $request->get('commentBody');
		$comment->commentAutorID = Auth::user()->id;
		$comment->commentRating = 0;
		$comment->blogID = $postID;
		$comment->save();
		
		$post = DB::table('blogs')->where('id', $postID)->update([
			'commentsCout' => \DB::raw('commentsCout+1')
		]);
		
		return back();
	}
	
	public function index($postID)
	{
		$comments = DB::table('comments')->where('BlogId', $postID)->get();
		$users = DB::table('users')->get();
		$post = DB::table('blogs')->where('id', $postID)->first();
		
		return view('comments', ['comments' => $comments, 'post' => $post, 'users' => $users]);
	}
}
