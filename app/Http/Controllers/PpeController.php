<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Boot;
use App\Glove;
use App\Helmet;
use App\Mask;
use App\SafetyGoggle;
use App\Overall;
use App\ReflectorJacket;
use App\Apron;
use App\Raincoat;
use App\Dustcoat;
use App\ChinStrap;
use App\EarPlug;
use App\Tshirt;
use App\Cap;
use App\Sweater;
use App\Shirt;
use App\Blouse;
use App\ReflectorRoll;
use App\Trouser;

class PpeController extends Controller
{
    public function show()
    {
    	$boots = Boot::all();
        $bootsTotal = $boots->sum('quantity');

        $gloves = Glove::all();
        $glovesTotal = $gloves->sum('quantity');

        $helmets = Helmet::all();
        $helmetsTotal = $helmets->sum('quantity');

        $masks = Mask::all();
        $masksTotal = $masks->sum('quantity');

        $safety_goggles = SafetyGoggle::all();
        $safety_gogglesTotal = $safety_goggles->sum('quantity');

        $overalls = Overall::all();
        $overallsTotal = $overalls->sum('quantity');

        $reflector_jackets = ReflectorJacket::all();
        $reflector_jacketsTotal = $reflector_jackets->sum('quantity');

        $aprons = Apron::all();
        $apronsTotal = $aprons->sum('quantity');

        $raincoats = Raincoat::all();
        $raincoatsTotal = $raincoats->sum('quantity');

        $dustcoats = Dustcoat::all();
        $dustcoatsTotal = $dustcoats->sum('quantity');

        $chinstraps = Chinstrap::all();
        $chinstrapsTotal = $chinstraps->sum('quantity');

        $ear_plugs = EarPlug::all();
        $ear_plugsTotal = $ear_plugs->sum('quantity');

        $tshirts= Tshirt::all();
        $tshirtsTotal = $tshirts->sum('quantity');

        $caps = Cap::all();
        $capsTotal = $caps->sum('quantity');

        $sweaters = Sweater::all();
        $sweatersTotal = $sweaters->sum('quantity');

        $shirts = Shirt::all();
        $shirtsTotal = $shirts->sum('quantity');

        $blouses = Blouse::all();
        $blousesTotal = $blouses->sum('quantity');

        $reflector_rolls = ReflectorRoll::all();
        $reflector_rollsTotal = $reflector_rolls->sum('quantity');

        $trousers = Trouser::all();
        $trousersTotal = $trousers->sum('quantity');

    	$items = [
    		'1' => [
    			'link'  => '/gloves',
    			'total' => $glovesTotal,
    			'title' => 'Gloves'
    		],
    		'2' => [
    			'link'  => '/boots',
    			'total' => $bootsTotal,
    			'title' => 'Boots'
    		],
    		'3' => [
    			'link'  => '/helmets',
    			'total' => $helmetsTotal,
    			'title' => 'Helmets'
    		],
    		'4' => [
    			'link'  => '/masks',
    			'total' => $masksTotal,
    			'title' => 'Masks'
    		],
    		'5' => [
    			'link'  => '/safety_goggles',
    			'total' => $safety_gogglesTotal,
    			'title' => 'Safety Goggles'
    		],
    		'6' => [
    			'link'  => '/overalls',
    			'total' => $overallsTotal,
    			'title' => 'Overalls'
    		],
    		'7' => [
    			'link'  => '/reflector_jackets',
    			'total' => $reflector_jacketsTotal,
    			'title' => 'Reflector Jackets'
    		],
    		'8' => [
    			'link'  => '/aprons',
    			'total' => $apronsTotal,
    			'title' => 'Aprons'
    		],
    		'9' => [
    			'link'  => '/raincoats',
    			'total' => $raincoatsTotal,
    			'title' => 'Raincoats'
    		],
            '10' => [
                'link'  => '/dustcoats',
                'total' => $dustcoatsTotal,
                'title' => 'Dustcoats'
            ],
            '11' => [
                'link'  => '/chinstraps',
                'total' => $chinstrapsTotal,
                'title' => 'Chinstraps'
            ],
            '12' => [
                'link'  => '/ear_plugs',
                'total' => $ear_plugsTotal,
                'title' => 'Ear Plugs'
            ],
            '13' => [
                'link'  => '/tshirts',
                'total' => $tshirtsTotal,
                'title' => 'Tshirts'
            ],
            '14' => [
                'link'  => '/caps',
                'total' => $capsTotal,
                'title' => 'Caps'
            ],
            '15' => [
                'link'  => '/sweaters',
                'total' => $sweatersTotal,
                'title' => 'Sweaters'
            ],
            '16' => [
                'link'  => '/shirts',
                'total' => $shirtsTotal,
                'title' => 'Shirts'
            ],
            '17' => [
                'link'  => '/blouses',
                'total' => $blousesTotal,
                'title' => 'Blouses'
            ],
            '18' => [
                'link'  => '/reflector_rolls',
                'total' => $reflector_rollsTotal,
                'title' => 'Reflector Rolls'
            ],
            '19' => [
                'link'  => '/trousers',
                'total' => $trousersTotal,
                'title' => 'Trousers'
            ]

    	];

    	return view('ppe.show')->with(['items' => $items]);
    	//return $bootTotal;
    }
}
