<?php

namespace App\Http\Utilities;
use App\Variant;

class Varianted{
	protected static $varianted;

	public static function varianted()
	{
		$varianted = Variant::all();
		return $varianted;
	}
}
