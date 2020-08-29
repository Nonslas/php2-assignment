@extends('layouts.default')
@section('title', 'Remove brand')

@section('content')
<form method="POST">
	<p>Remove brand {{ $brand->id }} - {{ $brand->brand_name }} {{ $brand->cars->count() ? 'with ' . $brand->cars->count() . ' cars' : '' }}?</p>
	<a href="{{ baseUrl('brands') }}" class="btn btn-primary">Cancel</a>
	<input type="submit" name="confirm" value="Confirm" class="btn btn-outline-danger">
</form>
@endsection