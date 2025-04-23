<!DOCTYPE html>
<html>
  <head>
    {{--css--}}
    @include('admin.css')

    <style type="text/css">
        .div_deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
        }
        input[type="text"]
        {
            width: 400px;
            height: 70px;
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

            <div>
                <h1>Update Category<h1>
                <div class="div_deg">
                    <form action="{{url('admin/category/update_category', $data->id)}}" method="post">
                        @csrf
                        <input type="text" name="category" value="{{$data->category_name}}">
                        <input class="btn btn-primary" type="submit" value="Update category">
                    </form>
                </div>
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