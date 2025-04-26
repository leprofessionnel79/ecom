<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{__('customlang.invoice')}} #{{$order->id}}</title>


    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
            font-weight: 500;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
            font-weight: 500;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;

        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;

        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;

        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;

        }
        .total-heading {
            font-size: 18px;
            font-weight: 500;
            font-family: sans-serif;

        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>
<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-center">{{$appSetting->website_name}}</h2>
                </th>
                <th width="50%" colspan="2" class="text-start company-data">
                    <span>Invoice Id: #{{$order->id}}</span> <br>
                    <span>Date: {{date('d / m / Y')}}</span> <br>
                    <span>Zip code : 560077</span> <br>
                    <span>{{__('customlang.address')}}: Damas Syria</span> <br>
                </th>
            </tr>
            <tr class="bg-blue text-center">
                <th width="50%" colspan="2" class="text-center">{{__('customlang.orderDetails')}}</th>
                <th width="50%" colspan="2" class="text-center">{{__('customlang.userDetails')}}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{__('customlang.orderID')}}:</td>
                <td>{{$order->id}}</td>

                <td>{{__('customlang.fullName')}}:</td>
                <td>{{$order->fullname}}</td>
            </tr>
            <tr>
                <td>Tracking Id/No.:</td>
                <td>{{$order->tracking_no}}</td>

                <td>{{__('customlang.emailID')}}:</td>
                <td>{{$order->email}}</td>
            </tr>
            <tr>
                <td>{{__('customlang.orderDate')}}:</td>
                <td>{{$order->created_at->format('d-m-Y h:i A')}}</td>

                <td>{{__('customlang.phone')}}:</td>
                <td>{{$order->phone}}</td>
            </tr>
            <tr>
                <td>{{__('customlang.paymentMode')}}:</td>
                <td>{{$order->payment_mode}}</td>

                <td>{{__('customlang.address')}}:</td>
                <td>{{$order->address}}</td>
            </tr>
            <tr>
                <td>{{__('customlang.orderStatus')}}:</td>
                <td>{{$order->status_message}}</td>

                <td>Pin code:</td>
                <td>{{$order->pincode}}</td>
            </tr>
        </tbody>
    </table>

    <table dir="{{App::getLocale()=='ar'?'rtl':'ltr'}}">
        <thead>
            <tr>
                <th class="no-border text-center heading" colspan="5">
                    {{__('customlang.orderItems')}}
                </th>
            </tr>
            <tr class="bg-blue text-centre">
                <th class="text-center">ID</th>
                <th class="text-center">{{__('customlang.product')}}</th>
                <th class="text-center">{{__('customlang.price')}}</th>
                <th class="text-center">{{__('customlang.quantity')}}</th>
                <th class="text-center">{{__('customlang.total')}}</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPrice = 0;
            @endphp
            @foreach ($order->orderItems as $orderItem)
            <tr>
            <td class="text-center" width="10%">{{$orderItem->id}}</td>
            <td class="text-center">
                {{$orderItem->product->name}}
                @if ($orderItem->productColor)
                    @if ($orderItem->productColor->color)
                    <span>- {{__('customlang.color')}}: {{ $orderItem->productColor->color->name }}</span>
                    @endif
                @endif
            </td>
            <td class="text-center" width="10%">{{$appSetting->currency}} {{$orderItem->price}}</td>
            <td class="text-center" width="10%">{{$orderItem->quantity}}</td>
            <td class="text-center" width="15%" class="fw-bold">{{$appSetting->currency}} {{$orderItem->quantity * $orderItem->price}}</td>
            @php
            $totalPrice += $orderItem->quantity * $orderItem->price;
            @endphp
            </tr>
            @endforeach
            <tr>
            <td colspan="4" class="total-heading text-center">{{__('customlang.totalAmount')}} - <small>Inc. all vat/tax</small> :</td>
            <td colspan="1" class="total-heading text-center">{{$appSetting->currency}} {{$totalPrice}}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        {{__('customlang.thankYouForShoppingWith')}} {{$appSetting->website_name}}
    </p>

</body>
</html>
