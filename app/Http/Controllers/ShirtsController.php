<?php

namespace App\Http\Controllers;


use App\Shirt;
use App\ShirtChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShirtsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('index');
        $shirts = Shirt::orderBy('color','asc')->get();
        $sum = $shirts->sum('quantity');
        //return $shirts;
        return view('ppe.shirts.index', compact('shirts', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = ShirtChange::with('user', 'shirt')->get();
        return view('ppe.shirts.track', compact('tracks'));
    }
    public function create()
    {
       //dd('create');
       return view('ppe.shirts.create'); 
    }
    public function add(Shirt $shirt)
    {
        //dd('add');

        $shirts = $shirt;
        return view('ppe.shirts.add', compact('shirts')); 
    }
    public function recon()
    {
        //dd('recon');
        $shirts = Shirt::orderBy('color', 'asc')->get();
        return view('ppe.shirts.recon', compact('shirts')); 
    }
    public function addRecon(Request $request, Shirt $shirt)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->shirt;

            $before = Shirt::find($id); 
            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Shirt Stock quantity Level is the same.');
                return redirect('/shirts/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $shirts = Shirt::where('id', $id)->update(['quantity' => $request->quantity]); 

                $stock = new ShirtChange;
                $stock->variant = 'Reconciliation';
                $stock->shirt_id = $request->shirt;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

                flash()->success(' Stock Reconciled', 'Shirt Stock Quantity has been changed.');
                return redirect('/shirts/recon');
            }
        }
        else{
               $this->validate($request, [
                'reorder_level' => 'required|numeric'
                ]);   

            $old = Shirt::where('id', $request->shirt)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Shirt Stock Reorder Level is the same');
                return redirect('/shirts/recon'); 
            }
            else
            {
                Shirt::where('id', $request->shirt)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Reorder Level reconcilied', 'Shirt Stock Reorder Level has been changed');
                return redirect('/shirts/recon');           
            }
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Shirt $shirt)
    {
        
        //dd('store');


        if(isset($request->reorder_level))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $shirts = new Shirt;

            $shirts->color = $request->color;
            $shirts->size = $request->size;
            $shirts->quantity = $request->quantity;
            $shirts->reorder_level = $request->reorder_level;

            $shirts->save();
            $after = Shirt::orderBy('created_at', 'desc')->first();

            $stock = new ShirtChange;
            $stock->variant = 'New';
            $stock->shirt_id = $after->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New Shirt Added', ' The NEW Shirt Item has been added to stock items.');
            return redirect('/shirts');

        }
        else // store an increment in stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->shirt;
            $before = Shirt::find($id); 
            $after_quantity =  $before->quantity + $request->quantity;

            $shirts = Shirt::where('id', $request->shirt)->increment('quantity', $request->quantity);           

            $stock = new ShirtChange;
            $stock->variant = 'Increment';
            $stock->shirt_id = $request->shirt;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' Shirt Stock Incremented', ' '.$request->quantity.' items have been added to shirt stock.');
            return redirect('/shirts');
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
