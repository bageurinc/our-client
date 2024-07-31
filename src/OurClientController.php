<?php

namespace Bageur\OurClient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bageur\OurClient\model\our_client;
use Illuminate\Support\Str;
use Validator;

class OurClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $our_client = our_client::datatable($request);
        return $our_client;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules    	= [
                        'nama'		     		=> 'required',
                        'file'		     		=> 'required'
                    ];

        $messages 	= [];
        $attributes = [];

        $validator = Validator::make($request->all(), $rules,$messages,$attributes);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response(['status' => false ,'error'    =>  $errors->all()], 200);
        }else{
            $data               = new our_client;
            $data->nama        = $request->nama;
            $data->logo        = $request->logo;
            $data->logo_path   = $request->logo_path;
            $data->save();

            return response(['status' => true ,'text'    => 'has input'], 200);
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
        $our_client = our_client::findOrFail($id);
        return $our_client;
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
        $rules    	= [
            'nama'		     		=> 'required',
            'file'		     		=> 'required'
        ];

        $messages 	= [];
        $attributes = [];

        $validator = Validator::make($request->all(), $rules,$messages,$attributes);
        if ($validator->fails()) {
        $errors = $validator->errors();
        return response(['status' => false ,'error'    =>  $errors->all()], 200);
        }else{
        $data               = our_client::findOrFail($id);
        $data->nama        = $request->nama;
        $data->logo        = $request->logo;
        $data->logo_path   = $request->logo_path;
        $data->save();
        return response(['status' => true ,'text'    => 'has updated'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = our_client::findOrFail($id);
        $delete->delete();
        return response(['status' => true ,'text'    => 'has deleted'], 200);
    }
}
