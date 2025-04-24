<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('home.css')

    <style>
        .div_center
        {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
        }
        table
        {
            border: 2px solid black;
            text-align: center;
            width: 800px;
        }
        th
        {
            border: 2px solid skyblue;
            background-color: black;
            color: white;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }
        td
        {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>
<body>
        <div class="hero_area">
          <!-- header section strats -->
          @include('home.header')

            <div class="div_center">
                <table>
                    <tr>
                        <th>Product name</th>
                        <th>Price</th>
                        <th>Delivery status</th>
                        <th>Image</th>
                    </tr>

                @foreach ($order as $order)
                    <tr>
                        <td>{{$order->product->title}}</td>
                        <td>{{$order->product->price}}</td>
                        <td>{{$order->status}}</td>
                        <td>
                            <img width="150px"
                             src="{{asset('products/' . $order->product->image) }}">
                        </td>
                    </tr>
                @endforeach

                </table>
            </div>


        </div>

    
        @include('home.footer')
</body>
</html>