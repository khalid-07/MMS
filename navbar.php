<?php
//session_start();
?>
<html>


    <head>

        <style>
            .mycheck {
                background-color: #0a3c59;
                border: 0;
                border-radius: 0;
            }

            .mycheck .menu-navbar li a {
                color: white;
            }

            .mycheck .menu-navbar .dropdown-menu li a {
                background-color: white;
                color: #00386c;
            }

            .mycheck .menu-navbar .dropdown-menu li a:hover {
                background-color: lightgrey;
                color: #00386c;
            }

            .mycheck .menu-navbar li a:hover {
                background-color: #e8cb17;
                color: #0a3c59;
            }

            /* .mycheck .menu-navbar .collaping {
            background-color: wheat;
        } */
        </style>
    </head>

    <body>


        <nav class="mycheck navbar sticky-top navbar-expand-lg mb-100">
            <div class="container menu-navbar">
                <a class="navbar-brand text-white" href="home.php">
                    <img src="img/logo.png" height="30px" width="100px" />
                </a>
                <button type="button" class="navbar-toggler navbar-dark" data-bs-toggle="collapse"
                    aria-controls="navbarSupportedContent" data-bs-target="#navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        
                        <?php
                        if (isset($_SESSION["username"]) && $_SESSION["role"]!="admin") {
                        ?>
                        <li class="nav-item"><a class="nav-link" href="dashboard.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="homepage.php">Minutes</a></li>
                        <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="groups.php">Groups</a></li>
                        <?php }
                        else if(isset($_SESSION["username"]) && $_SESSION["role"]=="admin"){
                            ?>
                            <li class="nav-item"><a class="nav-link" href="dashboard.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="homepage.php">Minutes</a></li>
                        <li class="nav-item"><a class="nav-link" href="users.php">Users</a></li>
                        <li class="nav-item"><a class="nav-link" href="groups.php">Groups</a></li>
                        <li class="nav-item"><a class="nav-link" href="logs.php">Logs</a></li>
                        <?php 

                        }

                        else{

                        }
                        ?>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>

                    </ul>
                    <ul class="navbar-nav me-2">
                        <?php
                        if (!isset($_SESSION["username"])) {
                            echo "<li class=\"nav-item\"><a href=\"signup.php\" class=\"nav-link\"><span class=\"glyphicon glyphicon-user\"></span>Sign Up</a></li>";
                            echo "<li class=\"nav-item\"><a href=\"signin.php\" class=\"nav-link\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>";
                        } else {
                            echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"profile.php\">".$_SESSION["name"]."</a></li>";
                            echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"signout.php\">Logout</a></li>";
                        }
                        ?>

                    </ul>
                </div>
            </div>
            </div>
        </nav>
    </body>

</html>