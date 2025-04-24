<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
    <!-- slider section -->
    @include('home.slider')
    <!-- end slider section -->
  </div>
  <!-- end hero area -->

  <!-- shop section -->

  <!-- end shop section -->
    @include('home.product.product')
  <!-- contact section -->
  
  <br><br><br>

  <!-- end contact section -->
    @include('home.contact')

  <!-- info & footer section -->
    @include('home.footer')
</body>

</html>