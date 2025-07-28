  <header class="header">
       
        <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="{{ asset('front') }}/images/logo1.png" class="img-fluid" alt="logo" />
     
            </a>
            <div class="menu-bar-in d-lg-none d-block">
       
                <div class="menu-toggle1" id="menu-toggle1"><i class="fa fa-bars"></i></div>
            </div>


            <div class="menu-bar-in" id="tag1">
                <div class="mobile-menu-logo d-lg-none d-block">
                     <a class="navbar-brand" href="{{url('/')}}">
                <img src="{{ asset('front') }}/images/logo1.png" class="img-fluid" alt="logo" />
     
            </a>
                    <span id="close-menu"><i class="fa fa-times" id="close-menu1"></i></span>
                </div>
                <ul class="main-menu-list-in navbar-nav menu-navbar-nav">
                    <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}"><span>Home</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/about-us')}}"><span>About</span></a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/properties')}}"><span>Rental Villas</span></a>
                        </li>
                   
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/attractions')}}"><span>Attractions</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('property-management')}}"><span>Property Management</span></a>
                        </li>
                        <li class="nav-item d-none">
                            <a class="nav-link" href="{{ url('car-rentals') }}"><span>Car Rental</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/blogs')}}"><span>Blogs</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/contact-us')}}"><span>Contact</span></a>
                        </li>
                </ul>
            </div>
      
        </div>
    </nav>
    </header>



