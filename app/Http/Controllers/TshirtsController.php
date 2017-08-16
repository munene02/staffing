<?php

namespace App\Http\Controllers;


use App\Tshirt;
use App\TshirtChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TshirtsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('index');
        $tshirts = Tshirt::orderBy('color','asc')->get();
        $sum = $tshirts->sum('quantity');
        //return $tshirts;
        return view('ppe.tshirts.index', compact('tshirts', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = TshirtChange::with('user', 'tshirt')->get();
        return view('ppe.tshirts.track', compact('tracks'));
    }
    public function create()
    {
       //dd('create');
       return view('ppe.tshirts.create'); 
    }
    public function add(Tshirt $tshirt)
    {
        //dd('add');

        $tshirts = $tshirt;
        return view('ppe.tshirts.add', compact('tshirts')); 
    }
    public function recon()
    {
        //dd('recon');
        $tshirts = Tshirt::orderBy('color', 'asc')->get();
        return view('ppe.tshirts.recon', compact('tshirts')); 
    }
    public function addRecon(Request $request, Tshirt $tshirt)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->tshirt;

            $before = Tshirt::find($id); 
            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Tshirt Stock quantity Level is the same.');
                return redirect('/tshirts/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $tshirts = Tshirt::where('id', $id)->update(['quantity' => $request->quantity]); 

                $stock = new TshirtChange;
                $stock->variant = 'Reconciliation';
                $stock->tshirt_id = $request->tshirt;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

                flash()->success(' Stock Reconciled', 'Tshirt Stock Quantity has been changed.');
                return redirect('/tshirts/recon');
            }
        }
        else{
               $this->validate($request, [
                'reorder_level' => 'required|numeric'
                ]);   

            $old = Tshirt::where('id', $request->tshirt)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Tshirt Stock Reorder Level is the same');
                return redirect('/tshirts/recon'); 
            }
            else
            {
                Tshirt::where('id', $request->tshirt)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Reorder Level reconcilied', 'Tshirt Stock Reorder Level has been changed');
                return redirect('/tshirts/recon');           
            }
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tshirt $tshirt)
    {
        
        //dd('store');


        if(isset($request->reorder_level))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $tshirts = new Tshirt;

            $tshirts->color = $request->color;
            $tshirts->size = $request->size;
            $tshirts->quantity = $request->quantity;
            $tshirts->reorder_level = $request->reorder_level;

            $tshirts->save();
            $after = Tshirt::orderBy('created_at', 'desc')->first();

            $stock = new TshirtChange;
            $stock->variant = 'New';
            $stock->tshirt_id = $after->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New Tshirt Added', ' The NEW Tshirt Item has been added to stock items.');
            return redirect('/tshirts');

        }
        else // store an increment in stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->tshirt;

            $before = Tshirt::find($id); 
            $after_quantity =  $before->quantity + $request->quantity;

            $tshirts = Tshirt::where('id', $request->tshirt)->increment('quantity', $request->quantity);           

            $stock = new TshirtChange;
            $stock->variant = 'Increment';
            $stock->tshirt_id = $request->tshirt;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' Tshirt Stock Incremented', ' '.$request->quantity.' items have been added to tshirt stock.');
            return redirect('/tshirts');
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
