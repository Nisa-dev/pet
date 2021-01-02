<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dog;
use App\Microchip;
use App\DogFarm;
use App\User;
use App\Order;
use App\Transport;
use App\Sell;
use Auth;

use Charts;
use DB;

class RoleController extends Controller
{
    public function dashboard_admin()
    {
        $count_dog = Dog::count();
        $count_microchip = Microchip::count();
        $count_dog_farm = DogFarm::count();
        $count_user = User::count();

        $sells = Sell::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();

        $chart = Charts::database($sells, 'line', 'highcharts')
            ->title("จำนวนการขายทั้งหมดในปี")
            ->elementLabel("ขายทั้งหมด")
            ->dimensions(1000, 500)
            ->responsive(true)
            ->groupByMonth(date('Y'), false);

        $pie = Charts::database(Dog::all(), 'pie', 'highcharts')
            ->title('จำนวนสุนัขในฟาร์ม')
            ->dimensions(1000, 500)
            ->responsive(true)
            ->groupBy('dog_farm_name');

        return view('/dashboards/admin',compact('count_dog','count_microchip','count_dog_farm','count_user','chart','pie'));
    }

    public function dashboard_deliveryman()
    {
        $count_order = Order::where('order_deliveryman', Auth::user()->name)->count();
        $count_transport = Transport::count();
        $new_orders = Order::where('order_deliveryman', Auth::user()->name)
            ->where('order_status', '0')->latest()->paginate(10); 

        return view('/dashboards/deliveryman',compact('count_order','count_transport','new_orders'));
    }
}
