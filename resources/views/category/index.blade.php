@extends('template')
@section('content')
<h1>Category Form</h1>
	<table border="1" cellspacing="0" cellpadding="10">
		<thead>

		<tr>
			<th>No.</th>
			<th>Name</th>
		</tr>
	</thead>
	<tbody>
		@foreach($categories as $row)
		<tr>
			<td>{{$row->id}}</td>
			<td>{{$row->name}}</td>
		 <td>
             <a href="{{route('category.edit',$row->id)}}" class="btn btn-primary">Edit</a>
        </td> 
        <td>
			<form method="post" action="{{route('category.destroy',$row->id)}}" >
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger float-right mx-2" value="delete" onclick="return confirm('Are you sure')">
           
        </form>
        </td>
		</tr>
		@endforeach
		</tbody>
	</table>
@endsection