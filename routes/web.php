<?php
use App\Client;
use App\Site;

Route::get('/', function () {
	if(Auth::user())
	{
		return redirect('/home');
	}
	else
	{
		return view('auth.login');
	}
});

Auth::routes();

Route::get('/home', 'HomeController@index');

/*Route::get('/sites/add', function () {
   
})->middleware('siteadmin');*/

Route::group(['middleware'=>['clientadmin']], function(){
	Route::get('/clients', 'ClientsController@show');
	// Route::get('/clients', function(){

	// 	$sites = Site::all();
 	//     return $sites->clients->id; 
	// });

});

Route::group(['middleware'=>['siteadmin']], function(){
	Route::get('/sites', 'SitesController@show');

});

Route::get('/ppe', 'PpeController@show');
Route::group(['middleware'=>['ppeadmin']], function(){
	
	

	//Route::get('/boots/{brand}', 'BootsController@create');
	Route::get('/boots/recon', 'BootsController@recon')->middleware('checkrole:4');
	Route::get('/boots/track', 'BootsController@track')->middleware('checkrole:9');
	Route::post('/boots/addrecon', 'BootsController@addRecon');
	Route::get('/boots/add/{brand}', 'BootsController@add')->middleware('checkrole:3');
	Route::post('/boots/{brand}/boot', 'BootsController@store');
	Route::resource('boots', 'BootsController');

	Route::get('/gloves/add', 'GlovesController@add')->middleware('checkrole:3');
	Route::get('/gloves/track', 'GlovesController@track')->middleware('checkrole:9');
	Route::get('/gloves/recon', 'GlovesController@recon')->middleware('checkrole:4');
	Route::post('/gloves/addrecon', 'GlovesController@addRecon');
	Route::resource('gloves', 'GlovesController');
	
	Route::get('/helmets/add', 'HelmetsController@add')->middleware('checkrole:3');
	Route::get('/helmets/track', 'HelmetsController@track')->middleware('checkrole:9');
	Route::get('/helmets/recon', 'HelmetsController@recon')->middleware('checkrole:4');
	Route::post('/helmets/addrecon', 'HelmetsController@addRecon');
	Route::resource('helmets', 'HelmetsController');

	Route::get('/masks/add', 'MasksController@add')->middleware('checkrole:3');
	Route::get('/masks/track', 'MasksController@track')->middleware('checkrole:9');
	Route::get('/masks/recon', 'MasksController@recon')->middleware('checkrole:4');
	Route::post('/masks/addrecon', 'MasksController@addRecon');
	Route::resource('masks', 'MasksController');

	Route::get('/safety_goggles/add', 'SafetyGogglesController@add')->middleware('checkrole:3');
	Route::get('/safety_goggles/track', 'SafetyGogglesController@track')->middleware('checkrole:9');
	Route::get('/safety_goggles/recon', 'SafetyGogglesController@recon')->middleware('checkrole:4');
	Route::post('/safety_goggles/addrecon', 'SafetyGogglesController@addRecon');
	Route::resource('safety_goggles', 'SafetyGogglesController');

	Route::get('/overalls/add/{overall}', 'OverallsController@add')->middleware('checkrole:3');
	Route::get('/overalls/track', 'OverallsController@track')->middleware('checkrole:9');
	Route::get('/overalls/recon', 'OverallsController@recon')->middleware('checkrole:4');
	Route::post('/overalls/addrecon', 'OverallsController@addRecon');
	Route::resource('overalls', 'OverallsController');

	Route::get('/reflector_jackets/add/{reflector_jacket}', 'ReflectorJacketsController@add')->middleware('checkrole:3');
	Route::get('/reflector_jackets/track', 'ReflectorJacketsController@track')->middleware('checkrole:9');
	Route::get('/reflector_jackets/recon', 'ReflectorJacketsController@recon')->middleware('checkrole:4');
	Route::post('/reflector_jackets/addrecon', 'ReflectorJacketsController@addRecon');
	Route::resource('reflector_jackets', 'ReflectorJacketsController');

	Route::get('/aprons/add/{apron}', 'ApronsController@add')->middleware('checkrole:3');
	Route::get('/aprons/track', 'ApronsController@track')->middleware('checkrole:9');
	Route::get('/aprons/recon', 'ApronsController@recon')->middleware('checkrole:4');
	Route::post('/aprons/addrecon', 'ApronsController@addRecon');
	Route::resource('aprons', 'ApronsController');

	Route::get('/raincoats/add/{raincoat}', 'RaincoatsController@add')->middleware('checkrole:3');
	Route::get('/raincoats/track', 'RaincoatsController@track')->middleware('checkrole:9');
	Route::get('/raincoats/recon', 'RaincoatsController@recon')->middleware('checkrole:4');
	Route::post('/raincoats/addrecon', 'RaincoatsController@addRecon');
	Route::resource('raincoats', 'RaincoatsController');

	Route::get('/dustcoats/add/{dustcoat}', 'DustcoatsController@add')->middleware('checkrole:3');
	Route::get('/dustcoats/track', 'DustcoatsController@track')->middleware('checkrole:9');
	Route::get('/dustcoats/recon', 'DustcoatsController@recon')->middleware('checkrole:4');
	Route::post('/dustcoats/addrecon', 'DustcoatsController@addRecon');
	Route::resource('dustcoats', 'DustcoatsController');

	Route::get('/chinstraps/add', 'ChinstrapsController@add')->middleware('checkrole:3');
	Route::get('/chinstraps/track', 'ChinstrapsController@track')->middleware('checkrole:9');
	Route::get('/chinstraps/recon', 'ChinstrapsController@recon')->middleware('checkrole:4');
	Route::post('/chinstraps/addrecon', 'ChinstrapsController@addRecon');
	Route::resource('chinstraps', 'ChinstrapsController');

	Route::get('/ear_plugs/add', 'EarPlugsController@add')->middleware('checkrole:3');
	Route::get('/ear_plugs/track', 'EarPlugsController@track')->middleware('checkrole:9');
	Route::get('/ear_plugs/recon', 'EarPlugsController@recon')->middleware('checkrole:4');
	Route::post('/ear_plugs/addrecon', 'EarPlugsController@addRecon');
	Route::resource('ear_plugs', 'EarPlugsController');

	Route::get('/tshirts/add/{tshirt}', 'TshirtsController@add')->middleware('checkrole:3');
	Route::get('/tshirts/track', 'TshirtsController@track')->middleware('checkrole:9');
	Route::get('/tshirts/recon', 'TshirtsController@recon')->middleware('checkrole:4');
	Route::post('/tshirts/addrecon', 'TshirtsController@addRecon');
	Route::resource('tshirts', 'TshirtsController');

	Route::get('/shirts/add/{shirt}', 'ShirtsController@add')->middleware('checkrole:3');
	Route::get('/shirts/track', 'ShirtsController@track')->middleware('checkrole:9');
	Route::get('/shirts/recon', 'ShirtsController@recon')->middleware('checkrole:4');
	Route::post('/shirts/addrecon', 'ShirtsController@addRecon');
	Route::resource('shirts', 'ShirtsController');

	Route::get('/blouses/add/{blouse}', 'BlousesController@add')->middleware('checkrole:3');
	Route::get('/blouses/track', 'BlousesController@track')->middleware('checkrole:9');
	Route::get('/blouses/recon', 'BlousesController@recon')->middleware('checkrole:4');
	Route::post('/blouses/addrecon', 'BlousesController@addRecon');
	Route::resource('blouses', 'BlousesController');

	Route::get('/sweaters/add/{sweater}', 'SweatersController@add')->middleware('checkrole:3');
	Route::get('/sweaters/track', 'SweatersController@track')->middleware('checkrole:9');
	Route::get('/sweaters/recon', 'SweatersController@recon')->middleware('checkrole:4');
	Route::post('/sweaters/addrecon', 'SweatersController@addRecon');
	Route::resource('sweaters', 'SweatersController');

	Route::get('/trousers/add/{trouser}', 'TrousersController@add')->middleware('checkrole:3');
	Route::get('/trousers/track', 'TrousersController@track')->middleware('checkrole:9');
	Route::get('/trousers/recon', 'TrousersController@recon')->middleware('checkrole:4');
	Route::post('/trousers/addrecon', 'TrousersController@addRecon');
	Route::resource('trousers', 'TrousersController');

	Route::get('/caps/add/{cap}', 'CapsController@add')->middleware('checkrole:3');
	Route::get('/caps/track', 'CapsController@track')->middleware('checkrole:9');
	Route::get('/caps/recon', 'CapsController@recon')->middleware('checkrole:4');
	Route::post('/caps/addrecon', 'CapsController@addRecon');
	Route::resource('caps', 'CapsController');

	Route::get('/reflector_rolls/add', 'ReflectorRollsController@add')->middleware('checkrole:3');
	Route::get('/reflector_rolls/track', 'ReflectorRollsController@track')->middleware('checkrole:9');
	Route::get('/reflector_rolls/recon', 'ReflectorRollsController@recon')->middleware('checkrole:4');
	Route::post('/reflector_rolls/addrecon', 'ReflectorRollsController@addRecon');
	Route::resource('reflector_rolls', 'ReflectorRollsController');

	
});

