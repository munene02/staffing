<?php

namespace App\Http\Controllers;


use App\Sweater;
use App\SweaterChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SweatersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('index');
        $sweaters = Sweater::orderBy('color','asc')->get();
        $sum = $sweaters->sum('quantity');
        //return $sweaters;
        return view('ppe.sweaters.index', compact('sweaters', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = SweaterChange::with('user', 'sweater')->get();
        return view('ppe.sweaters.track', compact('tracks'));
    }
    public function create()
    {
       //dd('create');
       return view('ppe.sweaters.create'); 
    }
    public function add(Sweater $sweater)
    {
        //dd('add');

        $sweaters = $sweater;
        return view('ppe.sweaters.add', compact('sweaters')); 
    }
    public function recon()
    {
        //dd('recon');
        $sweaters = Sweater::orderBy('color', 'asc')->get();
        return view('ppe.sweaters.recon', compact('sweaters')); 
    }
    public function addRecon(Request $request, Sweater $sweater)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->sweater;

            $before = Sweater::find($id); 
            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Sweater Stock quantity Level is the same.');
                return redirect('/sweaters/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $sweaters = Sweater::where('id', $id)->update(['quantity' => $request->quantity]); 

                $stock = new SweaterChange;
                $stock->variant = 'Reconciliation';
                $stock->sweater_id = $request->sweater;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

                flash()->success(' Stock Reconciled', 'Sweater Stock Quantity has been changed.');
                return redirect('/sweaters/recon');
            }
        }
        else{
               $this->validate($request, [
                'reorder_level' => 'required|numeric'
                ]);   

            $old = Sweater::where('id', $request->sweater)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Sweater Stock Reorder Level is the same');
                return redirect('/sweaters/recon'); 
            }
            else
            {
                Sweater::where('id', $request->sweater)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Reorder Level reconcilied', 'Sweater Stock Reorder Level has been changed');
                return redirect('/sweaters/recon');           
            }
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Sweater $sweater)
    {
        
        //dd('store');


        if(isset($request->reorder_level))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $sweaters = new Sweater;

            $sweaters->color = $request->color;
            $sweaters->size = $request->size;
            $sweaters->quantity = $request->quantity;
            $sweaters->reorder_level = $request->reorder_level;

            $sweaters->save();
            $after = Sweater::orderBy('created_at', 'desc')->first();

            $stock = new SweaterChange;
            $stock->variant = 'New';
            $stock->sweater_id = $after->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New Sweater Added', ' The NEW Sweater Item has been added to stock items.');
            return redirect('/sweaters');

        }
        else // store an increment in stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->sweater;
            $before = Sweater::find($id); 
            $after_quantity =  $before->quantity + $request->quantity;

            $sweaters = Sweater::where('id', $request->sweater)->increment('quantity', $request->quantity);           

            $stock = new SweaterChange;
            $stock->variant = 'Increment';
            $stock->sweater_id = $request->sweater;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' Sweater Stock Incremented', ' '.$request->quantity.' items have been added to sweater stock.');
            return redirect('/sweaters');
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
