<?php 
    use App\Http\COntrollers\ProductController;
    $total=0;
    if(Session::has('userinfo'))
    {
      $total=ProductController::cartItem();
    }
?>
<div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Ecomm</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item active">
                <a class="nav-link" href="myorder">Order</a>
                </li>
            </ul>
            <form action="search" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <ul class="nav navbar-nav navbar-right ">
                <li class="nav-item active">
                    <a class="nav-link" href="cartlist">cart({{$total}})</a>
                </li>
                @if(Session::has('userinfo'))
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"> {{Session::get('userinfo')['name']}}
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/logout">Logout</a></li>
            </ul>
          </li>
          @else
          <li><a href="/login">Login</a></li>
          <li><a href="/register">Register</a></li>

          @endif
                </ul>
        </div>
</nav>
</div>