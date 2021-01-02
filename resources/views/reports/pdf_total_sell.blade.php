<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>ใบรายงานยอดขาย</title>
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
        @if ($option == 'op_all')
        <h1 style="text-align:center;">ใบรายงานยอดขายทั้งหมด</h1>
        @elseif ($option == 'op_date')
        <h1 style="text-align:center;">ใบรายงานยอดขาย {{$range}}</h1>
        @elseif ($option == 'op_month')
        <h1 style="text-align:center;">ใบรายงานยอดขาย {{$range}}</h1>
        @elseif ($option == 'op_year')
        <h1 style="text-align:center;">ใบรายงานยอดขายปี {{$range}}</h1>  
        @endif
    </div>

    <input type="hidden" value="{{$i = 1}}">
    <input type="hidden" value="{{$total = 0}}">
      
    <table style="line-height:10px;">
        <tr style="background-color:#bdc3c7;">
            <th style="text-align:center;">ลำดับ</th>
            <th style="text-align:center;">รายการ</th>
            <th style="text-align:center;">วันที่ขาย</th>
            <th style="text-align:center;">ราคา</th>
        </tr>
       @foreach($results as $results)
            @foreach($results as $sell)
              <tr>
                    <td style="text-align:center;">{{ $i++ }}</td>
                    {{-- List --}}
                    @if ($sell->sell_dog != null && $sell->sell_microchip == null)
                    <td>{{ $sell->sell_dog }}</td>
                    @elseif ($sell->sell_microchip != null && $sell->sell_dog == null)
                        <td>{{ $sell->sell_microchip }}</td>
                    @elseif ($sell->sell_dog != null && $sell->sell_microchip != null)
                        <td>{{ $sell->sell_dog }} ,<br> {{ $sell->sell_microchip }}</td>
                    @endif
                    <td style="text-align:center;">{{ $sell->created_at->format('d/m/Y') }}</td>
                    {{-- price --}}
                    @if ($sell->sell_dog != null && $sell->sell_microchip == null)
                    <td style="text-align:right;">{{ number_format($sell_net = $sell->sell_dog_sell_price - $sell->sell_dog_discount_price - $sell->sell_transport_price,2) }}</td>
                    @elseif ($sell->sell_microchip != null && $sell->sell_dog == null)
                    <td style="text-align:right;">{{ number_format($sell_net = $sell->sell_microchip_sell_price - $sell->sell_microchip_discount_price - $sell->sell_transport_price,2) }}</td>
                    @elseif ($sell->sell_dog != null && $sell->sell_microchip != null)
                    <td style="text-align:right;">{{ number_format($sell_net = $sell->sell_dog_sell_price + $sell->sell_microchip_sell_price - $sell->sell_dog_discount_price - $sell->sell_microchip_discount_price - $sell->sell_transport_price,2) }}</td>
                    @endif
                    <input type="hidden" value="{{$total += $sell_net}}">
              </tr>
            @endforeach
        @endforeach
            <tr>
                <th style="text-align:right;" colspan="3">รวม</th>
                <th style="text-align:right;">{{number_format($total,2)}}</th>
            </tr>
        </table>

</body>
</html>