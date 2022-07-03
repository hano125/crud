<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class offersController extends Controller
{
    public function create(){
        return view("createOffer");
    }

    public function store(Request $request){
        //validation in Laravel

//        $validator=validator::make([array][validator rule][msg]);
        $Rules=$this->getRules();
      $massages=$this->getMsg();

        $validator=Validator::make($request->all(),$Rules,$massages);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());

        }




        //insert data from formBootstrap
        Offer::create([
            'name'=>$request->name ,
            'price'=>$request->price ,
            'qty'=>$request->qty,
            'details'=>$request->details
        ]);

        return("Save successfully");
    }

      protected function  getRules(){
         return $Rules=[
              'name'=>'required|max:100|unique:offers,name',
              'price'=>'required|numeric',
              'qty'=>'required|numeric',
              'details'=>'required',
          ];
      }

      protected function getMsg(){
        return $msg=[
            'name.required'=>'this name must be required naruto',
            'price.required'=>'this price must be required naruto',
            'qty.required'=>'this qty must be required naruto',
            'price.numeric'=>'this price must be numeric naruto',
        ];
      }

}
