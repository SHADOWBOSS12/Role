<x-Header></x-Header>


<x-SideBar></x-SideBar>



    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
     <x-TopBar></x-TopBar>

        <!-- MAIN CONTENT-->
        <div class="main-content">

            @yield('content')

        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>


<x-Footer></x-Footer>

