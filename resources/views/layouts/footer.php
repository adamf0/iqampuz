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


</body>

</html>