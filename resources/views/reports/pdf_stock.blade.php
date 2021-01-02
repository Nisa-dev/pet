<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>ใบรายการสินค้าคงเหลือ</title>
    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}">
</head>
<body>
    <div style="line-height:5px; text-align:center;">
        <h2>{{$contact->contact_name}}</h2>
        <h3 style="font-weight:normal;">{{$contact->contact_address}}</h3>
        <h3 style="font-weight:normal;">โทร {{$contact->contact_tel_no}}</h3>
        <h3 style="font-weight:normal;">Facebook : {{$contact->contact_facebook}}</h3>
    </div>
    <hr style="color:#bdc3c7;">

    <div style="text-align:right; line-height:15px;">
        <b>วันที่ :</b> {{ $mytime->format('d M Y') }}
        <h1 style="text-align:center;">ใบรายการสินค้าคงเหลือ</h1>
    </div>

    <input type="hidden" value="{{$i = 1}}">
    <input type="hidden" value="{{$total_dog_buy = 0}}">
    <input type="hidden" value="{{$total_dog_sell = 0}}">
    <input type="hidden" value="{{$total_microchip_buy = 0}}">
    <input type="hidden" value="{{$total_microchip_sell = 0}}">
    
      
    <table style="line-height:10px;">
        <tr style="background-color:#bdc3c7;">
            <th style="text-align:center;">ลำดับ</th>
            <th style="text-align:center;">รายการ</th>
            <th style="text-align:center;">ประเภท</th>
            <th style="text-align:center;">ราคาซื้อ</th>
            <th style="text-align:center;">ราคาขาย</th>
        </tr>
       @foreach($results1 as $results1)
            @foreach($results1 as $dog)
              <tr>
                  <td style="text-align:center;">{{ $i++ }}</td>
                  <td >{{ $dog->dog_breed }} {{ $dog->dog_color }} {{ $dog->dog_sex }} {{ $dog->dog_farm_name }}</td>
                  <td>สุนัข</td>
                  <td style="text-align:right;">{{number_format($dog->dog_buy_price,2)}}</td>
                  <td style="text-align:right;">{{number_format($dog->dog_sell_price,2)}}</td>
                  <input type="hidden" value="{{$total_dog_buy += $dog->dog_buy_price}}">
                  <input type="hidden" value="{{$total_dog_sell += $dog->dog_sell_price}}">
              </tr>
            @endforeach
        @endforeach
        @foreach($results2 as $results2)
            @foreach($results2 as $microchip)
            <tr>
                <td style="text-align:center;">{{ $i++ }}</td>
                <td >{{ $microchip->microchip_no }}</td>
                <td>ไมโครชิพ</td>
                <td style="text-align:right;">{{number_format($microchip->microchip_buy_price,2)}}</td>
                <td style="text-align:right;">{{number_format($microchip->microchip_sell_price,2)}}</td>
                <input type="hidden" value="{{$total_microchip_buy += $microchip->microchip_buy_price}}">
                <input type="hidden" value="{{$total_microchip_sell += $microchip->microchip_sell_price}}">
            </tr>
            @endforeach
        @endforeach
        <tr>
                <th style="text-align:right;" colspan="3">รวม</th>
                <th style="text-align:right;">{{number_format($total_buy = $total_dog_buy + $total_microchip_buy,2)}}</th>
                <th style="text-align:right;">{{number_format($total_sell = $total_dog_sell + $total_microchip_sell,2)}}</th>
            </tr>
            <tr>
                <th style="text-align:right;" colspan="3">รวมราคาทุน</th>
                <th style="text-align:right;" colspan="2">{{number_format($total_sell - $total_buy,2)}}</th>
            </tr>
        </table>

</body>
</html>