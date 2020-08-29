@extends('layouts/default')
@section('title', 'Add car')

@section('content')
<form method="POST" id="saveForm" enctype="multipart/form-data">
<div class="row">
	<div class="col-6">
		<div class="form-group">
			<label>Model name</label>
			<input type="text" name="model_name" class="form-control">
		</div>

		<div class="form-group">
			<label>Brand</label>
			<select name="brand_id" id="" class="form-control">
				@foreach ($brands as $brand)
					<option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="">Price</label>
			<input type="text" name="price" class="form-control" value="0">
		</div>

		<div class="form-group">
			<label for="">Sale price</label>
			<input type="text" name="sale_price" class="form-control" value="0">
		</div>

		<div class="form-group">
			<label for="">Quantity</label>
			<input type="text" name="quantity" class="form-control" value="0">
		</div>

		<div class="form-group">
			<label for="">Detail</label>
			<textarea name="detail" id="" cols="30" rows="10" class="form-control"></textarea>
		</div>

		<button class="btn btn-outline-primary">Add</button>
	</div>
	<div class="col-6">
		<label for="">Image</label>
		<div id="preview">
			<img style="width: 100%" src="{{ baseUrl('assets/images/default-img.jpg') }}" alt="">
		</div>
		<div class="form-group">
			<div class="input-group my-3">
				<div class="input-group-prepend">
			    	<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
			  	</div>
			  	<div class="custom-file d-block">
				    <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="previewFile(this)">
			    	<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
			  </div>
			</div>
		</div>
	</div>
</div>
</form>
@endsection

@section('script')
<script>
	$(document).ready(() => {
		const price = document.querySelector('input[name="price"]');

		jQuery.validator.addMethod('salePrice', (value, element) => Number(element.value) == 0 || Number(element.value) < Number(price.value), 'Sale price must less than price');

		$("#saveForm").validate({
			rules: {
				model_name: {
					required: true
				},
				price: {
					required: true,
					number: true,
					min: 0
				},
				sale_price: {
					required: false,
					number: true,
					salePrice: true,
					min: 0
				},
				quantity: {
					required: true,
					number: true,
					min: 0
				},
				image: {
					required: true,
					extension: true
				}
			},
			messages: {
				logo: {
					extension: 'Accept image: jpg/jpeg/png'
				}
			}
		});
	});

	const defaultImg = preview.innerHTML;
</script>
@endsection