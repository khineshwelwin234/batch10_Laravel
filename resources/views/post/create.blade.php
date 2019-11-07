@extends('template')
@section('content')
<div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">Post Title</h1>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

	<form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
		@csrf
	<div class="form-group">
		<label>Title:</label>
		<input type="text" name="title" class="form-control">
	</div>
	<div class="form-group">
		<label>Contact:</label><span class="text-danger">[supported file types:jpeg,png]</span>
		<textarea name="contact" class="form-control"></textarea>
	</div>
	<div class="form-group">
		<label>Photo:</label>
		<input type="file" name="photo" class="form-control-file">
	</div>
	<div class="form-group">
		<label>Categories</label>
		<select name="category" class="form-control">
			<option value="">Choose Category</option>
			{-- accept data and loop --}
			@foreach($categories as $row)
			<option value="{{$row->id}}">{{$row->name}}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group">
		<input type="submit" name="btn btn-primary" value="save">
	</div>
	</div>
	</div>
	</div>
</form>
@endsection
