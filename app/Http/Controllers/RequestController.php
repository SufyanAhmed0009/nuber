<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use DB;

class RequestController extends Controller
{
    

    // create Booking Request
    public function store(Request $request)
    {
        $book = new Booking;
        
        $book->Name=$request->input('Name');
        $book->Email=$request->input('Email');
        $book->Car_type=$request->input('Car_type');
//      $book->Status=$request->input('Status');
        $book->Status='Pending';
        $book->Code = $this->unique_code(8);
        $book->save();
     //  $code = unique_code(8);
        return response()->json("Your Booking Reference Number is: ".$book->Code);

    }

    public function unique_code($limit)
    {
    return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
    
     //for cancel the booking
    public function cancel(Request $request, $code)
    {
        $cancel= new Booking;
        $cancel=Booking::where('Code',$code)->first();
        $cancel->Status=$request->input('Status');
        $cancel->save();

        return response()->json("The booking has been cancelled");
    }

    // List of all Bookings
    public function get()
    {
        $book = Booking::all();
        return response()->json($book);
     }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     // using pluck
    public function show()
    {
    // for all record of single column
        $book=Booking::pluck('Name');
      //for first record
      //   $book=Booking::pluck('Name')->first();
        return response()->json($book);
     }

     

      public function showid($code){
       
       // $book=Booking::find($code);
      //select statement with 'where' clause
         $book = Booking::where('Code','=',$code)->get(); 
        return response()->json($book);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     // for 
    public function update (Request $request,$a)
    {
        $book = new Booking;
        $book= Booking::where('Code', $a)->first();
        //echo $a;
        //dd($book->id);
        //echo $book;
        $book->Status= $request->input('Status');
        $book->save();
       return response()->json( ['message' => 'Updated Successfully']);
     
    }

  

      public function delete(Booking $id)
    {
        $id->delete();

        return response()->json(
            ['Message' => 'Deleted']
        );
    }
    
    //checking status
    public function status()
    {
        $status= Booking::where('Status','accepted')->get();
        return response()->json($status);
    }

   
}
