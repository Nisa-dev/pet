<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>ใบรายการขาย {{ $sell->id }}</title>
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
        <b>วันที่ :</b> {{ $sell->updated_at->format('d M Y') }}
        <h1 style="text-align:center;">ใบรายการขาย</h1>
    </div>
                <table style="line-height:15px;">
                    <tr>
                        <td style="border: 0px;"><b>ชื่อ-นามสกุล :</b> {{ $sell->sell_cus_name }}</td>
                    </tr>
                    <tr>
                        <td style="border: 0px;"><b>เบอร์โทร :</b> {{ $sell->sell_cus_tel_no }}</td>
                    </tr>
                    <tr>
                        <td style="border: 0px;">
                                <b>ที่อยู่ :</b> {{$sell->sell_cus_address}} 
                        </td>
                    </tr>
                </table><br>
                <table>
                    <tr style="background-color:#bdc3c7;">
                        <th colspan="4" style="text-align:center;">รายการ</th>
                        <th style="text-align:center;">ส่วนลด</th>
                        <th style="text-align:center;">ราคาซื้อ</th>
                        <th style="text-align:center;">ราคาขาย</th>
                    </tr>
                        @if ($sell->sell_dog != null)
                        <tr>
                            <td colspan="4" >{{ $sell->sell_dog }}</td>
                            <td style="text-align:right;">{{ number_format($sell->sell_dog_discount_price, 2) }}</td>
                            <td style="text-align:right;">{{ number_format($sell->sell_dog_buy_price, 2) }}</td>
                            <td style="text-align:right;">{{ number_format($sell->sell_dog_sell_price, 2) }}</td>
                        </tr>
                        @endif
                        @if ($sell->sell_microchip != null)
                        <tr>
                            <td colspan="4" >{{ $sell->sell_microchip }}</td>
                            <td style="text-align:right;">{{ number_format($sell->sell_microchip_discount_price, 2) }}</td>
                            <td style="text-align:right;">{{ number_format($sell->sell_microchip_buy_price, 2) }}</td>
                            <td style="text-align:right;">{{ number_format($sell->sell_microchip_sell_price, 2) }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th colspan="6" style="text-align:right;">รวมราคาขาย</td>
                            <td style="text-align:right;">{{ number_format($total_sell = $sell->sell_dog_sell_price+$sell->sell_microchip_sell_price, 2) }}</td>
                        </tr>
                        <tr>
                            <th colspan="6" style="text-align:right;">รวมราคาซื้อ</td>
                            <td style="text-align:right;">{{ number_format($total_buy = $sell->sell_dog_buy_price+$sell->sell_microchip_buy_price, 2) }}</td>
                        </tr>
                        <tr>
                            <th colspan="6" style="text-align:right;">รวมส่วนลด</td>
                            <td style="text-align:right;">{{ number_format($total_discount = $sell->sell_dog_discount_price+$sell->sell_microchip_discount_price, 2) }}</td>
                        </tr>
                        <tr>
                            <th colspan="6" style="text-align:right;">ค่าจัดส่ง</td>
                            <td style="text-align:right;">{{ number_format($sell->sell_transport_price, 2) }}</td>
                        </tr>
                        <tr>
                            <th colspan="6" style="text-align:right;">ราคาขายสุทธิ</td>
                            <th style="text-align:right;">{{ number_format($total_sell - $total_discount + $sell->sell_transport_price, 2) }}</td>
                        </tr>
                        <tr>
                            <th colspan="6" style="text-align:right;">กำไร</td>
                            <th style="text-align:right;">{{ number_format($total_sell - $total_buy - $total_discount + $sell->sell_transport_price, 2) }}</td>
                        </tr>
                </table>
        

</body>
</html>