<?php

namespace App\Http\Controllers;


use App\Overall;
use App\OverallChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OverallsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('index');
        $overalls = Overall::orderBy('company','asc')->get();
        $sum = $overalls->sum('quantity');
        //return $overalls;
        return view('ppe.overalls.index', compact('overalls', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = OverallChange::with('user', 'overall')->get();
        return view('ppe.overalls.track', compact('tracks'));
    }
    public function create()
    {
       //dd('create');
       return view('ppe.overalls.create'); 
    }
    public function add(Overall $overall)
    {
        //dd('add');

        $overalls = $overall;
        return view('ppe.overalls.add', compact('overalls')); 
    }
    public function recon()
    {
        //dd('recon');
        $overalls = Overall::orderBy('company', 'asc')->get();
        return view('ppe.overalls.recon', compact('overalls')); 
    }
    public function addRecon(Request $request, Overall $overall)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->overall;

            $before = Overall::find($id); 
            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Overall Stock quantity Level is the same.');
                return redirect('/overalls/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $overalls = Overall::where('id', $id)->update(['quantity' => $request->quantity]); 

                $stock = new OverallChange;
                $stock->variant = 'Reconciliation';
                $stock->overall_id = $request->overall;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

                flash()->success(' Stock Reconciled', 'Overall Stock Quantity has been changed.');
                return redirect('/overalls/recon');
            }
        }
        else{
               $this->validate($request, [
                'reorder_level' => 'required|numeric'
                ]);   

            $old = Overall::where('id', $request->overall)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Overall Stock Reorder Level is the same');
                return redirect('/overalls/recon'); 
            }
            else
            {
                Overall::where('id', $request->overall)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Reorder Level reconcilied', 'Overall Stock Reorder Level has been changed');
                return redirect('/overalls/recon');           
            }
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Overall $overall)
    {
        
        //dd('store');


        if(isset($request->reorder_level))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $overalls = new Overall;

            $overalls->color = $request->color;
            $overalls->company = $request->company;
            $overalls->variant = $request->variant;
            $overalls->size = $request->size;
            $overalls->quantity = $request->quantity;
            $overalls->reorder_level = $request->reorder_level;

            $overalls->save();
            $after = Overall::orderBy('created_at', 'desc')->first();

            $stock = new OverallChange;
            $stock->variant = 'New';
            $stock->overall_id = $after->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New Overall Added', ' The NEW Overall Item has been added to stock items.');
            return redirect('/overalls');

        }
        else // store an increment in stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->overall;
            $before = Overall::find($id); 
            $after_quantity =  $before->quantity + $request->quantity;

            $overalls = Overall::where('id', $request->overall)->increment('quantity', $request->quantity);           

            $stock = new OverallChange;
            $stock->variant = 'Increment';
            $stock->overall_id = $request->overall;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' Overall Stock Incremented', ' '.$request->quantity.' items have been added to overall stock.');
            return redirect('/overalls');
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
