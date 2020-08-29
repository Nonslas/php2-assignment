<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<!-- <script src="{{ ASSET_URL }}/plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap -->
<!-- <script src="{{ ASSET_URL }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
overlayScrollbars
<script src="{{ ASSET_URL }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
AdminLTE App
<script src="{{ ASSET_URL }}/dist/js/adminlte.js"></script>

OPTIONAL SCRIPTS
<script src="{{ ASSET_URL }}/dist/js/demo.js"></script>

PAGE PLUGINS
jQuery Mapael
<script src="{{ ASSET_URL }}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{ ASSET_URL }}/plugins/raphael/raphael.min.js"></script>
<script src="{{ ASSET_URL }}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{ ASSET_URL }}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
ChartJS
<script src="{{ ASSET_URL }}plugins/chart.js/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>

PAGE SCRIPTS
<script src="{{ ASSET_URL }}/dist/js/pages/dashboard2.js"></script> -->

<script type="text/javascript">
	jQuery.validator.addMethod('extension', (value, element) => {
		if (value == "") return true;
		const extension = value.split(".").reverse()[0];
		return ['jpg', 'jpeg', 'png'].includes(extension);
	});

	const previewFile = input => {
		preview.innerHTML = '';

		const [file] = input.files;

		if (file == undefined) {
			preview.innerHTML = defaultImg;
		} else {
			const preview = document.querySelector('#preview');
			const reader = new FileReader();
			reader.onload = e => {
				const extension = file.name.split('.').reverse()[0];
				console.log(extension);
				if (['jpg', 'jpeg', 'png'].includes(extension)) {
					const img = document.createElement('img');
					img.classList.add('img-fluid');
					img.src = e.target.result
					preview.append(img);
				} else {
					preview.innerHTML = '<div class="alert alert-danger">Accept jpg/jpeg/png only</div>';
				}
			}
			reader.readAsDataURL(file);
		}
	}
</script>

@yield('script')