@extends('layouts.default')
@section('title', 'Remove confirm')

@section('content')
<form method="POST">
	<p>Remove car {{ $car->id }} - {{ $car->model_name }}?</p>
	<a href="{{ baseUrl('cars') }}" class="btn btn-primary">Cancel</a>
	<input type="submit" name="confirm" value="Confirm" class="btn btn-outline-danger">
</form>
@endsection