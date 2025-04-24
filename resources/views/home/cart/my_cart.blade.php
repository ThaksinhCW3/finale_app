<!DOCTYPE html>
<html>

<head>
    @include('home.css')

    <style type="text/css">
        .div_deg
        {
            display: flex;
            justify-content: center;
            align-content: center;
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
            border: 2px solid black;
            text-align: center;
            color: white;
            font: 20px;
            font-weight: bold;
            background-color: black;
        }
        td
        {
            border: 1px solid skyblue;
        }
        .cart_value
        {
            text-align: center;
            margin-bottom: 70px;
            padding: 18px;
        }
        label{
            display: inline-block;
            width:  150px;
        }
        .div_gap
        {
            padding: 20px;
        }
    </style>

</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
  </div>

    <div class="div_deg">
        <table>
            <tr>
            <th>Product Title</th>
            <th>Price</th>
            <th>Image</th>
            </tr>

            <?php
                $value = 0;
            ?>

            @foreach ($cart as $cart)
            
            <tr>
                <td>{{$cart->product->title}}</td>
                <td>{{$cart->product->price}}</td>
                <td>
                    <img width="150px"
                     src="{{asset('products/' . $cart->product->image) }}">
                </td>
            </tr>

            <?php
                $value = $value + $cart->product->price;
            ?>

            @endforeach

        </table>
    </div>

        <div class="cart_value">
            <h3>Total Value of Cart is : ${{$value}}</h3>
        </div>

        <div class="order_deg" style="display: flex; justify-content: center;
         align-items: center;">
            <form action="{{url('order/confirm_order')}}" method="post">
                @csrf
                <div class="div_gap">
                    <label>Receiver Name</label>
    
                    <input type="text" name="name" value="{{Auth::user()->name}}">
                </div>
    
                <div class="div_gap">
                    <label>Receiver Address</label>
    
                    <textarea name="address" value="{{Auth::user()->address}}"></textarea>
                </div>
    
                <div class="div_gap">
                    <label>Receiver Phone</label>
    
                    <input type="text" name="phone" value="{{Auth::user()->phone}}">
                </div>
    
                <div class="div_gap">
                    <input class="btn btn-primary" type="submit"
                     href="{{url('')}}" value="Cash on delivery">
                    <a class="btn btn-success"
                    href="{{url('stripe', $value)}}">Using Card
                    </a>
                </div>
            </form>
        </div>

  <!-- info & footer section -->
    @include('home.footer')
</body>

</html>