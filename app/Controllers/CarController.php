<?php namespace App\Controllers;

use App\Models\Brand;
use App\Models\Car;
/**
 * 
 */
class CarController extends BaseController
{
	
	public function list()
	{
		$q = $_GET['q'] ?? null;
		if (empty($q)) {
			$cars = Car::all();
		} else {
			$cars = Car::join('brands', 'cars.brand_id', '=', 'brands.id')
			->where('model_name', 'like', '%'.$q.'%')
			->orWhere('brand_name', 'like', '%'.$q.'%')
			->get();
		}
		$this->render('cars.index', ['cars' => $cars]);
	}

	public function add_get()
	{
		$this->render('cars.add', [
			'brands' => Brand::all()
		]);
	}

	public function add_post()
	{
		$car = new Car;
		$car->fill($_POST);

		try {
			if (hasUpload('image')) {
				if ($path = getUpload('image')) {
					$car->image = $path;
				}
			}

			if ($car->save()) {
				$message = 'Thêm thành công';
			}

			header('Location: ' . baseUrl('/cars?m=') . $message);
		} catch (\Exception $e) {
			if ($e->getCode() == 101) {
				$message = 'Ảnh không hợp lệ';
			}
			header('Location: ?m='.$message);
		}

	}

	public function edit_get(int $carId)
	{
		$car = Car::find($carId);
		
		$this->render('cars.edit', [
			'brands' => Brand::all(),
			'car' => $car
		]);
	}

	public function edit_post(int $carId)
	{
		$car = Car::find($carId);
		$car->fill($_POST);
		try {
			if (hasUpload('image')) {
				if ($path = getUpload('image')) {
					$car->image = $path;
				}
			}
		} catch (\Exception $e) {
			if ($e->getCode() == 101)
				$message = 'Ảnh không hợp lệ';
			header('Location: ?m='.$message);
		}

		if ($car->save())
			$message = 'Sửa thành công';

		header('Location: ' . baseUrl('/cars?m=') . $message);
	}

	public function remove_get(int $carId)
	{
		$this->render('cars.remove', ['car' => Car::find($carId)]);
	}

	public function remove_post(int $carId)
	{
		$message = 'Xóa thất bại';
		if (isset($_POST['confirm'])) {
			if (Car::destroy($carId))
				$message = 'Xóa thành công';
		}
		header('Location: ' . baseUrl('/cars?m=') . $message);
	}
}