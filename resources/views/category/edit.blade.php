@extends('template')
@section('content')
<h2>Edit category form</h2>
<div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">Category Edit form</h1>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

	<form method="post" action="{{route('category.update',$categories->id)}}" enctype="multipart/form-data">
		@csrf
		@method('PUT')
	<div class="form-group">
		<label>Category Name:</label>
		<input type="text" name="name" class="form-control" value="{{$categories->name}}">
	</div>
	<div class="form-group">
		<input type="submit" name="btnsubmit" value="update" class="btn btn-primary">
	</div>
	</form>
	</div>
	</div>
	</div>

@endsection
