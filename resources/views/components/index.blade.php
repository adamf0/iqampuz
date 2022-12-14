<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Iqampuz</title>
    <link rel="stylesheet" href="{{ URL::to('gillandgroup-css-main/css/index.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    {{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
</head>

<body>

    <body class="bg-light">

        <!-- Side Menu -->
        <div id="mySidebar" class="sidenav bg-white">

            <div onclick="openNav()" class="header" style="display: flex;"> <span
                    class="material-icons">list</span><span class="ml-2">&nbsp;Menu</span></div>
            <div class="dropdown-btn" style="display: flex;"><i class="material-icons">date_range</i><span
                    class="ml-2">&nbsp;Master</span><i style="margin-left:auto;"
                    class="material-icons">expand_more</i></div>
            <div class="dropdown-container">
                <a class="sub-btn" style="display: flex;" href="{{ route('masterKampus.index') }}"><i
                        class="material-icons">account_circle</i><span class="ml-2">&nbsp;Kampus</span></a>
                <a class="sub-btn" style="display: flex;" href="{{ route('panel.index') }}"><i
                        class="material-icons">account_circle</i><span class="ml-2">&nbsp;Panel</span></a>
                <a class="sub-btn" style="display: flex;" href="{{ route('panel_menu.index') }}"><i
                        class="material-icons">account_circle</i><span class="ml-2">&nbsp;Panel Menu</span></a>
                <a class="sub-btn" style="display: flex;" href="{{ route('menu.index') }}"><i
                        class="material-icons">account_circle</i><span class="ml-2">&nbsp;Menu</span></a>
                <a class="sub-btn" style="display: flex;" href="{{ route('ManajemenUser.index') }}"><i
                        class="material-icons">account_circle</i><span class="ml-2">&nbsp;Management User</span></a>

            </div>




            <!--
        <div class="dropdown-btn" style="display: flex;"><i class="material-icons">date_range</i><span class="ml-2">&nbsp;History</span><i style="margin-left:auto;" class="material-icons">expand_more</i></div>
        <div class="dropdown-container">
            <a class="sub-btn" style="display: flex;" href=""><i class="material-icons">account_circle</i><span class="ml-2">&nbsp;Dosen</span></a>
            <a class="sub-btn" style="display: flex;" href=""><i class="material-icons">supervised_user_circle</i><span class="ml-2">&nbsp;Mahasiswa</span></a>
            <a class="sub-btn" style="display: flex;" href=""><i class="material-icons">badge</i><span class="ml-2">&nbsp;Staff</span></a>
        </div>
        <div class="dropdown-btn" style="display: flex;"><i class="material-icons">schedule</i><span class="ml-2">&nbsp;Jadwal</span><i style="margin-left:auto;" class="material-icons">expand_more</i></div>
        <div class="dropdown-container">
            <a class="sub-btn" style="display: flex;" href=""><i class="material-icons">account_circle</i><span class="ml-2">&nbsp;Mata Kuliah</span></a>
            <a class="sub-btn" style="display: flex;" href=""><i class="material-icons">supervised_user_circle</i><span class="ml-2">&nbsp;Mahasiswa</span></a>
        </div> -->
        </div>

        <!-- Body Content -->
        <div id="main" class="main-layout">

            <!-- navbar -->
            <nav class="navbar-primary text-white">
                <div class="container">
                    <h1 class="site-title">
                        Management Iqampuz
                    </h1>
                    <ul class="display-flex gap-2">
                        <li>
                            <a href=">" class="text-light text-hover-white fw-bold display-flex"><span
                                    class="material-icons mr-1">logout</span>Logout</a>
                        </li>

                    </ul>
                </div>
            </nav>

            <div class="container">
                @yield('content')
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
            </script>
    </body>

    <!-- dropdown menu script -->
    <script>
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>


    <!-- sidenav -->
    <script>
        function openNav() {
            if (document.getElementById("mySidebar").style.width == "250px") {
                document.getElementById("mySidebar").style.width = "72px";
            } else {
                document.getElementById("mySidebar").style.width = "250px";
            }
            if (document.getElementById("main").style.marginLeft == "250px") {
                document.getElementById("main").style.marginLeft = "72px"
            } else {
                document.getElementById("main").style.marginLeft = "250px"
            }
            if (document.getElementById("btn-main").style.marginLeft == "auto") {
                document.getElementById("btn-main").style.marginLeft = "0"
            } else {
                document.getElementById("btn-main").style.marginLeft = "auto"
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>


</body>

</html>

</html>
