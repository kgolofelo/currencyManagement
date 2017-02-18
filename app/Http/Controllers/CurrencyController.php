<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
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

    /**
    * Display a list of all currencies.
    *
    * @return Response
    */
   public function index()
   {
		$currencies = \App\Currency::all();
		return view('currency')->with('currencies',$currencies);
   }
   
   /**
    * Store a newly created currency.
    *
    * @param  Request  $request
    * @return Response
    */
   public function store(Request $request)
   {
	   $currencyResult = \App\Currency::create($request->all());
	   return $currencyResult;
   }
   
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
   public function show($id)
   {
       $currencyResult = \App\Currency::find($id);
	   return $currencyResult;;
   }

   /**
    * Update the specified currency.
    *
    * @param  Request  $request
    * @param  int  $id
    * @return Response
    */
   public function update(Request $request, $id)
   {
	   $currency = \App\Currency::find($id);
	   $currency->name = $request->name;
	   $currency->code = $request->code;
	   $currency->rate = $request->rate;
	   $currency->save();
	   return $currency;
   }

   /**
    * Remove the specified currency from the database.
    *
    * @param  int  $id
    * @return Response
    */
   public function destroy($id)
   {
	   $currencyResult = \App\Currency::where('id',$id)->delete();
	   return $currencyResult;
   }
   
    /**
    * Delete all currencies from the database.
    *
    * @return deleteResult
    */
   public function destroyAll()
   {
	   $deleteResult = \App\Currency::getQuery()->delete();
	   return $deleteResult;
   }
   
   /**
    * Delete all currencies from the database.
    *
	* @param  Request  $request
    * @return deleteResult
    */
   public function calculateAmount(Request $request)
   {
	   $rateFrom = \App\Currency::where('id',$request->rateFromId)->get(['name','rate','code','updated_at']);
	   $rateTo = \App\Currency::where('id',$request->rateToId)->get(['name','rate','code','updated_at']);
	   
	   $amount =  \App\Currency::calculateAmount($rateFrom[0]->rate,$rateTo[0]->rate,$request->amount);
	   
	   return array("fromName"=>$rateFrom[0]->name,
					"toName"=>$rateTo[0]->name,
					"fromCode"=>$rateFrom[0]->code,
					"toCode"=>$rateTo[0]->code,
					"CurrencyFromUpdateDt"=>date("Y-m-d H:i:s",strtotime($rateFrom[0]->updated_at)),
					"CurrencyToUpdateDt"=>date("Y-m-d H:i:s",strtotime($rateTo[0]->updated_at)),
					"unitAmount"=>$amount["unitAmount"],
					"totalAmount"=>$amount["total"]);
   }
  
}
