<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'option_name',
        'option_value'
    ];

    /**
     * Get Option
     *
     * @param $option_name
     * @param null $option_value
     * @return mixed|null
     */
    public static function get_option($option_name, $option_value = null ) {
		$return = self::where('option_name', $option_name)->pluck('option_value')->first();
        return !$return ? $option_value : $return;
    }

    /**
     * Update Option
     *
     * @param $option_name
     * @param $option_value
     * @return mixed
     */
    public static function update_option($option_name, $option_value ) {

    	// update if already exists - create if it doesn't
    	$option = self::firstOrCreate(['option_name' => $option_name]);
    	$option->option_value = $option_value;
    	$option->save();

    	return $option;

    }
}
