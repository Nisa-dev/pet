<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>ใบเสร็จ {{ $order->id }}</title>
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
        <b>วันที่ :</b> {{ $order->updated_at->format('d M Y') }}
        <h1 style="text-align:center;">ใบเสร็จ</h1>
    </div>
                <table style="line-height:15px;">
                    <tr>
                        <td style="border: 0px;"><b>ชื่อ-นามสกุล :</b> {{ $order->order_cus_name }}</td>
                    </tr>
                    <tr>
                        <td style="border: 0px;"><b>เบอร์โทร :</b> {{ $order->order_cus_tel_no }}</td>
                    </tr>
                    <tr>
                        <td style="border: 0px;">
                                <b>ที่อยู่ :</b>
                                บ้านเลขที่ {{$order->order_cus_house_no}} 
                                หมู่ที่ {{$order->order_cus_village_no}} 
                                ซอย {{$order->order_cus_lane}} 
                                ถนน {{$order->order_cus_road}} 
                                จังหวัด {{$order->order_cus_province}} 
                                อำเภอ {{$order->order_cus_amphures}} 
                                @if ($order->order_cus_districts != null)
                                    ตำบล {{$order->order_cus_districts}}
                                @endif
                                หมายเลขไปรณีย์ {{$order->order_cus_post_no}}
                        </td>
                    </tr>
                </table><br>
                <table>
                    <tr style="background-color:#bdc3c7;">
                        <th colspan="4" style="text-align:center;">รายการ</th>
                        <th style="text-align:center;">ราคา</th>
                    </tr>
                        @if ($order->order_dog != null)
                        <tr>
                            <td colspan="4" >{{ $order->order_dog }}</td>
                            <td style="text-align:right;">{{ number_format($order->order_dog_sell_price, 2) }}</td>
                        </tr>
                        @endif
                        @if ($order->order_microchip != null)
                        <tr>
                            <td colspan="4" >{{ $order->order_microchip }}</td>
                            <td style="text-align:right;">{{ number_format($order->order_microchip_sell_price, 2) }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th colspan="4" style="text-align:right;">รวมเงิน</td>
                            <td style="text-align:right;">{{ number_format($total_sell = $order->order_dog_sell_price+$order->order_microchip_sell_price, 2) }}</td>
                        </tr>
                        <tr>
                            <th colspan="4" style="text-align:right;">ส่วนลด</td>
                            <td style="text-align:right;">{{ number_format($total_discount = $order->order_dog_discount_price+$order->order_microchip_discount_price, 2) }}</td>
                        </tr>
                        <tr>
                            <th colspan="4" style="text-align:right;">ค่าจัดส่ง</td>
                            <td style="text-align:right;">{{ number_format($order->order_transport_price, 2) }}</td>
                        </tr>
                        <tr>
                            <th colspan="4" style="text-align:right;">จำนวนเงินชำระสุทธิ</td>
                            <th style="text-align:right;">{{ number_format($total_sell - $total_discount + $order->order_transport_price, 2) }}</td>
                        </tr>
                </table>
        

</body>
</html>