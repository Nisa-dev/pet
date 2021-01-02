<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon; 
use PDF;
use App\Contact;
use App\Order;
use App\Sell;
use App\InstallMicrochip;
use App\Dog;
use App\Microchip;
use DB;

class ReportController extends Controller
{
    public function stock(){
        $dogs = Dog::where('dog_status',0)->get();
        $microchips = Microchip::where('microchip_status',0)->get();

        return view('reports.stock',compact('dogs','microchips'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function stock_sort($type){
        if ($type == 'สุนัข'){
            $dogs = Dog::where('dog_status',0)->get();
            $microchips = null;
            
            return view('reports.stock',compact('dogs','microchips'))->with('i', (request()->input('page', 1) - 1) * 10);
            
        } elseif ($type == 'ไมโครชิพ') {
            $microchips = Microchip::where('microchip_status',0)->get();
            $dogs = null;
            
            return view('reports.stock',compact('dogs','microchips'))->with('i', (request()->input('page', 1) - 1) * 10);
        }
    }

    public function report_install(){
        $installs = InstallMicrochip::orderBy('id','DESC')->paginate(20);

        return view('reports.install_microchip',compact('installs'));
    }

    public function search_report_install(Request $request){
        $search = $request->get('search');
        $installs = InstallMicrochip::where('install_microchip_no', 'like', '%'.$search.'%')
            ->orderBy('id','ASC')->paginate(20);
            
        //dd($installs);
        return view('reports.install_microchip',compact('installs'));
    }

    public function total_sell()
    {
        $sells = Sell::all();
        $select_months = Sell::select('created_at')->orderBy('created_at','asc')->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });
        $select_years = Sell::select('created_at')->orderBy('created_at','asc')->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        });
        $option = 'op_all';
        $range = 'all';

        return view('reports.total_sell', compact('sells','select_months','select_years','option','range'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function total_sell_sort(Request $request)
    {
        $select_months = Sell::select('created_at')->orderBy('created_at','asc')->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });
        $select_years = Sell::select('created_at')->orderBy('created_at','asc')->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        });

        $view_option = $request->options;
        if($view_option == 'op_date') {
            $get_date = $request->getDate;
            $option = 'op_date';
            $range = $get_date;
            $sells = Sell::whereDate('created_at', $get_date)->get();
        } elseif ($view_option == 'op_month') {
            $get_month = Carbon::parse($request->getMonth)->format('m');
            $get_year = Carbon::parse($request->getMonth)->format('Y');
            $option = 'op_month';
            $range = $get_year.'-'.$get_month;
            $sells = Sell::whereMonth('created_at', $get_month)
                ->whereYear('created_at', $get_year)
                ->get();
        } elseif ($view_option == 'op_year') {
            $get_year = $request->getYear;
            $option = 'op_year';
            $range = $get_year;
            $sells = Sell::whereYear('created_at', $get_year)->get();
        } elseif ($view_option == 'op_all') {
            $option = 'op_all';
            $range = 'all';
            $sells = Sell::all();
        }
        return view('reports.total_sell', compact('sells','select_months','select_years','option','range'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function pdf_order($id){
        $order = Order::find($id);
        $contact = Contact::first();
        
        $pdf = PDF::loadView('reports.pdf_order', compact(
            'order', 'contact'
        ));
        $pdf->setPaper('A4');
        return @$pdf->stream('ใบเสร็จรับเงิน.pdf');
    }

    public function pdf_sell($id){
        $sell = Sell::find($id);
        $contact = Contact::first();
        
        $pdf = PDF::loadView('reports.pdf_sell', compact(
            'sell', 'contact'
        ));
        $pdf->setPaper('A4');
        return @$pdf->stream('ใบรายการขาย.pdf');
    }

    public function pdf_install_microchip($id){
        $install = InstallMicrochip::find($id);
        $contact = Contact::first();
        
        $pdf = PDF::loadView('reports.pdf_install_microchip', compact(
            'install', 'contact'
        ));
        $pdf->setPaper('A5', 'landscape');
        return @$pdf->stream('Certifies.pdf');
    }

    public function pdf_stock(){
        $dogs = Dog::where('dog_status',0)->get();
        $microchips = Microchip::where('microchip_status',0)->get();
        $contact = Contact::first();

        $results1 = $dogs->chunk(20);
        $results2 = $microchips->chunk(20);

        $mytime = Carbon::now();
        
        $pdf = PDF::loadView('reports.pdf_stock', compact(
            'results1','results2', 'contact' ,'mytime'
        ));
        $pdf->setPaper('A4');
        return @$pdf->stream('ใบรายการสินค้าคงเหลือ.pdf');
    }

    public function pdf_total_sell(Request $request ,$option){
        $contact = Contact::first();

        if($option == 'op_date') {
            $get_date = $request->range;
            $sells = Sell::whereDate('created_at', $get_date)->get();
        } elseif ($option == 'op_month') {
            $get_month = Carbon::parse($request->range)->format('m');
            $get_year = Carbon::parse($request->range)->format('Y');

            $sells = Sell::whereMonth('created_at', $get_month)
                ->whereYear('created_at', $get_year)
                ->get();
        } elseif ($option == 'op_year') {
            $get_year = $request->range;
            $sells = Sell::whereYear('created_at', $get_year)->get();
        } elseif ($option == 'op_all') {
            $sells = Sell::all();
        }

        $option = $request->option;
        $range = $request->range;

        $results = $sells->chunk(20);

        $pdf = PDF::loadView('reports.pdf_total_sell', compact(
            'results','sells', 'contact' ,'option','range'
        ));
        $pdf->setPaper('A4');
        return @$pdf->stream('ใบรายงานยอดขาย.pdf');
    }
}
