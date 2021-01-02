<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sell;

class SellController extends Controller
{
    public function index()
    {
        $sells = Sell::orderBy('id','DESC')->paginate(20);

        return view('sells.index',compact('sells'));
    }

    public function show($id)
    {
        $sell = Sell::find($id);

        return view('sells.show',compact('sell'));
    }
}
