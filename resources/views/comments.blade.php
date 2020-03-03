@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

			<div class="card" style="width:500px; text-align: center;">
				<img class="card-img-top" src="{{ asset('storage/' . $post->picturePath) }}" alt="Card image">
					<div class="card-body">
						<h4 class="card-title"><strong>{{ $post->Name }}</strong></h4>
						<p class="card-text">{{ $post->blogTextBody }}</p>
				</div> 
			</div>
			<div class="container" style="margin-top:30px;">
			<label><h4>Comments: </h4></label>
			@foreach ($comments as $comment)
				<?php $thisCommentCreator = $users->where('id', $comment->commentAutorID)->first(); ?>
				<div class="media border p-3" style="background:white; margin-bottom: 12px;">
					<img src="{{ asset('storage/pics/avatars/' . $thisCommentCreator->avatarPath) }}" alt="{{ $thisCommentCreator->name }}" class="mr-3 mt-3 rounded-circle" style="width:60px;">
					<div class="media-body">
						<h4>{{ $thisCommentCreator->name }} <small><i>Posted on {{ $comment->created_at }}</i></small></h4>
						<p>{{ $comment->commentBody }}</p>
					</div>
				</div>
			@endforeach
			</div>
			@Auth
			<div class="card-body">
					<form action="{{ url('post/' . $post->id . '/comment') }}" method="post" enctype="multipart/form-data" value="{{ csrf_token() }}">
					{{ csrf_field('PATCH') }}
						<div class="form-group">
							<label for="commentName">Comment name:</label>
							<input class="form-control" placeholder="Your comment name" name="commentName" style="margin-bottom:15px;" required>
						</div>
						<div class="form-group">
							<label for="DecriptionTextarea">Your Comment:</label>
							<textarea class="form-control" id="DecriptionTextarea" name="commentBody" rows="3" required></textarea>
						</div>
						
						<button class="btn btn-dark" type="submit" style="margin-bottom:15px;">Add the comment</button>
					</form>
					@if (isset($errors->any))
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Whoops! There's something wrong!</strong>
						</div>
						 <div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
								@endforeach
							</ul>
						 </div>
					@endif
					@if (isset($serverResponse))
						<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>New post succesfuly added!</strong>
						</div>
					@endif
            </div>
			@endAuth
		</div>
	</div>
</div>
@endsection