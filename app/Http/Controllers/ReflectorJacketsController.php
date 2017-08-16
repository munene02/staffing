<?php

namespace App\Http\Controllers;


use App\ReflectorJacket;
use App\ReflectorJacketChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReflectorJacketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('index');
        $reflector_jackets = ReflectorJacket::orderBy('company','asc')->get();
        $sum = $reflector_jackets->sum('quantity');
        //return $reflector_jackets;
        return view('ppe.reflector_jackets.index', compact('reflector_jackets', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = ReflectorJacketChange::with('user', 'reflectorJacket')->get();
        return view('ppe.reflector_jackets.track', compact('tracks'));
    }
    public function create()
    {
       //dd('create');
       return view('ppe.reflector_jackets.create'); 
    }
    public function add(ReflectorJacket $reflector_jacket)
    {
        //dd('add');

        $reflector_jackets = $reflector_jacket;

        return view('ppe.reflector_jackets.add', compact('reflector_jackets')); 
    }
    public function recon()
    {
        //dd('recon');
        $reflector_jackets = ReflectorJacket::orderBy('company', 'asc')->get();
        return view('ppe.reflector_jackets.recon', compact('reflector_jackets')); 
    }
    public function addRecon(Request $request, ReflectorJacket $reflector_jacket)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->reflector_jacket;

            $before = ReflectorJacket::find($id); 
            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Reflector Jacket Stock quantity Level is the same.');
                return redirect('/reflector_jackets/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $reflector_jackets = ReflectorJacket::where('id', $id)->update(['quantity' => $request->quantity]); 

                $stock = new ReflectorJacketChange;
                $stock->variant = 'Reconciliation';
                $stock->reflector_jacket_id = $request->reflector_jacket;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

                flash()->success(' Stock Reconciled', 'Reflector Jacket Stock Quantity has been changed.');
                return redirect('/reflector_jackets/recon');
            }
        }
        else
        {
            $this->validate($request, [
            'reorder_level' => 'required|numeric'
            ]); 

            $old = ReflectorJacket::where('id', $request->reflector_jacket)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Reflector Jacket Stock Reorder Level is the same');
                return redirect('/reflector_jackets/recon'); 
            }
            else
            {
                ReflectorJacket::where('id', $request->reflector_jacket)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Reorder Level Reconcilied', 'Reflector Jacket Stock Reorder Level has been changed');
                return redirect('/reflector_jackets/recon');           
            }
               
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ReflectorJacket $reflector_jacket)
    {
        
        //dd('store');


        if(isset($request->reorder_level))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $reflector_jackets = new ReflectorJacket;

            $reflector_jackets->company = $request->company;
            $reflector_jackets->size = $request->size;
            $reflector_jackets->quantity = $request->quantity;
            $reflector_jackets->reorder_level = $request->reorder_level;

            $reflector_jackets->save();
            $after = ReflectorJacket::orderBy('created_at', 'desc')->first();

            $stock = new ReflectorJacketChange;
            $stock->variant = 'New';
            $stock->reflector_jacket_id = $after->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New Reflector Jacket Added', ' The NEW Reflector Jacket Item has been added to stock items.');
            return redirect('/reflector_jackets');

        }
        else // store an increment in stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->reflector_jacket;

            $before = ReflectorJacket::find($id); 
            $after_quantity =  $before->quantity + $request->quantity;

            $reflector_jackets = ReflectorJacket::where('id', $request->reflector_jacket)->increment('quantity', $request->quantity);           

            $stock = new ReflectorJacketChange;
            $stock->variant = 'Increment';
            $stock->reflector_jacket_id = $request->reflector_jacket;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' Reflector Jacket Stock Incremented', ' '.$request->quantity.' items have been added to reflector_jacket stock.');
            return redirect('/reflector_jackets');
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
