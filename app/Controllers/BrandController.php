<?php namespace App\Controllers;

use App\Models\Brand;

/**
 * 
 */
class BrandController extends BaseController
{
	
	public function index()
	{
		$q = $_GET['q'] ?? null;
		$brands = empty($q) ? Brand::all() : Brand::where('brand_name', 'like', '%'.$q.'%')->get();
		$this->render('brands.index', ['brands' => $brands]);
	}

	public function add_get()
	{
		$this->render('brands.add');
	}

	public function add_post()
	{
		$message = 'Có gì đó không đúng';

		$brand = new Brand;
		$brand->fill($_POST);

		try {
			if (hasUpload('logo')) {
				if ($path = getUpload('logo')) {
					$brand->logo = $path;
				}
			}

			if ($brand->save()) {
				$message = 'Thêm thành công';
			}

			header('Location: ' . baseUrl('/brands?m=') . $message);
		} catch (\Exception $e) {
			if ($e->getCode() == 101)
				$message = 'Ảnh không hợp lệ';
			header('Location: ?m='.$message);
		}
	}

	public function edit_get($brandId)
	{
		$brand = Brand::find($brandId);
		$this->render('brands.edit', ['brand' => $brand]);
	}

	public function edit_post($brandId)
	{
		$brand = Brand::find($brandId);
		$brand->fill($_POST);
		try {
			if (hasUpload('logo')) {
				if ($path = getUpload('logo')) {
					$brand->logo = $path;
				}
			}
		} catch (\Exception $e) {
			if ($e->getCode() == 101)
				$message = 'Ảnh không hợp lệ';
			header('Location: ?m='.$message);
		}

		if ($brand->save())
			$message = 'Sửa thành công';

		header('Location: ' . baseUrl('/brands?m=') . $message);
	}

	public function remove_get($brandId)
	{
		$this->render('brands.remove', ['brand' => Brand::find($brandId)]);
	}

	public function remove_post($brandId)
	{
		$message = 'Xóa thất bại';
		if (isset($_POST['confirm'])) {
			$brand = Brand::find($brandId);
			foreach ($brand->cars as $car) {
				$car->delete();
			}
			if ($brand->delete())
				$message = 'Xóa thành công';
		}
		header('Location: ' . baseUrl('/brands?m=') . $message);
	}

	public function checkName()
	{
		$id = (int) ($_POST['id'] ?? -1);
		$name = $_POST['brand_name'] ?? null;
		if (empty($name)) exit('false');

		$model = Brand::where('brand_name', trim($name));
		if ($id) $model->where('id', '!=', $id);
		echo is_null($model->first()) ? 'true' : 'false';
	}
}