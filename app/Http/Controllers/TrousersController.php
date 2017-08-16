<?php

namespace App\Http\Controllers;


use App\Trouser;
use App\TrouserChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TrousersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('index');
        $trousers = Trouser::orderBy('color','asc')->get();
        $sum = $trousers->sum('quantity');
        //return $trousers;
        return view('ppe.trousers.index', compact('trousers', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = TrouserChange::with('user', 'trouser')->get();
        return view('ppe.trousers.track', compact('tracks'));
    }
    public function create()
    {
       //dd('create');
       return view('ppe.trousers.create'); 
    }
    public function add(Trouser $trouser)
    {
        //dd('add');

        $trousers = $trouser;
        return view('ppe.trousers.add', compact('trousers')); 
    }
    public function recon()
    {
        //dd('recon');
        $trousers = Trouser::orderBy('color', 'asc')->get();
        return view('ppe.trousers.recon', compact('trousers')); 
    }
    public function addRecon(Request $request, Trouser $trouser)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->trouser;

            $before = Trouser::find($id); 
            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Trouser Stock quantity Level is the same.');
                return redirect('/trousers/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $trousers = Trouser::where('id', $id)->update(['quantity' => $request->quantity]); 

                $stock = new TrouserChange;
                $stock->variant = 'Reconciliation';
                $stock->trouser_id = $request->trouser;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

                flash()->success(' Stock Reconciled', 'Trouser Stock Quantity has been changed.');
                return redirect('/trousers/recon');
            }
        }
        else{
               $this->validate($request, [
                'reorder_level' => 'required|numeric'
                ]);   

            $old = Trouser::where('id', $request->trouser)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Trouser Stock Reorder Level is the same');
                return redirect('/trousers/recon'); 
            }
            else
            {
                Trouser::where('id', $request->trouser)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Reorder Level reconcilied', 'Trouser Stock Reorder Level has been changed');
                return redirect('/trousers/recon');           
            }
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Trouser $trouser)
    {
        
        //dd('store');


        if(isset($request->reorder_level))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $trousers = new Trouser;

            $trousers->color = $request->color;
            $trousers->size = $request->size;
            $trousers->quantity = $request->quantity;
            $trousers->reorder_level = $request->reorder_level;

            $trousers->save();
            $after = Trouser::orderBy('created_at', 'desc')->first();

            $stock = new TrouserChange;
            $stock->variant = 'New';
            $stock->trouser_id = $after->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New Trouser Added', ' The NEW Trouser Item has been added to stock items.');
            return redirect('/trousers');

        }
        else // store an increment in stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->trouser;
            $before = Trouser::find($id); 
            $after_quantity =  $before->quantity + $request->quantity;

            $trousers = Trouser::where('id', $request->trouser)->increment('quantity', $request->quantity);           

            $stock = new TrouserChange;
            $stock->variant = 'Increment';
            $stock->trouser_id = $request->trouser;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' Trouser Stock Incremented', ' '.$request->quantity.' items have been added to trouser stock.');
            return redirect('/trousers');
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
