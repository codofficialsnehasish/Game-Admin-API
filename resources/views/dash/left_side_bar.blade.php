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
                <li>
                    <a href="{{url('/content')}}" class="waves-effect">
                        <i class="ti-settings"></i>
                        <!-- <span class="badge rounded-pill bg-primary float-end">2</span> -->
                        <span>Settings</span>
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
                        <span class="badge rounded-pill bg-danger float-end" id="custo"></span>
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
                        <li><a href="{{url('/todays-result')}}">Todays Resultes</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{url('/content')}}" class=" waves-effect">
                        <i class="ti-calendar"></i>
                        <span>Single Catagory Data</span>
                    </a>
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
                        <li><a href="{{url('/add_money')}}">Credit Money (add)</a></li>
                        <li><a href="{{url('/cut_money')}}">Debit Money (cut)</a></li>
                        <li><a href="{{url('/show_wallet')}}">Wallet History</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{url('/show_on_game')}}" class="waves-effect">
                        <i class="mdi mdi-cards-playing-outline"></i>
                        <span>Play Details</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/show_requests')}}" class="waves-effect">
                        <i class="mdi mdi-frequently-asked-questions"></i>
                        <span class="badge rounded-pill bg-danger float-end" id="req"></span>
                        <span>Forgot Password Requests</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/show_notification')}}" class="waves-effect">
                        <i class="mdi mdi-frequently-asked-questions"></i>
                        <span class="badge rounded-pill bg-danger float-end" id="npot"></span>
                        <span>Notification</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/customer_history')}}" class="waves-effect">
                        <i class="mdi mdi-microsoft-onenote"></i>
                        <span>Customer History</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/kolkataff')}}" class="waves-effect">
                        <i class="ti-bookmark-alt"></i>
                        <span>KOLKATA FF</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/cmmmimbai')}}" class="waves-effect">
                        <i class="ti-bookmark-alt"></i>
                        <span>CMM Mumbai</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/charts')}}" class="waves-effect">
                        <i class="fas fa-chart-bar"></i>
                        <span>Rate Chart</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/how_to_play')}}" class="waves-effect">
                        <i class="fas fa-question-circle"></i>
                        <span>How to Play</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="{{url('/test')}}" class="waves-effect">
                        <i class="fas fa-question-circle"></i>
                        <span>* Test case *</span>
                    </a>
                </li> -->
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

<script>
    function notification(){
        $.ajax({
            url:'/get_noti',
            type:'GET',
            data:{},
            success:function(resp){
                // alert(resp);
                // console.log(resp);
                $("#custo").html(resp);
            }
        });
        $.ajax({
            url:'/get_req',
            type:'GET',
            data:{},
            success:function(resp){
                // alert(resp);
                // console.log(resp);
                $("#req").html(resp);
            }
        });
        $.ajax({
            url:'/notifi',
            type:'GET',
            data:{},
            success:function(resp){
                // alert(resp);
                // console.log(resp);
                $("#npot").html(resp);
            }
        });
    }
    setInterval(notification, 10000);
</script>