Route::get('/manage_users', 'ManageUsersController@index')->middleware('checkrole:8');

Route::post('/requisitions/add', 'RequisitionsController@store')->middleware('requisition');
Route::get('/requisitions/my', 'RequisitionsController@my')->middleware('requisition');

Route::get('/requisitions/cancel/{id}', 'RequisitionsController@cancel')->middleware('requisition');
Route::get('/requisitions/submit/{id}', 'RequisitionsController@submit')->middleware('requisition');

Route::get('/requisitions/approve/{id}/{iid}', 'RequisitionsController@approve')->middleware('requisition');
Route::get('/requisitions/deny/{id}', 'RequisitionsController@deny')->middleware('requisition');

Route::get('/requisitions/system', 'RequisitionsController@system')->middleware('checkrole:8');
Route::get('/requisitions/form', 'RequisitionsController@form')->middleware('requisition');
Route::get('/requisitions', 'RequisitionsController@index')->middleware('requisition');
Route::get('/requisitions/{item}', 'RequisitionsController@show')->middleware('requisition');

Route::get('/employees/create', 'EmployeesController@create')->middleware('checkrole:2');
Route::post('/employees/add', 'EmployeesController@add')->middleware('checkrole:2');


Route::get('/accessdenied', function(){
	return view('accessdenied');
});
