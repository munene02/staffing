<?php

namespace App\Http\Controllers;


use App\Raincoat;
use App\RaincoatChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RaincoatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('index');
        $raincoats = Raincoat::orderBy('company','asc')->get();
        $sum = $raincoats->sum('quantity');
        //return $raincoats;
        return view('ppe.raincoats.index', compact('raincoats', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = RaincoatChange::with('user', 'raincoat')->get();
        return view('ppe.raincoats.track', compact('tracks'));
    }
    public function create()
    {
       //dd('create');
       return view('ppe.raincoats.create'); 
    }
    public function add(Raincoat $raincoat)
    {
        //dd('add');

        $raincoats = $raincoat;
        return view('ppe.raincoats.add', compact('raincoats')); 
    }
    public function recon()
    {
        //dd('recon');
        $raincoats = Raincoat::orderBy('company', 'asc')->get();
        return view('ppe.raincoats.recon', compact('raincoats')); 
    }
    public function addRecon(Request $request, Raincoat $raincoat)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->raincoat;

            $before = Raincoat::find($id); 
            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Raincoat Stock quantity Level is the same.');
                return redirect('/raincoats/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $raincoats = Raincoat::where('id', $id)->update(['quantity' => $request->quantity]); 

                $stock = new RaincoatChange;
                $stock->variant = 'Reconciliation';
                $stock->raincoat_id = $request->raincoat;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

                flash()->success(' Stock Reconciled', 'Raincoat Stock Quantity has been changed.');
                return redirect('/raincoats/recon');
            }
        }
        else{
               $this->validate($request, [
                'reorder_level' => 'required|numeric'
                ]);   

            $old = Raincoat::where('id', $request->raincoat)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Raincoat Stock Reorder Level is the same');
                return redirect('/raincoats/recon'); 
            }
            else
            {
                Raincoat::where('id', $request->raincoat)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Reorder Level reconcilied', 'Raincoat Stock Reorder Level has been changed');
                return redirect('/raincoats/recon');           
            }
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Raincoat $raincoat)
    {
        
        //dd('store');


        if(isset($request->reorder_level))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $raincoats = new Raincoat;

            $raincoats->color = $request->color;
            $raincoats->company = $request->company;
            $raincoats->size = $request->size;
            $raincoats->quantity = $request->quantity;
            $raincoats->reorder_level = $request->reorder_level;

            $raincoats->save();
            $after = Raincoat::orderBy('created_at', 'desc')->first();

            $stock = new RaincoatChange;
            $stock->variant = 'New';
            $stock->raincoat_id = $after->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New Raincoat Added', ' The NEW Raincoat Item has been added to stock items.');
            return redirect('/raincoats');

        }
        else // store an increment in stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->raincoat;
            $before = Raincoat::find($id); 
            $after_quantity =  $before->quantity + $request->quantity;

            $raincoats = Raincoat::where('id', $request->raincoat)->increment('quantity', $request->quantity);           

            $stock = new RaincoatChange;
            $stock->variant = 'Increment';
            $stock->raincoat_id = $request->raincoat;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' Raincoat Stock Incremented', ' '.$request->quantity.' items have been added to raincoat stock.');
            return redirect('/raincoats');
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
