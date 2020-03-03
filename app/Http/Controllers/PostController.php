<?php

namespace App\Http\Controllers;
use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request)
	{
		$this->validate($request, [
			'postName' => 'bail|required|max:255',
			'postBody' => 'required',
			'postImage' => 'required|image'
		]);
		$path = $request->file('postImage')->store('pics/images','public');
		$blog = new Blog;
		$blog->Name = $request->get('postName');
		$blog->blogTextBody = $request->get('postBody');
		$blog->picturePath = $path;
		$blog->commentsCout = 0;
		$blog->blogAutorID = Auth::user()->id;
		$blog->save();
		
		return view('home', ['serverResponse' => 'succses']);
	}
	
	public function destroy($id)
	{
		DB::delete('delete from blogs where id = ?',[$id]);
		return back();	
	}
	
	public function search(Request $request)
	{
		$search = $request->get('postName');
		$posts = DB::table('blogs')->where('name', 'like', '%' .$search. '%')->paginate(4);
		
		return view('home', ['posts' => $posts]);
	}

	public function index($page = 1)
	{
		$posts = DB::table('blogs')->paginate(4);
		return view('welcome', ['posts' => $posts]);
	}

}