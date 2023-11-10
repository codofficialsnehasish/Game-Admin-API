<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <!-- <li class="menu-title">Main</li> -->
                <li>
                    <a href="{{url('/dashboard')}}" class="waves-effect">
                        <i class="ti-home"></i>
                        <!-- <span class="badge rounded-pill bg-primary float-end">2</span> -->
                        <span>Dashboard</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="{{url('/register')}}" class=" waves-effect">
                        <i class="ti-calendar"></i>
                        <span>Add User</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/showuser')}}" class=" waves-effect">
                        <i class="ti-calendar"></i>
                        <span>Show User</span>
                    </a>
                </li> -->

                <!-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-user"></i>
                        <span>Users</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('/register')}}">Add User</a></li>
                        <li><a href="{{url('/showuser')}}">Show User</a></li>
                    </ul>
                </li> -->
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-user"></i>
                        <span>Customer</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('/customer')}}">Add New Customer</a></li>
                        <li><a href="{{url('/showcustomer')}}">All Customers</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ion ion-logo-game-controller-b"></i>
                        <span>Game</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('/show_catagory')}}">Catagory</a></li>
                        <!-- <li><a href="{{url('/show_sub_catagory')}}">Timings</a></li> -->
                        <!-- <li><a href="{{url('/show_sub_catagory')}}">Sub Catagory</a></li> -->
                        <li><a href="{{url('/show_game')}}">All Games</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-human-scooter"></i>
                        <span>Game Result</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('/add_result')}}">Add Result</a></li>
                        <li><a href="{{url('/show_result')}}">All Resultes</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="far fa-file-image"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('/slideradd')}}">Add Slider</a></li>
                        <li><a href="{{url('/slider')}}">All Slider</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-wallet-plus"></i>
                        <span>Wallet</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('/add_money')}}">Add Money</a></li>
                        <li><a href="{{url('/show_wallet')}}">All Wallet</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{url('/show_requests')}}" class="waves-effect">
                        <i class="mdi mdi-frequently-asked-questions"></i>
                        @if(\App\Models\Requestt::all()->count()!=0)<span class="badge rounded-pill bg-danger float-end">{{ \App\Models\Requestt::all()->count() }}</span>@endif
                        <span>Requests</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>