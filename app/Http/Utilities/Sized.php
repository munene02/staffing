<?php

namespace App\Http\Utilities;
use App\Size;

class Sized
{
	protected static $sized;

	public static function sized()
	{
		$sized = Size::all();
		return $sized;
	}
}