<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
</head>
<body>
    <p>{{$order->first_name .' '. $order->last_name}}</p>
    <p>Your Order has been successfully placed.</p>

    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantiry</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td><img src="{{asset("assets/images/products/$item->image")}}" width='100' alt=""></td>
                    <td>{{$item->product->name}}</td>
                    <td>{{$item->quantiry}}</td>
                    <td>&dollar;{{$item->price * $item->quantiry}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"></td>
                <td style="f">Subtotal : &dollar;{{$order->subtotal}}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td>Tax : &dollar;{{$order->tax}}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td>Shipping : Free Shipping</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td>Total : &dollar;{{$order->total}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
