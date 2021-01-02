<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;

class ManageExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::orderBy('id','ASC')->paginate(20);

        return view('manage_expenses.index',compact('expenses'));
    }

    public function index_deliveryman()
    {
        $expenses = Expense::orderBy('id','ASC')->paginate(20);

        return view('manage_expenses.index_deliveryman',compact('expenses'));
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
        $expense = new Expense([
            'list' => $request->list,
            'amount' => $request->amount,
            'cost' => $request->cost,
        ]);
        $expense->save();

        return redirect()->back()->with('success','เพิ่มรายการค่าใช้จ่ายแล้ว');
    }
    public function store_deliveryman(Request $request)
    {
        $expense = new Expense([
            'list' => $request->list,
            'amount' => $request->amount,
            'cost' => $request->cost,
        ]);
        $expense->save();

        return redirect()->back()->with('success','เพิ่มรายการค่าใช้จ่ายแล้ว');
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
        $expense = Expense::find($id);
        $expense->list = $request->list;
        $expense->amount = $request->amount;
        $expense->cost = $request->cost;
        $expense->save();

        return redirect()->back()->with('success','แก้ไขรายการค่าใช้จ่ายแล้ว');
    }
    public function update_deliveryman(Request $request, $id)
    {
        $expense = Expense::find($id);
        $expense->list = $request->list;
        $expense->amount = $request->amount;
        $expense->cost = $request->cost;
        $expense->save();

        return redirect()->back()->with('success','แก้ไขรายการค่าใช้จ่ายแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::find($id);
        $expense->delete();

        return redirect()->route('manage_expenses.index')->with('success','ลบรายการค่าใช้จ่ายแล้ว');
    }
    public function destroy_deliveryman($id)
    {
        $expense = Expense::find($id);
        $expense->delete();

        return redirect()->route('manage_expenses.index_deliveryman')->with('success','ลบรายการค่าใช้จ่ายแล้ว');
    }
}
