<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/styleFile.css" type="text/css">
    <script src="jquery/jquery-3.6.1.min.js" type="text/javascript"></script>
    <script src="bootstrap5/js/bootstrap.min.js" type="text/javascript"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar scroll</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Link
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Link</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-xs-8">.col-6 .col-sm-4</div>
            <div class="col-lg-4 col-xs-2">.col-6 .col-sm-4</div>


            <!-- Force next columns to break to new line at md breakpoint and up -->
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col order-last">
                First in DOM, ordered last
            </div>
            <div class="col">
                Second in DOM, unordered
            </div>
            <div class="col order-first">
                Third in DOM, ordered first
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-6 col-sm-3 carda">1.col-6 .col-sm</div>
            <div class="col-6 col-sm-3 carda">2.col-6 .col-sm</div>

            <!-- Force next columns to break to new line -->
            <!-- <div class="w-100"></div> -->

            <div class="col-6 col-sm-3 carda">3.col-6 .col-sm</div>
            <div class="col-6 col-sm-3 carda">4.col-6 .col-sm</div>
        </div>
    </div>
</body>

</html>