<?php

namespace App\Http\Controllers;

use App\Dog;
use App\Microchip;
use Illuminate\Http\Request;

class DeleteHistoryController extends Controller
{
    public function history_all()
    {
        $dogs = Dog::onlyTrashed()->get();
        $microchips = Microchip::onlyTrashed()->get();

        return view('delete_history.index',compact('dogs','microchips'));
    }

    public function history_sort($type){
        if ($type == 'สุนัข'){
            $dogs = Dog::onlyTrashed()->get();
            $microchips = null;
            
            return view('delete_history.index',compact('dogs','microchips'));
            
        } elseif ($type == 'ไมโครชิพ') {
            $microchips = Microchip::onlyTrashed()->get();
            $dogs = null;
            
            return view('delete_history.index',compact('dogs','microchips'));
        }
    }

    public function restore_dog($id) 
    {
        $restore_dog = Dog::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','กู้คืนข้อมูลแล้ว');
    }

    public function restore_microchip($id) 
    {
        $restore_microchip = Microchip::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','กู้คืนข้อมูลแล้ว');
    }

    public function destroy_dog($id)
    {
        $destroy_dog = Dog::onlyTrashed()->where('id', $id)->forceDelete();

        return redirect()->back()->with('success','ลบข้อมูลแล้ว');
    }

    public function destroy_microchip($id)
    {
        $destroy_microchip = Microchip::onlyTrashed()->where('id', $id)->forceDelete();

        return redirect()->back()->with('success','ลบข้อมูลแล้ว');
    }
}
