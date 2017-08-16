<?php

namespace App\Http\Controllers;


use App\SafetyGoggle;
use App\SafetyGoggleChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SafetyGogglesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('index');
        $safety_goggles = SafetyGoggle::orderBy('safety_goggle','asc')->get();
        $sum = $safety_goggles->sum('quantity');
        //return $safety_goggles;
        return view('ppe.safety_goggles.index', compact('safety_goggles', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = SafetyGoggleChange::with('user', 'safetyGoggle')->get();
        return view('ppe.safety_goggles.track', compact('tracks'));
    }
    public function create()
    {
       //dd('create');
       return view('ppe.safety_goggles.create'); 
    }
    public function add()
    {
        //dd('add');
        $safety_goggles = SafetyGoggle::orderBy('safety_goggle', 'asc')->get();
        return view('ppe.safety_goggles.add', compact('safety_goggles')); 
    }
    public function recon()
    {
        //dd('recon');
        $safety_goggles = SafetyGoggle::orderBy('safety_goggle', 'asc')->get();
        return view('ppe.safety_goggles.recon', compact('safety_goggles')); 
    }
    public function addRecon(Request $request, SafetyGoggle $safety_goggle)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->safety_goggle;

            $before = SafetyGoggle::find($id); 
            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Safety Goggle Stock quantity Level is the same.');
                return redirect('/safety_goggles/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $safety_goggles = SafetyGoggle::where('id', $id)->update(['quantity' => $request->quantity]); 

                $stock = new SafetyGoggleChange;
                $stock->variant = 'Reconciliation';
                $stock->safety_goggle_id = $request->safety_goggle;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

                flash()->success(' Stock Reconciled', 'SafetyGoggle Stock Quantity has been changed.');
                return redirect('/safety_goggles/recon');
            }
        }
        else{
               $this->validate($request, [
                'reorder_level' => 'required|numeric'
                ]);   

            $old = SafetyGoggle::where('id', $request->safety_goggle)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Safety Goggle Stock Reorder Level is the same');
                return redirect('/safety_goggles/recon'); 
            }
            else
            {
                SafetyGoggle::where('id', $request->safety_goggle)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Reorder Level Reconcilied', 'Safety Goggle Stock Reorder Level has been changed');
                return redirect('/safety_goggles/recon');           
            }
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SafetyGoggle $safety_goggle)
    {
        
        //dd('store');

        if(isset($request->reorder_level))  //store new stock
        {
            $this->validate($request, [
                'safety_goggle' => 'required',
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $safety_goggles = new SafetyGoggle;

            $safety_goggles->safety_goggle = $request->safety_goggle;
            $safety_goggles->quantity = $request->quantity;
            $safety_goggles->reorder_level = $request->reorder_level;

            $safety_goggles->save();
            $after = SafetyGoggle::orderBy('created_at', 'desc')->first();

            $stock = new SafetyGoggleChange;
            $stock->variant = 'New';
            $stock->safety_goggle_id = $after->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New SafetyGoggle Added', ' The NEW SafetyGoggle Item '.$request->safety_goggle.' has been added to stock items.');
            return redirect('/safety_goggles');

        }
        else // store an increment in stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->safety_goggle;
            $before = SafetyGoggle::find($id); 
            $after_quantity =  $before->quantity + $request->quantity;

            $safety_goggles = SafetyGoggle::where('id', $request->safety_goggle)->increment('quantity', $request->quantity);           

            $stock = new SafetyGoggleChange;
            $stock->variant = 'Increment';
            $stock->safety_goggle_id = $request->safety_goggle;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' SafetyGoggle Stock Incremented', ' '.$request->quantity.' items have been added to safety_goggle stock.');
            return redirect('/safety_goggles');
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('edit');
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
        dd('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('destroy');
    }
}
