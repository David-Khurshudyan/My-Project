@extends('layouts.app')
@section('content')
<div class="row" style="margin:15px;">
      <div class="col-sm-3 bg">
		<div class="card">
			<div class="card-header"><h5>Search options:<h5></div>
			<div class="card-body">
				<form action="{{ url('welcome') }}" method="get" enctype="multipart/form-data" value="{{ csrf_token() }}">
					{{ csrf_field() }}
						<div class="form-group">
							<label for="postName">Post Name:</label>
							<input class="form-control" name="postName" style="margin-bottom:15px;" required>
						</div>
				
						<button class="btn btn-outline-primary" type="submit" style="margin-bottom:15px;">Search</button>
				</form>
				<div class="container" style="padding:0;">
					<ul class="pagination">
						{{ $posts->links() }}
					</ul>
				</div>
			</div>
		</div>
      </div>

      <div class="col-sm-8 bg">
	        @foreach ($posts as $post)
			<div class="card" style="width:400px; margin-bottom:25px;">
				<div class="card-header">{{ $post->Name }}</div>
				<img class="card-img-top" src="{{ asset('storage/' . $post->picturePath)}}" alt="Card image">
				<div class="card-body">
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><p class="card-text">{{ $post->blogTextBody }}</p></li>
					<li class="list-group-item">
					<a href="{{ url('/post/' . $post->id) }}" class="btn btn-primary">Comments  <span class="badge badge-light">{{ $post->commentsCout }}</span></button></a>
					@if ($post->blogAutorID == Auth::user()->id)
						<a href="{{ url('/delete/' . $post->id) }}" class="btn btn-danger" style="margin-left: 10px;">Drop this post</button></a>
					@endif
					</li>
				</ul>						
				</div> 
			</div>
			@endforeach
      </div>
	  

</div>
@endsection