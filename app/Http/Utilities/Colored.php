<?php

namespace App\Http\Utilities;
use App\Color;

class Colored{
	protected static $colored;

	public static function colored()
	{
		$colored = Color::all();
		return $colored;
	}
}
