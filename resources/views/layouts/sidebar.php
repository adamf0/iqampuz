<body class="bg-light">

    <!-- Side Menu -->
    <div id="mySidebar" class="sidenav bg-white">

        <div onclick="openNav()" class="header" style="display: flex;"> <span class="material-icons">list</span><span class="ml-2">&nbsp;Menu</span></div>
        <div class="dropdown-btn" style="display: flex;"><i class="material-icons">date_range</i><span class="ml-2">&nbsp;Master</span><i style="margin-left:auto;" class="material-icons">expand_more</i></div>
        <div class="dropdown-container">
            <a class="sub-btn" style="display: flex;" href=""><i class="material-icons">account_circle</i><span class="ml-2">&nbsp;Kampus</span></a>
           
            <a class="sub-btn" style="display: flex;" href=""><i class="material-icons">account_circle</i><span class="ml-2">&nbsp;Kampus</span></a>
           
            <a class="sub-btn" style="display: flex;" href=""><i class="material-icons">account_circle</i><span class="ml-2">&nbsp;Kampus</span></a>
           
            <a class="sub-btn" style="display: flex;" href=""><i class="material-icons">account_circle</i><span class="ml-2">&nbsp;Kampus</span></a>
           
        </div>



        <!-- <div class="dropdown-btn" style="display: flex;"><i class="material-icons">date_range</i><span class="ml-2">&nbsp;History</span><i style="margin-left:auto;" class="material-icons">expand_more</i></div>
        <div class="dropdown-container">
            <a class="sub-btn" style="display: flex;" href="<?php echo base_url('history_dosen'); ?>"><i class="material-icons">account_circle</i><span class="ml-2">&nbsp;Dosen</span></a>
            <a class="sub-btn" style="display: flex;" href="<?php echo base_url('history_mahasiswa'); ?>"><i class="material-icons">supervised_user_circle</i><span class="ml-2">&nbsp;Mahasiswa</span></a>
            <a class="sub-btn" style="display: flex;" href="<?php echo base_url('history_staff'); ?>"><i class="material-icons">badge</i><span class="ml-2">&nbsp;Staff</span></a>
        </div>
        <div class="dropdown-btn" style="display: flex;"><i class="material-icons">schedule</i><span class="ml-2">&nbsp;Jadwal</span><i style="margin-left:auto;" class="material-icons">expand_more</i></div>
        <div class="dropdown-container">
            <a class="sub-btn" style="display: flex;" href="<?php echo base_url('Jadwal_Mk'); ?>"><i class="material-icons">account_circle</i><span class="ml-2">&nbsp;Mata Kuliah</span></a>
            <a class="sub-btn" style="display: flex;" href="<?php echo base_url('Dashboard/jadwal_mahasiswa'); ?>"><i class="material-icons">supervised_user_circle</i><span class="ml-2">&nbsp;Mahasiswa</span></a>
        </div> -->
    </div>

      <!-- Body Content -->
  <div id="main" class="main-layout">

<!-- navbar -->
<nav class="navbar-primary text-white">
    <div class="container">
        <h1 class="site-title">
            Management Iqampus
        </h1>
        <ul class="display-flex gap-2">
            <li>
                <a href="<?php echo base_url('Auth/logout')?>" class="text-light text-hover-white fw-bold display-flex"><span class="material-icons mr-1">logout</span>Logout</a>
            </li>

        </ul>
    </div>
</nav>
