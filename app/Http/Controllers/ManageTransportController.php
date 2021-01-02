<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transport;
use App\Order;

class ManageTransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transports = Transport::orderBy('id','DESC')->paginate(20);

        return view('manage_transports.index',compact('transports'));
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
        $transport = new Transport([
            'transport_name' => $request->transport_name,
            'transport_price' => $request->transport_price,
            'transport_count' => $request->transport_count,
        ]);
        $transport->save();

        return redirect()->route('manage_transports.index')->with('success','เพิ่มช่องทางจัดส่งแล้ว');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $transport_name)
    {
        $transport_id = Transport::find($id); 
        $orders = Order::where('order_transport',$transport_name)->orderBy('id','DESC')->paginate(20);
  
        // dd($transport_name);
        return view('manage_transports.show',compact('transport_id','orders'));
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
        $transport = Transport::find($id);
        $transport->transport_name = $request->transport_name;
        $transport->transport_price = $request->transport_price;
        $transport->transport_count = $request->transport_count;
        $transport->save();

        return redirect()->route('manage_transports.index')->with('success','แก้ไขช่องทางจัดส่งแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transport = Transport::find($id);
        $transport->delete();

        return redirect()->route('manage_transports.index')->with('success','ลบช่องทางจัดส่งแล้ว');
    }
}
