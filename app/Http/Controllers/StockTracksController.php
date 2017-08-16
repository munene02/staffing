<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\StockTrack;
use App\Http\Requests;

class StockTracksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd('store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id=='requi')
        {
            dd('requi');

        }
        elseif($id=='recon')
        {
            //dd('recon');
            $recons = StockTrack::with('user')->where('variant', 'recon')->orderBy('table_name', 'asc')->orderBy('created_at', 'desc')->get();

            return view('stock_track.recon.index', compact('recons')); 
        }
        elseif($id=='add')
        {
                dd('add');
        }
        elseif($id=='new')
        {
                dd('new');
        }
        else
        {
            dd('hacker');
        }
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
