<?php

namespace App;

use Marquine\ActivityLog\Loggable;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
	use Loggable;
    protected $fillable = ['name', 'code','rate'];
	
	public static function calculateAmount($rateFrom, $rateTo, $amount)
	{
		$returnAmount =  ($rateTo / $rateFrom) * $amount;
		$unitAmount = $returnAmount / $amount;
		return array("unitAmount"=>round($unitAmount,2),"total"=>round($returnAmount,2));
	}
}
