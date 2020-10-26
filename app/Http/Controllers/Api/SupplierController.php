<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Image;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier=Supplier::all();
        return response()->json($supplier);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData=$request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
         ]);
        if($request->photo){

        $positon=strpos($request->photo, ';');
        $sub=substr($request->photo, 0,$positon);
        $ext=explode('/', $sub)[1];
        $name=time().".".$ext;
        $img=Image::make($request->photo)-resize(240,200);
        $upload_path='backend/supplier/';
        $image_url=$upload_path.$name;
        $img->save($image_url);

         
         $supplier=new Supplier();
         $supplier->name=$request->name;
         $supplier->email=$request->email;
         $supplier->phone=$request->phone;
         $supplier->shopname=$request->shopname;
         $supplier->address=$request->address;
        
         $supplier->photo=$fileNameToStore;
         $supplier->save();
         }else{
             $supplier=new Supplier();
             $supplier->name=$request->name;
             $supplier->email=$request->email;
             $supplier->phone=$request->phone;
             $supplier->shopname=$request->shopname;
             $supplier->address=$request->address;
            
             $supplier->save();
 
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
       $supplier=Supplier::find($id);
       return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData=$request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
         ]);
            $supplier=Supplier::find($id);
            $supplier->name=$request->name;
            $supplier->email=$request->email;
            $supplier->phone=$request->phone;
            $supplier->shopname=$request->shopname;
            $supplier->address=$request->address;
            
            $supplier->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier=Supplier::find($id);
        $photo=$supplier->photo;
        if($photo){
            unlink($photo);
        }
        $supplier->delete();
    }
}
