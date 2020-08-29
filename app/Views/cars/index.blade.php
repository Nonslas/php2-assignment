@extends('layouts/default')
@section('title', 'Cars')

@section('content')
	<div>{{ $_GET['m'] ?? '' }}</div>
	<div class="py-2">
	</div>
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Brand</th>
				<th>Image</th>
				<th>Price</th>
				<th>Sale price</th>
				<th>Quantity</th>
				<th><a href="{{ BASE_URL . '/cars/add' }}" class="btn btn-outline-primary">Add car</a></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($cars as $car)
			<tr>
				<td>{{ $car->id }}</td>
				<td>{{ $car->model_name }}</td>
				<td>{{ $car->brand->brand_name }}</td>
				<td><img src="{{ $car->image }}" style="height: 50px"></td>
				<td>{{ $car->price }}</td>
				<td>{{ $car->sale_price }}</td>
				<td>{{ $car->quantity }}</td>
				<td>
					<a href="{{ BASE_URL . '/cars/' . $car->id . '/edit' }}" class="btn btn-outline-primary">Edit</a>
					<a href="{{ BASE_URL . '/cars/' . $car->id . '/remove' }}" class="btn btn-outline-danger">Remove</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@endsection