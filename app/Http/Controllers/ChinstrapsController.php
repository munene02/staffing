<?php

namespace App\Http\Controllers;


use App\Chinstrap;
use App\ChinstrapChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChinstrapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('index');
        $chinstraps = Chinstrap::orderBy('chinstrap','asc')->get();
        $sum = $chinstraps->sum('quantity');
        //return $chinstraps;
        return view('ppe.chinstraps.index', compact('chinstraps', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = ChinstrapChange::with('user', 'chinstrap')->get();
        return view('ppe.chinstraps.track', compact('tracks'));
    }
    public function create()
    {
       //dd('create');
       return view('ppe.chinstraps.create'); 
    }
    public function add()
    {
        //dd('add');
        $chinstraps = Chinstrap::orderBy('chinstrap', 'asc')->get();
        return view('ppe.chinstraps.add', compact('chinstraps')); 
    }
    public function recon()
    {
        //dd('recon');
        $chinstraps = Chinstrap::orderBy('chinstrap', 'asc')->get();
        return view('ppe.chinstraps.recon', compact('chinstraps')); 
    }
    public function addRecon(Request $request, Chinstrap $chinstrap)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->chinstrap;

            $before = Chinstrap::find($id); 
            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Chinstrap Stock quantity Level is the same.');
                return redirect('/chinstraps/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $chinstraps = Chinstrap::where('id', $id)->update(['quantity' => $request->quantity]); 

                $stock = new ChinstrapChange;
                $stock->variant = 'Reconciliation';
                $stock->chinstrap_id = $request->chinstrap;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

                flash()->success(' Stock Reconciled', 'Chinstrap Stock Quantity has been changed.');
                return redirect('/chinstraps/recon');
            }
        }
        else{
               $this->validate($request, [
                'reorder_level' => 'required|numeric'
                ]);   

            $old = Chinstrap::where('id', $request->chinstrap)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Chinstrap Stock Reorder Level is the same');
                return redirect('/chinstraps/recon'); 
            }
            else
            {
                Chinstrap::where('id', $request->chinstrap)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Reorder Level reconcilied', 'Chinstrap Stock Reorder Level has been changed');
                return redirect('/chinstraps/recon');           
            }  
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Chinstrap $chinstrap)
    {
        
        //dd('store');

        if(isset($request->reorder_level))  //store new stock
        {
            $this->validate($request, [
                'chinstrap' => 'required',
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $chinstraps = new Chinstrap;

            $chinstraps->chinstrap = $request->chinstrap;
            $chinstraps->quantity = $request->quantity;
            $chinstraps->reorder_level = $request->reorder_level;

            $chinstraps->save();
            $after = Chinstrap::orderBy('created_at', 'desc')->first();

            $stock = new ChinstrapChange;
            $stock->variant = 'New';
            $stock->chinstrap_id = $after->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New Chinstrap Added', ' The NEW Chinstrap Item '.$request->chinstrap.' has been added to stock items.');
            return redirect('/chinstraps');

        }
        else // store an increment in stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->chinstrap;
            $before = Chinstrap::find($id); 
            $after_quantity =  $before->quantity + $request->quantity;

            $chinstraps = Chinstrap::where('id', $request->chinstrap)->increment('quantity', $request->quantity);           

            $stock = new ChinstrapChange;
            $stock->variant = 'Increment';
            $stock->chinstrap_id = $request->chinstrap;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' Chinstrap Stock Incremented', ' '.$request->quantity.' items have been added to chinstrap stock.');
            return redirect('/chinstraps');
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
