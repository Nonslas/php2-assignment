@extends('layouts/default')
@section('title', 'Brands')

@section('content')
<div>{{ $_GET['m'] ?? '' }}</div>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Country</th>
			<th>Logo</th>
			<th>
				<a href="{{ BASE_URL . '/brands/add' }}" class="btn btn-outline-primary">Add brand</a>
			</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($brands as $brand)
		<tr>
			<td>{{ $brand->id }}</td>
			<td>{{ $brand->brand_name }}</td>
			<td>{{ $brand->country }}</td>
			<td><img src="{{ $brand->logo }}" style="height: 50px"></td>
			<td>
				<a class="btn btn-outline-primary" href="{{ baseUrl('brands/' . $brand->id . '/edit') }}">Edit</a>
				<a class="btn btn-outline-danger" href="{{ baseUrl('brands/' . $brand->id) . '/remove'}}">Remove</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection