<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manajemen Iqampuz</title>

        <link rel="stylesheet" href="{{ URL::to('gillandgroup-css-main/css/index.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script src="{{ asset('js/jquery.redirect.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </head>
    <body class="bg-light">
        <!-- Side Menu -->
        <div id="mySidebar" class="sidenav bg-white">
            <div onclick="openNav()" class="header" style="display: flex;"> <span class="material-icons">list</span><span class="ml-2">&nbsp;Menu</span></div>
            <div class="dropdown-btn" style="display: flex;"><i class="material-icons">date_range</i><span class="ml-2">&nbsp;Master</span><i style="margin-left:auto;" class="material-icons">expand_more</i></div>
            <div class="dropdown-container">
                <a class="sub-btn" style="display: flex;" href="{{ route('masterKampus.index') }}"><i class="material-icons">account_circle</i><span class="ml-2">&nbsp;Kampus</span></a>
                <a class="sub-btn" style="display: flex;" href="{{ route('panel.index') }}"><i class="material-icons">account_circle</i><span class="ml-2">&nbsp;Panel</span></a>
                <a class="sub-btn" style="display: flex;" href="{{ route('panel_menu.index') }}"><i class="material-icons">account_circle</i><span class="ml-2">&nbsp;Panel Menu</span></a>
                <a class="sub-btn" style="display: flex;" href="{{ route('menu.index') }}"><i class="material-icons">account_circle</i><span class="ml-2">&nbsp;Menu</span></a>
                <a class="sub-btn" style="display: flex;" href="{{ route('ManajemenUser.index') }}"><i class="material-icons">account_circle</i><span class="ml-2">&nbsp;Management User</span></a>
            </div>
        </div>
        <div id="main" class="main-layout">
            <!-- navbar -->
            <nav class="navbar-primary text-white">
                <div class="container">
                    <h1 class="site-title">
                        Management Iqampuz
                    </h1>
                    <ul class="display-flex gap-2">
                        <li>
                            <a href=">" class="text-light text-hover-white fw-bold display-flex"><span class="material-icons mr-1">logout</span>Logout</a>
                        </li>

                    </ul>
                </div>
            </nav>

            <div class="container">
                @yield('content')
            </div>
        </div>
    </body>
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
</html>