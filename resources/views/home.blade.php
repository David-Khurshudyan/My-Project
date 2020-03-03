@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ Auth::user()->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><h5>Name:  </h5>{{ Auth::user()->name }}</li>
						<li class="list-group-item"><h5>Email:  </h5>{{ Auth::user()->email }}</li>
						<li class="list-group-item"><h5>Created at:  </h5>{{ Auth::user()->created_at }}</li>
					</ul>
                </div>
            </div>
        </div>
		
		<div class="col-md-8" style="margin-top: 25px;">
            <div class="card">
                <div class="card-header">Create new post?</div>

                <div class="card-body">
					<form action="{{ route('create.post') }}" method="post" enctype="multipart/form-data" value="{{ csrf_token() }}">
					{{ csrf_field() }}
						<div class="form-group">
							<label for="postName">Post Name:</label>
							<input class="form-control" placeholder="Your post name" name="postName" style="margin-bottom:15px;" required>
						</div>
						<div class="form-group">
							<label for="DecriptionTextarea">Description:</label>
							<textarea class="form-control" id="DecriptionTextarea" name="postBody" rows="3" required></textarea>
						</div>
						<div class="form-group">
							<input type="file" name="postImage">
						</div>
						
						<button class="btn btn-dark" type="submit" style="margin-bottom:15px;">Create post</button>
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
            </div>
        </div>
    </div>
</div>
@endsection
