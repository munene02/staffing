<?php

namespace App\Http\Controllers;


use App\Apron;
use App\ApronChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ApronsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('index');
        $aprons = Apron::orderBy('company','asc')->get();
        $sum = $aprons->sum('quantity');
        //return $aprons;
        return view('ppe.aprons.index', compact('aprons', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = ApronChange::with('user', 'apron')->get();
        return view('ppe.aprons.track', compact('tracks'));
    }
    public function create()
    {
       //dd('create');
       return view('ppe.aprons.create'); 
    }
    public function add(Apron $apron)
    {
        //dd('add');

        $aprons = $apron;
        return view('ppe.aprons.add', compact('aprons')); 
    }
    public function recon()
    {
        //dd('recon');
        $aprons = Apron::orderBy('company', 'asc')->get();
        return view('ppe.aprons.recon', compact('aprons')); 
    }
    public function addRecon(Request $request, Apron $apron)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->apron;

            $before = Apron::find($id); 
            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Apron Stock quantity Level is the same.');
                return redirect('/aprons/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $aprons = Apron::where('id', $id)->update(['quantity' => $request->quantity]); 

                $stock = new ApronChange;
                $stock->variant = 'Reconciliation';
                $stock->apron_id = $request->apron;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

                flash()->success(' Stock Reconciled', 'Apron Stock Quantity has been changed.');
                return redirect('/aprons/recon');
            }
        }
        else{
               $this->validate($request, [
                'reorder_level' => 'required|numeric'
                ]);   

            $old = Apron::where('id', $request->apron)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Apron Stock Reorder Level is the same');
                return redirect('/aprons/recon'); 
            }
            else
            {
                Apron::where('id', $request->apron)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Reorder Level reconcilied', 'Apron Stock Reorder Level has been changed');
                return redirect('/aprons/recon');           
            }
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Apron $apron)
    {
        
        //dd('store');


        if(isset($request->reorder_level))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $aprons = new Apron;

            $aprons->color = $request->color;
            $aprons->company = $request->company;
            $aprons->size = $request->size;
            $aprons->quantity = $request->quantity;
            $aprons->reorder_level = $request->reorder_level;

            $aprons->save();
            $after = Apron::orderBy('created_at', 'desc')->first();

            $stock = new ApronChange;
            $stock->variant = 'New';
            $stock->apron_id = $after->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New Apron Added', ' The NEW Apron Item has been added to stock items.');
            return redirect('/aprons');

        }
        else // store an increment in stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->apron;
            $before = Apron::find($id); 
            $after_quantity =  $before->quantity + $request->quantity;

            $aprons = Apron::where('id', $request->apron)->increment('quantity', $request->quantity);           

            $stock = new ApronChange;
            $stock->variant = 'Increment';
            $stock->apron_id = $request->apron;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' Apron Stock Incremented', ' '.$request->quantity.' items have been added to apron stock.');
            return redirect('/aprons');
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
