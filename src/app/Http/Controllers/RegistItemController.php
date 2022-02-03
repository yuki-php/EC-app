<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Item;
use App\Models\Maker;

class RegistItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $makers = Maker::all();
        return view('item.regist',compact('makers'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = collect($request->all());
        $types=  $attributes->get('types');

        DB::beginTransaction();
        try {
            // $newItem = Item::create($attributes);

            if($types['maker_type1']['name'] !== null) {
                foreach($types['maker_type1'] as $key => $value) {
                   if($key === 'name') continue;
                   if($value === null) break;
                   
                   if($types['maker_type2']['name'] !== null) {
                        foreach($types['maker_type2'] as $key => $value) {
                            if($key === 'name') continue;
                            if($value === null) break;
                            dd($value);

                            if($types['maker_type3']['name'] !== null) {
                                foreach($types['maker_type3'] as $key => $value) {
                                    if($key === 'name') continue;
                                    if($value === null) break;
                                    
                                }
                            }
                        }
                   }
                }
            }

            dd($types,$attributes);
            // DB::commit();
        } catch(\Exception $e){
            DB::rollback();
            dd($e);
        }

        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
