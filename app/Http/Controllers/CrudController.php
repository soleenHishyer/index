<?php

namespace App\Http\Controllers;

use App\Models\Offer;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getOffers()
    {
        return Offer::get();
    }
    public function create()
    {
        // Offer::create(['name'=>'offer2','price'=>'5000','details'=>'offer details']);
        return view('offers.create');
    }
    public function store(Request $request)
    {
        $rules=$this->getRules();
        $messeges=$this->getMesseges();
       $validator=Validator::make($request->all(),$rules,$messeges);
        if($validator->fails())
        {
           return  redirect()->back()->withErrors($validator)->withInput($request->all());
        }
       Offer::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'details'=>$request->details,
        ]);
       return 'saved saccess';
       //return $request;
        return redirect()->back()->with(['success'=>'ثم اضافه العرض نضام']);
    }

    protected function getMesseges()
    {
        return $messges=[
            'name.required'=>'اسم المطلوب',
            'price.numeric'=>'ممكن رقم',

        ];
    }
    protected function getRules()
    {
        return $rules=[
            'name'=>'required|max:100|unique:offers.name',
            'price'=>'required|numeric',
            'details'=>'required',
        ];
    }
}
