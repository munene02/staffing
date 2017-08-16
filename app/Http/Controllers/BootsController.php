<?php

namespace App\Http\Controllers;


use App\Brand;
use App\Boot;
use App\BootChange;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BootsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::with('boots.shoeSize', 'boots.bootHeight')->orderBY('brand', 'asc')->get();
    	return view('ppe.boots.index', compact('brands'));
    	//return $brands_sorted;
        //dd('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function track()
    {
        $tracks = BootChange::with('user', 'boots')->get();

        return view('ppe.boots.track', compact('tracks'));
    }
    public function add(Brand $brand)
    {
        //dd('add');
        //$boots = Boot::find($);
        $brands = $brand;
        return view('ppe.boots.add', compact('brands')); 
    }
    public function recon()
    {
        //dd('recon');
        $brands = Brand::with('boots.shoeSize', 'boots.bootHeight')->orderBY('brand', 'asc')->get();
        return view('ppe.boots.recon', compact('brands')); 
    }
     public function addRecon(Request $request, Boot $boot)
    {
        //dd('addRecon');
        if(isset($request->quantity))  //store new stock
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $id = $request->boot;
            
            $before = Boot::find($id); 

            if($before->quantity == $request->quantity){
                flash()->info(' Stock Quantity Unchanged', 'Boot Stock quantity Level is the same.');
                return redirect('/boots/recon'); 
            }
            else
            {
                $after_quantity =  $request->quantity;

                $quantity = $request->quantity - $before->quantity;

                $gloves = Boot::where('id', $id)->update(['quantity' => $request->quantity]); 
                
                $stock = new BootChange;
                $stock->variant = 'Reconciliation';
                $stock->boot_id = $request->boot;
                $stock->before_quantity = $before->quantity;
                $stock->quantity_increment = $quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();
                $stock->save();

                flash()->success(' Boot Stock Reconciled', 'Boot Stock quantity has been changed.');
                return redirect('/boots/recon');
            }
        }
        else{
               $this->validate($request, [
                'reorder_level' => 'required|numeric'
                ]);   

                 
            $old = Boot::where('id', $request->boot)->first();

            if($old->reorder_level == $request->reorder_level){
                flash()->info(' Reorder Level Unchanged', 'Boot Stock Reorder Level is the same');
                return redirect('/boots/recon'); 
            }
            else
            {
                Boot::where('id', $request->boot)->update(['reorder_level' => $request->reorder_level]); 
                flash()->success(' Boot Stock reconcilied', 'Boot Stock Reorder Level has Been changed');
                return redirect('/boots/recon'); 
          
            }
                        

                    }

    }
    public function create(Brand $brand)
    {
        $brands = $brand;
        
        return view('ppe.boots.create', compact('brands'));

        //dd('create');
        //return $brands;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Brand $brand)
    {
        if(isset($request->reorder_level))  //store new stock + stock_track Addition
        {
            $this->validate($request, [
                'brand' => 'required',
                'quantity' => 'required|numeric',
                'reorder_level' => 'required|numeric'
            ]);

            $brand = new Brand;
            $brand->brand = $request->brand;

            $brand->save();
            $after_brand = Brand::orderBy('created_at', 'desc')->first();


            $boot = new Boot();
            $boot->brand_id = $after_brand->id;
            $boot->boot_height_id = $request->height;
            $boot->shoe_size_id = $request->size;
            $boot->quantity = $request->quantity;
            $boot->reorder_level = $request->reorder_level;

           
            $boot->save();
            $after_boot = Boot::orderBy('created_at', 'desc')->first();

            $stock = new BootChange;
            $stock->variant = 'New';
            $stock->boot_id = $after_boot->id;
            $stock->before_quantity = 0;
            $stock->quantity_increment = $request->quantity;
            $stock->after_quantity = $request->quantity;
            $stock->user_id = Auth::id();

            $stock->save();

            flash()->success(' New Stock Item Added', ' The NEW Boot Item '.$request->brand.' has been added to stock items.');
            return redirect('/boots');

        }
        else //old stock item increment + stock_track addition
        {
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            $before_quantity = Boot::where([
                    ['boot_height_id', '=', $request->height],
                    ['shoe_size_id', '=', $request->size],
                    ['brand_id', '=', $request->brand]
                ])->first();
            //return $request->all();
            if(!empty($before_quantity))
            {
                //dd('boot exists');
                $after_quantity =  $before_quantity->quantity + $request->quantity;

                $boots = Boot::where([
                        ['boot_height_id', '=', $request->height],
                        ['shoe_size_id', '=', $request->size],
                        ['brand_id', '=', $request->brand]
                    ])->increment('quantity', $request->quantity);           

                $stock = new BootChange;
                $stock->variant = 'Increment';
                $stock->boot_id = $before_quantity->id;
                $stock->before_quantity = $before_quantity->quantity;
                $stock->quantity_increment = $request->quantity;
                $stock->after_quantity = $after_quantity;
                $stock->user_id = Auth::id();

                $stock->save();

            flash()->success('Boot Stock Incremented', ' '.$request->quantity.' items have been added to Boots stock.');
            return redirect('/boots');

            }
            else
            { 
                //dd('boot doesnt exists');
                //return $request->all();
                $boot = new Boot();
                $boot->brand_id = $request->brand;
                $boot->boot_height_id = $request->height;
                $boot->shoe_size_id = $request->size;
                $boot->quantity = $request->quantity;
                $boot->reorder_level = 50;

                $boot->save();
                $after_boot = Boot::orderBy('created_at', 'desc')->first();

                $stock = new BootChange;
                $stock->variant = 'New';
                $stock->boot_id = $after_boot->id;
                $stock->before_quantity = 0;
                $stock->quantity_increment = $request->quantity;
                $stock->after_quantity = $request->quantity;
                $stock->user_id = Auth::id();

                $stock->save();
                flash()->success('Boot Stock Incremented', ' '.$request->quantity.' items have been added to Boots stock.');
                return redirect('/boots');
                
            }     

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
        //return $id;
        //return view('ppe.boots.add');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
