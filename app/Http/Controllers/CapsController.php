<?php

namespace App\Http\Controllers;


use App\Cap;
use App\CapChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('index');
        $caps = Cap::orderBy('color','asc')->get();
        $sum = $caps->sum('quantity');
        //return $caps;
        return view('ppe.caps.index', compact('caps', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = CapChange::with('user', 'cap')->get();
        return view('ppe.caps.track', compact('tracks'));
    }
    public function create()
    {
       //dd('create');
       return view('ppe.caps.create'); 
    }
    public function add(Cap $cap)
    {
        //dd('add');

        $caps = $cap;
        return view('ppe.caps.add', compact('caps')); 
    }
    public function recon()
    {
        //dd('recon');
        $caps = Cap::orderBy('color', 'asc')->get();
        return view('ppe.caps.recon', compact('caps')); 
    }
    public function addRecon(Request $request, Cap $cap)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->cap;

            $before = Cap::find($id); 
            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Cap Stock quantity Level is the same.');
                return redirect('/caps/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $caps = Cap::where('id', $id)->update(['quantity' => $request->quantity]); 

                $stock = new CapChange;
                $stock->variant = 'Reconciliation';
                $stock->cap_id = $request->cap;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

                flash()->success(' Stock Reconciled', 'Cap Stock Quantity has been changed.');
                return redirect('/caps/recon');
            }
        }
        else{
               $this->validate($request, [
                'reorder_level' => 'required|numeric'
                ]);   

            $old = Cap::where('id', $request->cap)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Cap Stock Reorder Level is the same');
                return redirect('/caps/recon'); 
            }
            else
            {
                Cap::where('id', $request->cap)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Reorder Level reconcilied', 'Cap Stock Reorder Level has been changed');
                return redirect('/caps/recon');           
            }
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Cap $cap)
    {
        
        //dd('store');


        if(isset($request->reorder_level))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $caps = new Cap;

            $caps->color = $request->color;
            $caps->quantity = $request->quantity;
            $caps->reorder_level = $request->reorder_level;

            $caps->save();
            $after = Cap::orderBy('created_at', 'desc')->first();

            $stock = new CapChange;
            $stock->variant = 'New';        
            $stock->cap_id = $after->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New Cap Added', ' The NEW Cap Item has been added to stock items.');
            return redirect('/caps');

        }
        else // store an increment in stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->cap;
            $before = Cap::find($id); 
            $after_quantity =  $before->quantity + $request->quantity;

            $caps = Cap::where('id', $request->cap)->increment('quantity', $request->quantity);           

            $stock = new CapChange;
            $stock->variant = 'Increment';
            $stock->cap_id = $request->cap;
            $stock->before_quantity = $before->quantity;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $after_quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' Cap Stock Incremented', ' '.$request->quantity.' items have been added to cap stock.');
            return redirect('/caps');
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
