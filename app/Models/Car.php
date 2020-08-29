<?php namespace App\Models;
/**
 * 
 */
class Car extends Model
{
	protected $table = 'cars';
	protected $fillable = ['brand_id', 'model_name', 'image', 'price', 'sale_price', 'detail', 'quantity'];

	public function brand()
	{
		return $this->hasOne('App\Models\Brand', 'id', 'brand_id');
	}
}