<?php

namespace App\Http\Utilities;
use App\ShoeSize;
class Size{
	protected static $size;

	public static function Size()
	{
		$size = ShoeSize::all();
		return $size;
	}
}
