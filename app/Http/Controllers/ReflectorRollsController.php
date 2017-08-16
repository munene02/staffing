<?php

namespace App\Http\Controllers;


use App\ReflectorRoll;
use App\ReflectorRollChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReflectorRollsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('index');
        $reflector_rolls = ReflectorRoll::orderBy('reflector_roll','asc')->get();
        $sum = $reflector_rolls->sum('quantity');
        //return $reflector_rolls;
        return view('ppe.reflector_rolls.index', compact('reflector_rolls', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = ReflectorRollChange::with('user', 'reflectorRoll')->get();
        return view('ppe.reflector_rolls.track', compact('tracks'));
    }
    public function create()
    {
       //dd('create');
       return view('ppe.reflector_rolls.create'); 
    }
    public function add()
    {
        //dd('add');
        $reflector_rolls = ReflectorRoll::orderBy('reflector_roll', 'asc')->get();
        return view('ppe.reflector_rolls.add', compact('reflector_rolls')); 
    }
    public function recon()
    {
        //dd('recon');
        $reflector_rolls = ReflectorRoll::orderBy('reflector_roll', 'asc')->get();
        return view('ppe.reflector_rolls.recon', compact('reflector_rolls')); 
    }
    public function addRecon(Request $request, ReflectorRoll $reflector_roll)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->reflector_roll;

            $before = ReflectorRoll::find($id); 
            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Reflector Roll Stock quantity Level is the same.');
                return redirect('/reflector_rolls/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $reflector_rolls = ReflectorRoll::where('id', $id)->update(['quantity' => $request->quantity]); 

                $stock = new ReflectorRollChange;
                $stock->variant = 'Reconciliation';
                $stock->reflector_roll_id = $request->reflector_roll;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

                flash()->success(' Stock Reconciled', 'Reflector Roll Stock Quantity has been changed.');
                return redirect('/reflector_rolls/recon');
            }
        }
        else{
               $this->validate($request, [
                'reorder_level' => 'required|numeric'
                ]);   

            $old = ReflectorRoll::where('id', $request->reflector_roll)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Reflector Roll Stock Reorder Level is the same');
                return redirect('/reflector_rolls/recon'); 
            }
            else
            {
                ReflectorRoll::where('id', $request->reflector_roll)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Reorder Level reconcilied', 'Reflector Roll Stock Reorder Level has been changed');
                return redirect('/reflector_rolls/recon');           
            }  
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ReflectorRoll $reflector_roll)
    {
        
        //dd('store');

        if(isset($request->reorder_level))  //store new stock
        {
            $this->validate($request, [
                'reflector_roll' => 'required',
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $reflector_rolls = new ReflectorRoll;

            $reflector_rolls->reflector_roll = $request->reflector_roll;
            $reflector_rolls->quantity = $request->quantity;
            $reflector_rolls->reorder_level = $request->reorder_level;

            $reflector_rolls->save();
            $after = ReflectorRoll::orderBy('created_at', 'desc')->first();

            $stock = new ReflectorRollChange;
            $stock->variant = 'New';
            $stock->reflector_roll_id = $after->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New Reflector Roll Added', ' The NEW Reflector Roll Item '.$request->reflector_roll.' has been added to stock items.');
            return redirect('/reflector_rolls');

        }
        else // store an increment in stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->reflector_roll;
            $before = ReflectorRoll::find($id); 
            $after_quantity =  $before->quantity + $request->quantity;

            $reflector_rolls = ReflectorRoll::where('id', $request->reflector_roll)->increment('quantity', $request->quantity);           

            $stock = new ReflectorRollChange;
            $stock->variant = 'Increment';
            $stock->reflector_roll_id = $request->reflector_roll;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' Reflector Roll Stock Incremented', ' '.$request->quantity.' items have been added to reflector_roll stock.');
            return redirect('/reflector_rolls');
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
