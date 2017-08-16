<?php

namespace App\Http\Utilities;
use App\BootHeight;

class Height{
	protected static $height;

	public static function height()
	{
		$height = BootHeight::all();
		return $height;
	}
}
