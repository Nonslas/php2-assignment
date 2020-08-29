@extends('layouts/default')
@section('title', 'Edit brand')

@section('content')
	{{ $_GET['m'] ?? '' }}
	<form method="POST" enctype="multipart/form-data" id="saveForm">
		<div class="row">
			<div class="col-6">
				<div class="form-group">
					<label for="">Name</label>
					<input type="text" class="form-control" name="brand_name" value="{{ $brand->brand_name }}">
				</div>

				<div class="form-group">
					<label for="">Logo</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
					    	<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
					  	</div>
					  	<div class="custom-file d-block">
						    <input type="file" name="logo" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="previewFile(this)">
					    	<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
					  </div>
					</div>
				</div>

				<div class="form-group">
					<label for="">Country</label>
					<input type="text" class="form-control" name="country" value="{{ $brand->country }}">
				</div>
				
				<div class="text-right">
					<button type="reset" class="btn btn-link">Reset</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</div>
			<div class="col-6">
				<div id="preview">
					<img src="{{ baseUrl($brand->logo ?? 'assets/images/default-img.jpg') }}" style="width: 100%" alt="">
				</div>
			</div>
		</div>
	</form>
@endsection

@section('script')
<script>
	$("#saveForm").validate({
		rules: {
			brand_name: {
				required: true,
				remote: {
					url: '{{ baseUrl('brands/check-name') }}',
					type: 'POST',
					data: {
						id: {{ $brand->id }},
						brand_name: () => $("input[name='brand_name']").val()
					}
				}
			},
			logo: {
				required: false,
				extension: true
			},
			country: {
				required: true
			}
		},
		messages: {
			logo: {
				extension: 'Accept image: jpg/jpeg/png'
			}
		}
	});

	const defaultImg = preview.innerHTML;
	
</script>
@endsection