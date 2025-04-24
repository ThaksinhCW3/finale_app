<!DOCTYPE html>
<html>
  <head>
    {{--css--}}
    @include('admin.css')

    <style type="text/css">
        table{
            border: 1px solid skyblue;
            text-align: center;
        }
        th
        {
            background: lightblue;
            padding: 10px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }
        td
        {
            color: white;
            padding: 10px;
            border: 1px solid skyblue;
        }
        .table_center
        {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
  </head>
  <body>
    {{-- header section --}}
    @include('admin.header')
    {{-- end of #header section --}}

    {{-- sidebar section --}}
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->

      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

        <h1>Orders</h1>
            <div class="table_center">
                <table>
                <tr>
                    <th>Customer name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Product Title</th>
                    <th>Price</th>
                    <th>image</th>
                    <th>status</th>
                    <th>Change Status</th>
                    <th>Print</th>
                </tr>

            @foreach ($data as $data)
                <tr>
                    <td>{{$data->name}}</td>
                    <td>{{$data->rec_address}}</td>
                    <td>{{$data->phone}}</td>
                    <td>{{$data->product->title}}</td>
                    <td>{{$data->product->price}}</td>
                    <td>
                        <img height="120" width="120"
                         src="{{ asset('products/' . $data->product->image) }}">
                    </td>

                    <td>
                        @if ($data->status == "in progress")
                        <span style="color:red">{{$data->status}}</span>
                        @elseif ($data->status == "On the way")
                        <span style="color:yellow">{{$data->status}}</span>
                        @else
                        <span style="color:greenyellow">{{$data->status}}</span>
                        @endif
                        
                    </td>

                    <td>
                        <a class="btn btn-primary" 
                        href="{{url('admin/order/on_the_way_order', $data->id)}}">
                            On the way
                        </a>
                        <a class="btn btn-success" 
                        href="{{url('admin/order/delivered_order', $data->id)}}">
                            Delivery
                        </a>
                    </td>

                    <td> 
                        <a class="btn btn-secondary" href="
                        {{url('admin/order/print_pdf',$data->id)}}">Print PDF</a>
                    </td>

                </tr>
            @endforeach    
                </table>
            </div>
          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>
  </body>
</html>