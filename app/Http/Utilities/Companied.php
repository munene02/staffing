<?php

namespace App\Http\Utilities;
use App\Company;

class Companied{
	protected static $companied;

	public static function companied()
	{
		$companied = Company::all();
		return $companied;
	}
}
