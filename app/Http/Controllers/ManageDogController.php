<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DogFarm;
use App\Dog;
use App\Microchip;
use App\InstallMicrochip;
use App\RequestChangeOwner;
use DB;

class ManageDogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dogs = Dog::orderBy('dog_status','ASC')->orderBy('id','DESC')->paginate(20);
        $dog_farms = DogFarm::all();
        $microchips = Microchip::where('microchip_status', '=', 0)->get();

        return view('manage_dogs.index',compact('dogs','dog_farms','microchips'));
    }

    public function index_sort_farm($dog_farm_name)
    {
        $dogs = Dog::where('dog_farm_name',$dog_farm_name)->orderBy('dog_status','ASC')->orderBy('id','DESC')->paginate(20);
        $dog_farms = DogFarm::all();
        $microchips = Microchip::where('microchip_status', '=', 0)->get();

        return view('manage_dogs.index',compact('dogs','dog_farms','microchips'));
    }

    public function index_sort_sex($id)
    {
        $dogs = Dog::where('dog_sex',$id)->orderBy('dog_status','ASC')->orderBy('id','DESC')->paginate(20);
        $dog_farms = DogFarm::all();
        $dog_sex = Dog::where('dog_sex',$id)->orderBy('id','DESC')->paginate(20);
        $microchips = Microchip::where('microchip_status', '=', 0)->get();

        return view('manage_dogs.index',compact('dogs','dog_farms','dog_sex','microchips'));
    }

    public function index_sort_status($dog_status)
    {
        $dogs = Dog::where('dog_status',$dog_status)->orderBy('id','DESC')->paginate(20);
        $dog_farms = DogFarm::all();
        $dog_status = Dog::where('dog_status',$dog_status)->orderBy('id','DESC')->paginate(20);
        $microchips = Microchip::where('microchip_status', '=', 0)->get();

        return view('manage_dogs.index',compact('dogs','dog_farms','dog_status','microchips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dog_farms = DogFarm::all();

        return view('manage_dogs.create',compact('dog_farms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'dog_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dog_buy_price' => 'numeric|digits_between:0,8',
            'dog_sell_price' => 'numeric|digits_between:0,8|gt:dog_buy_price',
        ]);

        if ($request->hasfile('dog_image')) {
            $image_name = time().'.'.request()->dog_image->getClientOriginalExtension();
            request()->dog_image->move(public_path('image/dogs'), $image_name);

            $dog = new Dog([
                'dog_breed' => $request->dog_breed,
                'dog_color' => $request->dog_color,
                'dog_sex' => $request->dog_sex,
                'dog_birth_date' => $request->dog_birth_date,
                'dog_farm_name' => $request->dog_farm_name,
                'dog_buy_price' => $request->dog_buy_price,
                'dog_sell_price' => $request->dog_sell_price,
                'dog_image' => $image_name,
                'dog_status' => $request->dog_status,
                'install_status' => $request->install_status,
                'microchip_id' => $request->microchip_id,
            ]);
            $dog->save();
        }
        else {
            $dog = new Dog([
                'dog_breed' => $request->dog_breed,
                'dog_color' => $request->dog_color,
                'dog_sex' => $request->dog_sex,
                'dog_birth_date' => $request->dog_birth_date,
                'dog_farm_name' => $request->dog_farm_name,
                'dog_buy_price' => $request->dog_buy_price,
                'dog_sell_price' => $request->dog_sell_price,
                'dog_status' => $request->dog_status,
                'install_status' => $request->install_status,
                'microchip_id' => $request->microchip_id,
            ]);
            $dog->save();
        }

        // เพิ่มจำนวนนับฟาร์ม
        DogFarm::where('dog_farm_name', $request->dog_farm_name)
            ->increment('dog_farm_count',1);

        return redirect()->route('manage_dogs.index')->with('success','เพิ่มสุนัขแล้ว');
    }

    public function show_install($id)
    {
        $install_microchip = InstallMicrochip::where('dog_id',$id)->first();

        $request_changes = RequestChangeOwner::where('request_change_owner_status','1')
        ->where('dog_id',$id)->get();

        $provinces = DB::table('provinces')
            ->orderBy('name_th','asc')
            ->get();

        return view('manage_dogs.show_install',compact('install_microchip','provinces','request_changes'))
        ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dog = Dog::find($id);
        $dog_farms = DogFarm::all();

        return view('manage_dogs.edit',compact('dog','dog_farms'));
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
        request()->validate([
            'dog_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dog_buy_price' => 'numeric|digits_between:0,8',
            'dog_sell_price' => 'numeric|digits_between:0,8|gt:dog_buy_price',
        ]);

        if ($request->hasfile('dog_image')){
            $image_name = time().'.'.request()->dog_image->getClientOriginalExtension();
            request()->dog_image->move(public_path('image/dogs'), $image_name);

            $dog = Dog::find($id);
            $dog->dog_breed = $request->dog_breed;
            $dog->dog_color = $request->dog_color;
            $dog->dog_sex = $request->dog_sex;
            $dog->dog_birth_date = $request->dog_birth_date;
            $dog->dog_farm_name = $request->dog_farm_name;
            $dog->dog_buy_price = $request->dog_buy_price;
            $dog->dog_sell_price = $request->dog_sell_price;
            $dog->dog_image = $image_name;
            $dog->dog_status = $request->dog_status;
            $dog->install_status = $request->install_status;
            $dog->microchip_id = $request->microchip_id;
            $dog->save();
        }
        else {
            $dog = Dog::find($id);
            $dog->dog_breed = $request->dog_breed;
            $dog->dog_color = $request->dog_color;
            $dog->dog_sex = $request->dog_sex;
            $dog->dog_birth_date = $request->dog_birth_date;
            $dog->dog_farm_name = $request->dog_farm_name;
            $dog->dog_buy_price = $request->dog_buy_price;
            $dog->dog_sell_price = $request->dog_sell_price;
            $dog->dog_status = $request->dog_status;
            $dog->install_status = $request->install_status;
            $dog->microchip_id = $request->microchip_id;
            $dog->save();
        }

        return redirect()->route('manage_dogs.index')-> with('success','แก้ไขสุนัขแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $dog = Dog::find($id);
        $dog->delete();

        // ลบจำนวนนับฟาร์ม
        DogFarm::where('dog_farm_name', $request->dog_farm_name)
            ->decrement('dog_farm_count',1);

        return redirect()->route('manage_dogs.index')-> with('success','ลบสุนัขแล้ว');
    }

    public function search_dog(Request $request){
        $search = $request->get('search');
        $dog_farms = DogFarm::all();
        $microchips = Microchip::where('microchip_status', '=', 0)->get();
        $dogs = Dog::where('id', 'like', '%'.$search.'%')
            ->orderBy('id','ASC')->paginate(20);

        return view('manage_dogs.index',compact('dogs','dog_farms','microchips'));
    }
}
