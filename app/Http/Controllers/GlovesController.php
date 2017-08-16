<?php

namespace App\Http\Controllers;


use App\Glove;
use App\GloveChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GlovesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('index');
        $gloves = Glove::orderBy('glove','asc')->get();
        $sum = $gloves->sum('quantity');
        //return $gloves;
        return view('ppe.gloves.index', compact('gloves', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = GloveChange::with('user', 'glove')->get();
        return view('ppe.gloves.track', compact('tracks'));
    }
    public function create()
    {
       //dd('create');
       return view('ppe.gloves.create'); 
    }
    public function add()
    {
        //dd('add');
        $gloves = Glove::orderBy('glove', 'asc')->get();
        return view('ppe.gloves.add', compact('gloves')); 
    }
    public function recon()
    {
        //dd('recon');
        $gloves = Glove::orderBy('glove', 'asc')->get();
        return view('ppe.gloves.recon', compact('gloves')); 
    }
    public function addRecon(Request $request, Glove $glove)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->glove;

            $before = Glove::find($id); 
            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Glove Stock quantity Level is the same.');
                return redirect('/gloves/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $gloves = Glove::where('id', $id)->update(['quantity' => $request->quantity]); 

                $stock = new GloveChange;
                $stock->variant = 'Reconciliation';
                $stock->glove_id = $request->glove;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

                flash()->success(' Stock Reconciled', 'Glove Stock Quantity has been changed.');
                return redirect('/gloves/recon');
            }

        }
        else{
               $this->validate($request, [
                'reorder_level' => 'required|numeric'
                ]);   

            $old = Glove::where('id', $request->glove)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Glove Stock Reorder Level is the same');
                return redirect('/gloves/recon'); 
            }
            else
            {
                Glove::where('id', $request->glove)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Reorder Level reconcilied', 'Glove Stock Reorder Level has been changed');
                return redirect('/gloves/recon');           
            } 
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Glove $glove)
    {
        
        //dd('store');

        if(isset($request->reorder_level))  //store new stock
        {
            $this->validate($request, [
                'glove' => 'required',
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $gloves = new Glove;

            $gloves->glove = $request->glove;
            $gloves->quantity = $request->quantity;
            $gloves->reorder_level = $request->reorder_level;

            $gloves->save();
            $after = Glove::orderBy('created_at', 'desc')->first();

            $stock = new GloveChange;
            $stock->variant = 'New';
            $stock->glove_id = $after->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New Glove Added', ' The NEW Glove Item '.$request->glove.' has been added to stock items.');
            return redirect('/gloves');

        }
        else // store an increment in stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->glove;
            $before = Glove::find($id); 
            $after_quantity =  $before->quantity + $request->quantity;

            $gloves = Glove::where('id', $request->glove)->increment('quantity', $request->quantity);           

            $stock = new GloveChange;
            $stock->variant = 'Increment';
            $stock->glove_id = $request->glove;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' Glove Stock Incremented', ' '.$request->quantity.' items have been added to glove stock.');
            return redirect('/gloves');
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
