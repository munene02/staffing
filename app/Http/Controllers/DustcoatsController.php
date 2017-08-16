<?php

namespace App\Http\Controllers;


use App\Dustcoat;
use App\DustcoatChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DustcoatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('index');
        $dustcoats = Dustcoat::orderBy('company','asc')->get();
        $sum = $dustcoats->sum('quantity');
        //return $dustcoats;
        return view('ppe.dustcoats.index', compact('dustcoats', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = DustcoatChange::with('user', 'dustcoat')->get();
        return view('ppe.dustcoats.track', compact('tracks'));
    }
    public function create()
    {
       //dd('create');
       return view('ppe.dustcoats.create'); 
    }
    public function add(Dustcoat $dustcoat)
    {
        //dd('add');

        $dustcoats = $dustcoat;
        return view('ppe.dustcoats.add', compact('dustcoats')); 
    }
    public function recon()
    {
        //dd('recon');
        $dustcoats = Dustcoat::orderBy('company', 'asc')->get();
        return view('ppe.dustcoats.recon', compact('dustcoats')); 
    }
    public function addRecon(Request $request, Dustcoat $dustcoat)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->dustcoat;

            $before = Dustcoat::find($id); 
            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Dustcoat Stock quantity Level is the same.');
                return redirect('/dustcoats/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $dustcoats = Dustcoat::where('id', $id)->update(['quantity' => $request->quantity]); 

                $stock = new DustcoatChange;
                $stock->variant = 'Reconciliation';
                $stock->dustcoat_id = $request->dustcoat;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

                flash()->success(' Stock Reconciled', 'Dustcoat Stock Quantity has been changed.');
                return redirect('/dustcoats/recon');
            }
        }
        else{
               $this->validate($request, [
                'reorder_level' => 'required|numeric'
                ]);   

            $old = Dustcoat::where('id', $request->dustcoat)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Dustcoat Stock Reorder Level is the same');
                return redirect('/dustcoats/recon'); 
            }
            else
            {
                Dustcoat::where('id', $request->dustcoat)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Reorder Level reconcilied', 'Dustcoat Stock Reorder Level has been changed');
                return redirect('/dustcoats/recon');           
            }
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Dustcoat $dustcoat)
    {
        
        //dd('store');


        if(isset($request->reorder_level))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $dustcoats = new Dustcoat;

            $dustcoats->color = $request->color;
            $dustcoats->company = $request->company;
            $dustcoats->size = $request->size;
            $dustcoats->quantity = $request->quantity;
            $dustcoats->reorder_level = $request->reorder_level;

            $dustcoats->save();
            $after = Dustcoat::orderBy('created_at', 'desc')->first();

            $stock = new DustcoatChange;
            $stock->variant = 'New';
            $stock->dustcoat_id = $after->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New Dustcoat Added', ' The NEW Dustcoat Item has been added to stock items.');
            return redirect('/dustcoats');

        }
        else // store an increment in stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->dustcoat;
            $before = Dustcoat::find($id); 
            $after_quantity =  $before->quantity + $request->quantity;

            $dustcoats = Dustcoat::where('id', $request->dustcoat)->increment('quantity', $request->quantity);           

            $stock = new DustcoatChange;
            $stock->variant = 'Increment';
            $stock->dustcoat_id = $request->dustcoat;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' Dustcoat Stock Incremented', ' '.$request->quantity.' items have been added to dustcoat stock.');
            return redirect('/dustcoats');
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
