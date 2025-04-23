<!DOCTYPE html>
<html>
  <head>
    {{--css--}}
    @include('admin.css')

    <style>
        .div_deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        label
        {
            display: inline-block;
            width: 200px;
            padding: 20px;
        }
        input[type="text"]
        {
            width: 300px;
            height: 60px;
        }
        textarea{
            width: 400px;
            height: 100px;
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

        <h2>Update Product</h2>
           <div class="div_deg">
            <form action="{{url('admin/product/update_product',$data->id)}}" method="post" 
                enctype="multipart/form-data">
                @csrf
                <div>
                    <label>Title</label>
                    <input type="text" name="title" value="{{ $data->title }}">
                </div>
                <div>
                    <label>Description</label>
                    <input type="text" name="description" value="{{ $data->description }}">
                </div>
                <div>
                    <label>Price</label>
                    <input type="text" name="price" value="{{ $data->price }}">
                </div>
                <div>
                    <label>Quantity</label>
                    <input type="number" name="quantity" value="{{ $data->quantity }}">
                </div>
                <div>
                    <label>Category</label>
                    <select name="category">
                        <option value="{{$data->category}}">{{$data->category}}</option>
                   
                        @foreach ($categories as $category)
                            @if($category->category_name != $data->category)
                                <option value="{{$category->category_name}}">
                                    {{$category->category_name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Current Image</label>
                    <img height="120" width="120"
                         src="{{ asset('products/' . $data->image) }}">
                </div>
                <div>
                    <label>New image</label>
                    <input type="file" name="image">
                </div>
                <div>
                    <input class="btn btn-success" type="submit" name="update"
                           value="Update product">
                </div>
            </form>
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