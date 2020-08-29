<?php namespace App\Models;
/**
 * 
 */
class Brand extends Model
{
	protected $fillable = ['brand_name', 'country'];

	public function cars()
	{
		return $this->hasMany('App\Models\Car');
	}
}