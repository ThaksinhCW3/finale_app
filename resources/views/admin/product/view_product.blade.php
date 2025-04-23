<!DOCTYPE html>
<html>
  <head>
    {{--css--}}
    @include('admin.css')
  </head>

  <style type="text/css">
    .div_deg
    {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 60px;

    }
    .table_deg
    {
        border: 3px solid green;
    }
    th
    {
        background: skyblue;
        color: white;
        font-size: 19px;
        font-weight: bold;
        padding: 15px;
    }
    td
    {
        border: 1px solid skyblue;
        text-align: center;
    }
    </style>
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

            <div class="div_deg">
                <table class="table_deg">
                    <tr>
                        <th>Product title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    @foreach ($product as $products)
                    <tr>
                        <td>{{$products->title}}</td>
                        <td>{!!Str::limit($products->description, 50)!!}</td>
                        <td>{{$products->category}}</td>
                        <td>{{$products->price}}</td>
                        <td>{{$products->quantity}}</td>
                        <td>
                            <img height="120" width="120" 
                            src="{{ asset('products/' . $products->image) }}">
                        </td>

                        <td>
                            <a class="btn btn-success"
                            href="{{url('update_product',$products->id)}}">Edit</a>
                        </td>

                        <td>
                            <a class="btn btn-danger" onclick="confirmation(event)"
                            href="{{url('delete_product',$products->id)}}">Delete</a>
                        </td>

                    </tr>
                    @endforeach ()
                </table>
            </div>
            <div class="div_deg">
                {{$product->onEachSide(1)->links()}}
            </div>

          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        function confirmation(ev)
        {
            ev.preventDefault();

            var urlToRedirect = ev.currentTarget.getAttribute('href');

            console.log(urlToRedirect);

            swal({
                title:"Are you sure to delete this?",
                text: "This delete will be permanent",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willCancel) => {
                if (willCancel) {
                    window.location.href = urlToRedirect;
                }
            });
        }
    </script>
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