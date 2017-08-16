<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
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
use App\BootChange;
use App\GloveChange;
use App\HelmetChange;
use App\MaskChange;
use App\SafetyGoggleChange;
use App\OverallChange;
use App\ReflectorJacketChange;
use App\ApronChange;
use App\RaincoatChange;
use App\DustcoatChange;
use App\ChinStrapChange;
use App\EarPlugChange;
use App\TshirtChange;
use App\CapChange;
use App\SweaterChange;
use App\ShirtChange;
use App\BlouseChange;
use App\ReflectorRollChange;
use App\TrouserChange;
use App\Requisition;
use App\AmendRequisition;
use App\RequisitionDetail;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class RequisitionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
                'link'  => 'gloves',
                'total' => $glovesTotal,
                'title' => 'Gloves'
            ],
            '2' => [
                'link'  => 'boots',
                'total' => $bootsTotal,
                'title' => 'Boots'
            ],
            '3' => [
                'link'  => 'helmets',
                'total' => $helmetsTotal,
                'title' => 'Helmets'
            ],
            '4' => [
                'link'  => 'masks',
                'total' => $masksTotal,
                'title' => 'Masks'
            ],
            '5' => [
                'link'  => 'safety_goggles',
                'total' => $safety_gogglesTotal,
                'title' => 'Safety Goggles'
            ],
            '6' => [
                'link'  => 'overalls',
                'total' => $overallsTotal,
                'title' => 'Overalls'
            ],
            '7' => [
                'link'  => 'reflector_jackets',
                'total' => $reflector_jacketsTotal,
                'title' => 'Reflector Jackets'
            ],
            '8' => [
                'link'  => 'aprons',
                'total' => $apronsTotal,
                'title' => 'Aprons'
            ],
            '9' => [
                'link'  => 'raincoats',
                'total' => $raincoatsTotal,
                'title' => 'Raincoats'
            ],
            '10' => [
                'link'  => 'dustcoats',
                'total' => $dustcoatsTotal,
                'title' => 'Dustcoats'
            ],
            '11' => [
                'link'  => 'chinstraps',
                'total' => $chinstrapsTotal,
                'title' => 'Chinstraps'
            ],
            '12' => [
                'link'  => 'ear_plugs',
                'total' => $ear_plugsTotal,
                'title' => 'Ear Plugs'
            ],
            '13' => [
                'link'  => 'tshirts',
                'total' => $tshirtsTotal,
                'title' => 'Tshirts'
            ],
            '14' => [
                'link'  => 'caps',
                'total' => $capsTotal,
                'title' => 'Caps'
            ],
            '15' => [
                'link'  => 'sweaters',
                'total' => $sweatersTotal,
                'title' => 'Sweaters'
            ],
            '16' => [
                'link'  => 'shirts',
                'total' => $shirtsTotal,
                'title' => 'Shirts'
            ],
            '17' => [
                'link'  => 'blouses',
                'total' => $blousesTotal,
                'title' => 'Blouses'
            ],
            '18' => [
                'link'  => 'reflector_rolls',
                'total' => $reflector_rollsTotal,
                'title' => 'Reflector Rolls'
            ],
            '19' => [
                'link'  => 'trousers',
                'total' => $trousersTotal,
                'title' => 'Trousers'
            ]

        ];
        return view('ppe.requisitions.index')->with(['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        $details = RequisitionDetail::with('user')->where(['user_id' => Auth::id(), 'action' => 'not_submitted'])->orderBY('created_at', 'desc')->get();

        return view('ppe.requisitions.form', compact('details'));

    }
    //cancel requisitions
    public function cancel(RequisitionDetail $id)
    {       
        RequisitionDetail::where('id', $id->id)->update(['action' => 'cancelled']); 
        flash()->info('Requisition Detail Cancelled', 'Your Requisition for '.$id->quantity.' '.$id->stock_name.' has been cancelled.');
        return redirect('/requisitions/form');
    }
    //submit requisitions
    public function submit(RequisitionDetail $id)
    {        
        RequisitionDetail::where('id', $id->id)->update(['action' => 'submitted']); 

        $requisition = new Requisition;
        $requisition->requisition_detail_id = $id->id;
        $requisition->status = 'pending';
        $requisition->user_id = 0;

        $requisition->save();

        flash()->success('Requisition Detail Submitted', 'Your Request for '.$id->quantity.' '.$id->stock_name.' has been submitteded.');
        return redirect('/requisitions/form');
    }
    //approve requisitions
    public function approve(Requisition $id, RequisitionDetail $iid)
    {
        //return $iid;
        Requisition::where('id', $id->id)->update(['status' => 'approved', 'user_id' => Auth::id()]); 

        if($iid->stock_name == 'aprons'){

            $before = Apron::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            Apron::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new ApronChange;
            $stock->variant = 'Requisition';
            $stock->apron_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        elseif($iid->stock_name == 'blouses'){

            $before = Blouse::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            Blouse::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new BlouseChange;
            $stock->variant = 'Requisition';
            $stock->blouse_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        elseif($iid->stock_name == 'boots'){

            $before = Boot::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            Boot::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new BootChange;
            $stock->variant = 'Requisition';
            $stock->boot_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        elseif($iid->stock_name == 'caps'){

            $before = Cap::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            Cap::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new CapChange;
            $stock->variant = 'Requisition';
            $stock->cap_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        elseif($iid->stock_name == 'chinstraps'){

            $before = Chinstrap::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            Chinstrap::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new ChinstrapChange;
            $stock->variant = 'Requisition';
            $stock->chinstrap_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        elseif($iid->stock_name == 'dustcoats'){

            $before = Dustcoat::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            Dustcoat::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new DustcoatChange;
            $stock->variant = 'Requisition';
            $stock->dustcoat_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        elseif($iid->stock_name == 'ear_plugs'){

            $before = EarPlug::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            EarPlug::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new EarPlugChange;
            $stock->variant = 'Requisition';
            $stock->ear_plug_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        elseif($iid->stock_name == 'gloves'){

            $before = Glove::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            Glove::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new GloveChange;
            $stock->variant = 'Requisition';
            $stock->glove_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        elseif($iid->stock_name == 'helmets'){

            $before = Helmet::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            Helmet::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new HelmetChange;
            $stock->variant = 'Requisition';
            $stock->helmet_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        elseif($iid->stock_name == 'masks'){

            $before = Mask::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            Mask::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new MaskChange;
            $stock->variant = 'Requisition';
            $stock->mask_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        elseif($iid->stock_name == 'overalls'){

            $before = Overall::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            Overall::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new OverallChange;
            $stock->variant = 'Requisition';
            $stock->overall_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        elseif($iid->stock_name == 'raincoats'){

            $before = Raincoat::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            Raincoat::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new RaincoatChange;
            $stock->variant = 'Requisition';
            $stock->raincoat_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        elseif($iid->stock_name == 'reflector_jackets'){

            $before = ReflectorJacket::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            ReflectorJacket::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new ReflectorJacketChange;
            $stock->variant = 'Requisition';
            $stock->reflector_jacket_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        elseif($iid->stock_name == 'reflector_rolls'){

            $before = reflectorRoll::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            reflectorRoll::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new reflectorRollChange;
            $stock->variant = 'Requisition';
            $stock->reflector_roll_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        elseif($iid->stock_name == 'safety_goggles'){

            $before = SafetyGoggle::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            SafetyGoggle::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new SafetyGoggleChange;
            $stock->variant = 'Requisition';
            $stock->safety_goggle_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        elseif($iid->stock_name == 'shirtss'){

            $before = Shirt::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            Shirt::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new ShirtChange;
            $stock->variant = 'Requisition';
            $stock->shirt_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        elseif($iid->stock_name == 'sweaters'){

            $before = Sweater::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            Sweater::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new SweaterChange;
            $stock->variant = 'Requisition';
            $stock->sweater_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        elseif($iid->stock_name == 'trousers'){

            $before = Trouser::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            Trouser::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new TrouserChange;
            $stock->variant = 'Requisition';
            $stock->trouser_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        elseif($iid->stock_name == 'tshirts'){

            $before = Tshirt::find($iid->stock_id); 
            
            $after_quantity = $before->quantity - $iid->quantity ;

            Tshirt::where('id', $iid->stock_id)->update(['quantity' => $after_quantity]); 

            $stock = new TshirtChange;
            $stock->variant = 'Requisition';
            $stock->tshirt_id = $iid->stock_id;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $iid->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success('Requisition Approved', 'The Request for '.$iid->quantity.' '.$iid->stock_name.' has been approved.');
            return redirect('/requisitions/system');
        }
        
    }
    //didmissed requisition
    public function deny(Requisition $id)
    {
        Requisition::where('id', $id->id)->update(['status' => 'denied', 'user_id' => Auth::id()]); 
        flash()->error('Requisition Denied', 'The Request for '.$id->quantity.' '.$id->stock_name.' has been denied.');
        return redirect('/requisitions/system');

    }
    //view requisitions for a particular user
    public function my()
    {
        //dd('my');
        $details = RequisitionDetail::with('requisition')->where('user_id', Auth::id())->orderBY('created_at', 'desc')->get()->groupby('action');
        return view('ppe.requisitions.my', compact('details'));

    }
    public function system()
    {
        //dd('my');
        $details = Requisition::with('user','requisitionDetail', 'requisitionDetail.user')->orderBY('created_at', 'desc')->get()->groupby('status');
        //return $details;
        return view('ppe.requisitions.system', compact('details'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $requisitionDeatil = new RequisitionDetail;
            $requisitionDeatil->stock_id = $request->stock_id;
            $requisitionDeatil->stock_name = $request->stock_name;
            $requisitionDeatil->stock_details = $request->stock_details;
            $requisitionDeatil->quantity = $request->quantity;
            $requisitionDeatil->action = 'not_submitted';
            $requisitionDeatil->user_id = Auth::id();

            $requisitionDeatil->save();
     
            flash()->success('Requisition Detail Added', $request->quantity.' '.$request->stock_name.' have been added to the Requisition form.');
            return redirect('/requisitions/'.$request->stock_name);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id=='aprons')
        {
            $items = Apron::orderBy('company','asc')->get();
        }
        elseif($id=='blouses')
        {
            $items = Blouse::orderBy('created_at','asc')->get();
        }
        elseif($id=='boots')
        {
            $items = Brand::with('boots.shoeSize', 'boots.bootHeight')->orderBY('brand', 'asc')->get();
        }
        elseif($id=='caps')
        {
            $items = Cap::orderBy('color','asc')->get();
        }
        elseif($id=='chinstraps')
        {
            $items = Chinstrap::orderBy('chinstrap','asc')->get();
        }
        elseif($id=='dustcoats')
        {
            $items = Dustcoat::orderBy('company','asc')->get();
        }
        elseif($id=='ear_plugs')
        {
            $items = EarPlug::orderBy('ear_plug','asc')->get();
        }
        elseif($id=='gloves')
        {
            $items = Glove::orderBy('glove','asc')->get();
        }
        elseif($id=='helmets')
        {
            $items = Helmet::orderBy('helmet','asc')->get();
        }
        elseif($id=='masks')
        {
            $items = Mask::orderBy('mask','asc')->get();
        }
        elseif($id=='overalls')
        {
            $items = Overall::orderBy('company','asc')->get();
        }
        elseif($id=='raincoats')
        {
            $items = Raincoat::orderBy('company','asc')->get();
        }
        elseif($id=='reflector_jackets')
        {
            $items = ReflectorJacket::orderBy('company','asc')->get();
        }
        elseif($id=='reflector_rolls')
        {
            $items = ReflectorRoll::orderBy('reflector_roll','asc')->get();
        }
        elseif($id=='safety_goggles')
        {
            $items = SafetyGoggle::orderBy('safety_goggle','asc')->get();
        }
        elseif($id=='shirts')
        {
            $items = Shirt::orderBy('color','asc')->get();
        }
        elseif($id=='sweaters')
        {
            $items = Sweater::orderBy('color','asc')->get();
        }
        elseif($id=='trousers')
        {
            $items = Trouser::orderBy('color','asc')->get();
        }
        elseif($id=='tshirts')
        {
            $items = Tshirt::orderBy('color','asc')->get();
        }
        else{
            return redirect('/requisitions');
        }

        return view('ppe.requisitions.show', compact('items', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
