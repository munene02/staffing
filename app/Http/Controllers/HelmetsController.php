<?php

namespace App\Http\Controllers;


use App\Helmet;
use App\HelmetChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HelmetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('index');
        $helmets = Helmet::orderBy('helmet','asc')->get();
        $sum = $helmets->sum('quantity');
        //return $helmets;
        return view('ppe.helmets.index', compact('helmets', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = HelmetChange::with('user', 'helmet')->get();
        return view('ppe.helmets.track', compact('tracks'));
    }
    public function create()
    {
       //dd('create');
       return view('ppe.helmets.create'); 
    }
    public function add()
    {
        //dd('add');
        $helmets = Helmet::orderBy('helmet', 'asc')->get();
        return view('ppe.helmets.add', compact('helmets')); 
    }
    public function recon()
    {
        //dd('recon');
        $helmets = Helmet::orderBy('helmet', 'asc')->get();
        return view('ppe.helmets.recon', compact('helmets')); 
    }
    public function addRecon(Request $request, Helmet $helmet)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->helmet;

            $before = Helmet::find($id); 
            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Helmet Stock quantity Level is the same.');
                return redirect('/helmets/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $helmets = Helmet::where('id', $id)->update(['quantity' => $request->quantity]); 

                $stock = new HelmetChange;
                $stock->variant = 'Reconciliation';
                $stock->helmet_id = $request->helmet;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

                flash()->success(' Stock Reconciled', 'Helmet Stock Quantity has been changed.');
                return redirect('/helmets/recon');
            }
        }
        else{
               $this->validate($request, [
                'reorder_level' => 'required|numeric'
                ]);   

            $old = Helmet::where('id', $request->helmet)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Helmet Stock Reorder Level is the same');
                return redirect('/helmets/recon'); 
            }
            else
            {
                Helmet::where('id', $request->helmet)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Reorder Level reconcilied', 'Helmet Stock Reorder Level has been changed');
                return redirect('/helmets/recon');           
            }  
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Helmet $helmet)
    {
        
        //dd('store');

        if(isset($request->reorder_level))  //store new stock
        {
            $this->validate($request, [
                'helmet' => 'required',
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $helmets = new Helmet;

            $helmets->helmet = $request->helmet;
            $helmets->quantity = $request->quantity;
            $helmets->reorder_level = $request->reorder_level;

            $helmets->save();
            $after = Helmet::orderBy('created_at', 'desc')->first();

            $stock = new HelmetChange;
            $stock->variant = 'New';
            $stock->helmet_id = $after->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New Helmet Added', ' The NEW Helmet Item '.$request->helmet.' has been added to stock items.');
            return redirect('/helmets');

        }
        else // store an increment in stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->helmet;
            $before = Helmet::find($id); 
            $after_quantity =  $before->quantity + $request->quantity;

            $helmets = Helmet::where('id', $request->helmet)->increment('quantity', $request->quantity);           

            $stock = new HelmetChange;
            $stock->variant = 'Increment';
            $stock->helmet_id = $request->helmet;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' Helmet Stock Incremented', ' '.$request->quantity.' items have been added to helmet stock.');
            return redirect('/helmets');
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
