<?php

namespace App\Http\Controllers;


use App\Mask;
use App\MaskChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('index');
        $masks = Mask::orderBy('mask','asc')->get();
        $sum = $masks->sum('quantity');
        //return $masks;
        return view('ppe.masks.index', compact('masks', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = MaskChange::with('user', 'mask')->get();
        return view('ppe.masks.track', compact('tracks'));
    }
    public function create()
    {
       //dd('create');
       return view('ppe.masks.create'); 
    }
    public function add()
    {
        //dd('add');
        $masks = Mask::orderBy('mask', 'asc')->get();
        return view('ppe.masks.add', compact('masks')); 
    }
    public function recon()
    {
        //dd('recon');
        $masks = Mask::orderBy('mask', 'asc')->get();
        return view('ppe.masks.recon', compact('masks')); 
    }
    public function addRecon(Request $request, Mask $mask)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->mask;

            $before = Mask::find($id); 
            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Mask Stock quantity Level is the same.');
                return redirect('/masks/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $masks = Mask::where('id', $id)->update(['quantity' => $request->quantity]); 

                $stock = new MaskChange;
                $stock->variant = 'Reconciliation';
                $stock->mask_id = $request->mask;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

                flash()->success(' Stock Reconciled', 'Mask Stock Quantity has been changed.');
                return redirect('/masks/recon');
            }

        }
        else{
               $this->validate($request, [
                'reorder_level' => 'required|numeric'
                ]);   

            $old = Mask::where('id', $request->mask)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Mask Stock Reorder Level is the same');
                return redirect('/masks/recon'); 
            }
            else
            {
                Mask::where('id', $request->mask)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Reorder Level Reconcilied', 'Mask Stock Reorder Level has been changed');
                return redirect('/masks/recon');           
            }
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Mask $mask)
    {
        
        //dd('store');

        if(isset($request->reorder_level))  //store new stock
        {
            $this->validate($request, [
                'mask' => 'required',
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $masks = new Mask;

            $masks->mask = $request->mask;
            $masks->quantity = $request->quantity;
            $masks->reorder_level = $request->reorder_level;

            $masks->save();
            $after = Mask::orderBy('created_at', 'desc')->first();

            $stock = new MaskChange;
            $stock->variant = 'New';
            $stock->mask_id = $after->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New Mask Added', ' The NEW Mask Item '.$request->mask.' has been added to stock items.');
            return redirect('/masks');

        }
        else // store an increment in stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->mask;
            $before = Mask::find($id); 
            $after_quantity =  $before->quantity + $request->quantity;

            $masks = Mask::where('id', $request->mask)->increment('quantity', $request->quantity);           

            $stock = new MaskChange;
            $stock->variant = 'Increment';
            $stock->mask_id = $request->mask;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' Mask Stock Incremented', ' '.$request->quantity.' items have been added to mask stock.');
            return redirect('/masks');
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
