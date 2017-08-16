<?php

namespace App\Http\Controllers;


use App\EarPlug;
use App\EarPlugChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EarPlugsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('index');
        $ear_plugs = EarPlug::orderBy('ear_plug','asc')->get();
        $sum = $ear_plugs->sum('quantity');
        //return $ear_plugs;
        return view('ppe.ear_plugs.index', compact('ear_plugs', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = EarPlugChange::with('user', 'earPlug')->get();
        return view('ppe.ear_plugs.track', compact('tracks'));
    }
    public function create()
    {
       //dd('create');
       return view('ppe.ear_plugs.create'); 
    }
    public function add()
    {
        //dd('add');
        $ear_plugs = EarPlug::orderBy('ear_plug', 'asc')->get();
        return view('ppe.ear_plugs.add', compact('ear_plugs')); 
    }
    public function recon()
    {
        //dd('recon');
        $ear_plugs = EarPlug::orderBy('ear_plug', 'asc')->get();
        return view('ppe.ear_plugs.recon', compact('ear_plugs')); 
    }
    public function addRecon(Request $request, EarPlug $ear_plug)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->ear_plug;

            $before = EarPlug::find($id); 
            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Ear Plug Stock quantity Level is the same.');
                return redirect('/ear_plugs/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $ear_plugs = EarPlug::where('id', $id)->update(['quantity' => $request->quantity]); 

                $stock = new EarPlugChange;
                $stock->variant = 'Reconciliation';
                $stock->ear_plug_id = $request->ear_plug;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

                flash()->success(' Stock Reconciled', 'Ear Plug Stock Quantity has been changed.');
                return redirect('/ear_plugs/recon');
            }
        }
        else{
               $this->validate($request, [
                'reorder_level' => 'required|numeric'
                ]);   

            $old = EarPlug::where('id', $request->ear_plug)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Ear Plug Stock Reorder Level is the same');
                return redirect('/ear_plugs/recon'); 
            }
            else
            {
                EarPlug::where('id', $request->ear_plug)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Reorder Level Reconcilied', 'Ear Plug Stock Reorder Level has been changed');
                return redirect('/ear_plugs/recon');           
            }
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, EarPlug $ear_plug)
    {
        
        //dd('store');

        if(isset($request->reorder_level))  //store new stock
        {
            $this->validate($request, [
                'ear_plug' => 'required',
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $ear_plugs = new EarPlug;

            $ear_plugs->ear_plug = $request->ear_plug;
            $ear_plugs->quantity = $request->quantity;
            $ear_plugs->reorder_level = $request->reorder_level;

            $ear_plugs->save();
            $after = EarPlug::orderBy('created_at', 'desc')->first();

            $stock = new EarPlugChange;
            $stock->variant = 'New';
            $stock->ear_plug_id = $after->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New Ear Plug Added', ' The NEW Ear Plug Item '.$request->ear_plug.' has been added to stock items.');
            return redirect('/ear_plugs');

        }
        else // store an increment in stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->ear_plug;
            $before = EarPlug::find($id); 
            $after_quantity =  $before->quantity + $request->quantity;

            $ear_plugs = EarPlug::where('id', $request->ear_plug)->increment('quantity', $request->quantity);           

            $stock = new EarPlugChange;
            $stock->variant = 'Increment';
            $stock->ear_plug_id = $request->ear_plug;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' Ear Plug Stock Incremented', ' '.$request->quantity.' items have been added to ear_plug stock.');
            return redirect('/ear_plugs');
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
