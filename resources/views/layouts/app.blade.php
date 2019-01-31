<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <style>
    body {
      font-family: "Lato", sans-serif;
    }

    /* Fixed sidenav, full height */
    .sidenav {
      height: 100%;
      width: 200px;
      position: fixed;
      z-index: 1;
      top: 50px;
      left: 0;
      background-color: #111;
      overflow-x: hidden;
      padding-top: 20px;
    }

    /* Style the sidenav links and the dropdown button */
    .sidenav a, .dropdown-btn {
      padding: 6px 8px 6px 16px;
      text-decoration: none;
      font-size: 20px;
      color: #818181;
      display: block;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
      cursor: pointer;
      outline: none;
      font-size: 15px;

    }

    /* On mouse-over */
    .sidenav a:hover, .dropdown-btn:hover {
      color: #f1f1f1;
    }

    /* Main content */
    .main {
      margin-left: 200px; /* Same as the width of the sidenav */
      margin-top: 52px; /* Same as the width of the sidenav */
      font-size: 20px; /* Increased text to enable scrolling */
      padding: 0px 10px;

    }
    .login
    {
      margin-top: 15%;
    }
    /* Add an active class to the active dropdown button */
    .active {
      background-color: #d50000;
      color: white;
    }

    /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
    .dropdown-container {
      display: none;
      background-color: #262626;
      padding-left: 8px;
    }

    /* Optional: Style the caret down icon */
    .fa-caret-down {
      float: right;
      padding-right: 8px;
    }

    /* Some media queries for responsiveness */
    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
      .sidenav a {font-size: 18px;}
    }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @if (!Auth::guest())
        <div class="sidenav">

          <button class="dropdown-btn">Expenses   <i class="fa fa-caret-left" style="padding-top:7px ; float:right"></i></button>
          <div class="dropdown-container">
            <p> <router-link :to="{ name: '' }">Direct Expense</router-link></p>
            <p> <router-link :to="{ name: 'indirect' }">Indirect Expense</router-link></p>
            <p> <router-link :to="{ name: '' }">View Expenses</router-link></p>
          </div>


          <button class="dropdown-btn">Inventory   <i class="fa fa-caret-left" style="padding-top:7px ; float:right"></i></button>
          <div class="dropdown-container">
            <p> <router-link :to="{ name: '' }">Distributor</router-link></p>
            <p> <router-link :to="{ name: '' }">Parts</router-link></p>
            <p> <router-link :to="{ name: '' }">Purchase</router-link></p>
            <p> <router-link :to="{ name: '' }">View</router-link></p>
            <p> <router-link :to="{ name: '' }">Replace/Refund</router-link></p>
            <p> <router-link :to="{ name: '' }">Purchase Order</router-link></p>
          </div>
          <a href="#about"></i>Attendance</a>
          <a href="#services">Payroll</a>
          <a href="#clients">Reminder</a>
          <a href="#contact">Balance Sheet</a>
          <a href="#contact">Account Statement</a>
        </div>

        <div class="main">

           <router-view></router-view>
        </div>
        @else
        <div class="login">
          @yield('content')
        </div>
        @endif
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  $(this).find("i").removeClass("fa-caret-down").addClass("fa-caret-left");

  } else {
  dropdownContent.style.display = "block";
    $(this).find("i").removeClass("fa-caret-left").addClass("fa-caret-down");
  }
  });
}

// $("p").click(function(){
// $(".dropdown-container").slideUp("fast");
// });

</script>
</body>
</html>
