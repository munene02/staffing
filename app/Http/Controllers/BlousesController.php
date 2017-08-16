<?php

namespace App\Http\Controllers;


use App\Blouse;
use App\BlouseChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BlousesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('index');
        $blouses = Blouse::orderBy('color','asc')->get();
        $sum = $blouses->sum('quantity');
        //return $blouses;
        return view('ppe.blouses.index', compact('blouses', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = BlouseChange::with('user', 'blouse')->get();
        return view('ppe.blouses.track', compact('tracks'));
    }
    public function create()
    {
       //dd('create');
       return view('ppe.blouses.create'); 
    }
    public function add(Blouse $blouse)
    {
        //dd('add');

        $blouses = $blouse;
        return view('ppe.blouses.add', compact('blouses')); 
    }
    public function recon()
    {
        //dd('recon');
        $blouses = Blouse::orderBy('color', 'asc')->get();
        return view('ppe.blouses.recon', compact('blouses')); 
    }
    public function addRecon(Request $request, Blouse $blouse)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->blouse;

            $before = Blouse::find($id); 
            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Blouse Stock quantity Level is the same.');
                return redirect('/blouses/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $blouses = Blouse::where('id', $id)->update(['quantity' => $request->quantity]); 

                $stock = new BlouseChange;
                $stock->variant = 'Reconciliation';
                $stock->blouse_id = $request->blouse;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

                flash()->success(' Stock Reconciled', 'Blouse Stock Quantity has been changed.');
                return redirect('/blouses/recon');
            }
        }
        else{
               $this->validate($request, [
                'reorder_level' => 'required|numeric'
                ]);   

            $old = Blouse::where('id', $request->blouse)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Blouse Stock Reorder Level is the same');
                return redirect('/blouses/recon'); 
            }
            else
            {
                Blouse::where('id', $request->blouse)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Reorder Level reconcilied', 'Blouse Stock Reorder Level has been changed');
                return redirect('/blouses/recon');           
            }
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Blouse $blouse)
    {
        
        //dd('store');


        if(isset($request->reorder_level))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $blouses = new Blouse;

            $blouses->color = $request->color;
            $blouses->size = $request->size;
            $blouses->quantity = $request->quantity;
            $blouses->reorder_level = $request->reorder_level;

            $blouses->save();
            $after = Blouse::orderBy('created_at', 'desc')->first();

            $stock = new BlouseChange;
            $stock->variant = 'New';
            $stock->blouse_id = $after->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New Blouse Added', ' The NEW Blouse Item has been added to stock items.');
            return redirect('/blouses');

        }
        else // store an increment in stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->blouse;
            $before = Blouse::find($id); 
            $after_quantity =  $before->quantity + $request->quantity;

            $blouses = Blouse::where('id', $request->blouse)->increment('quantity', $request->quantity);           

            $stock = new BlouseChange;
            $stock->variant = 'Increment';
            $stock->blouse_id = $request->blouse;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' Blouse Stock Incremented', ' '.$request->quantity.' items have been added to blouse stock.');
            return redirect('/blouses');
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
