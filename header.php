<?php
include 'config/connect.php';
include 'config/funtion.php';
//include 'auth.php';
// session_start();
//   session_destroy();
ob_start();
// print_r($_SESSION);
?>
<?php
//$slider =  execute("SELECT * FROM  image WHERE type = 0 and status = 0 ORDER BY ordering limit 0,5")->fetch_all(MYSQLI_ASSOC);
$banner =  execute("SELECT * FROM  image WHERE type = 1 and status = 0 ORDER BY ordering")->fetch_all(MYSQLI_ASSOC);
$payment =  execute("SELECT * FROM  image WHERE type = 3 and status = 0 ORDER BY ordering DESC limit 0,5")->fetch_all(MYSQLI_ASSOC);
?>


<!doctype html>
<html class="no-js" lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />


<style>
    a:hover {
        text-decoration: none !important;
    }

    .main-menu-area {
        background: white !important;
        color: black !important;
    }
</style>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>BookStore</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="public/img/favicon.png">

    <!-- all css here -->
    <!-- bootstrap v3.3.6 css -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">

    <!-- meanmenu css -->
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="public/css/owl.carousel.css">
    <!-- font-awesome css -->
    <!-- <link rel="stylesheet" href="public/css/font-awesome1.min.css"> -->
    <link rel="stylesheet" href="public/css/font-awesome.min.css">
    <!-- flexslider.css-->
    <!-- style css -->
    <link rel="stylesheet" href="public/style.css">
    <link href="admin/public/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="admin/public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<?php if (isset($_POST['logout'])) { ?>
    unset($_SESSION['customer']);
<?php } ?>

<body class="home-4">
    <!--[if lt IE 8]>
                <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->

    <!-- Add your site or application content here -->
    <!-- header-area-start -->
    <header>
        <!-- header-top-area-start -->

        <!-- header-top-area-end -->
        <!-- header-mid-area-start -->
        <div class="header-mid-area ptb-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-5 col-sm-6 col-xs-6">
                        <div class="logo-area">
                            <a href="index.php" class="logo-icon"><img src="public/img/logo/imglogo.jpg" alt="logo" style=" margin-bottom: 10px;" /></a>
                            <a href="index.php" class="logo-text"><img src="public/img/logo/textlogo.jpg" alt="logo" style=" margin-bottom: 10px;" /></a>
                        </div>
                    </div>
                    <!--    <div class=" hidden-lg hidden-md col-sm-5 col-xs-5 mobile-icon">
                        <div>
                               <a href="#" title="cart" class="mobile-cart">
                                <span><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
                            </a>
                            <a href="#" id="mobile-toggle">
                                <i class="fa fa-bars"></i>
                            </a>
                        </div>
                    </div>-->
                    <div class="col-lg-4 hidden-md hidden-sm hidden-xs">

                    </div>

                    <div class="col-lg-5 col-sm-6 col-xs-6">

                        <aside class="top-info">
                            <div class="my-cart" id="cart-top">
                                <ul>
                                    <li><a href="cart.php" class="cart-link" id="cart"><i class="fa fa-shopping-cart"></i></a>
                                        <span><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>


                                        <div class="mini-cart-sub">
                                            <div class="cart-product">
                                                <?php if (isset($_SESSION['cart'])) { ?>
                                                    <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                                                        <div class="single-cart">
                                                            <div class="cart-img">
                                                                <a href="#"><img src="admin/public/image/product/<?php echo $value['image'] ?>" alt="book" /></a>
                                                            </div>
                                                            <div class="cart-info">
                                                                <h5><a href="#"><?php echo $value['name'] ?></a></h5>
                                                                <p><?php echo $value['quantity'] ?> x <span class="price"><?php echo $value['price'] ?></span></p>
                                                            </div>
                                                            <div class="cart-icon">
                                                                <a href="xuli-cart.php?action=remove&id=<?php echo $value['id']; ?>"><i class="fa fa-remove"></i></a>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <div class="cart-totals">
                                                <h5>Total <span class="price"><?php echo isset($_SESSION['total_cart']) ? $_SESSION['total_cart'] : 0 ?></span></h5>
                                            </div>
                                            <div class="cart-bottom">
                                                <a class="view-cart" href="cart.php">Xem giỏ hàng</a>
                                                <a href="checkout.php">Thanh toán</a>
                                            </div>
                                        </div>


                                    </li>
                                </ul>
                            </div>
                            <div class="navholder">
                                <div class="account-area hidden-md hidden-sm hidden-xs">
                                    <!-- text-right -->
                                    <nav class="subnav">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                </a>
                                                085 8941 658
                                            </li>
                                            <!--Lấy cookie để hiển thị thông tin user-->

                                            <li>
                                                <?php
                                                if (isset($_SESSION['customer']) && isset($_SESSION['customer']['type']) == 1) {
                                                ?>
                                                    <a href="auth_edituser.php"><i class="fa fa-user" style="font-size: 25px"></i> Tài Khoản</a>
                                                    <a href="admin/login.php" target="_blank"><i class="fa fa-user-secret" style="font-size: 25px"></i> Admin</a>
                                                <?php } else if (isset($_SESSION['customer']) && isset($_SESSION['customer']['type']) == 0) { ?>
                                                    <a href="auth_edituser.php"><i class="fa fa-user" style="font-size: 25px;color: #444444"></i> Tài Khoản
                                                        <?php
                                                        if (isset($_SESSION['customer'])) {
                                                            echo $_SESSION['customer']['name'];
                                                        ?>
                                                        <?php } ?>

                                            </li>
                                        <?php } else {
                                                    echo ""; ?>
                                            </p>
                                            </li>
                                            <!--Lấy cookie để hiển thị thông tin user-->
                                            <li>
                                                <a class="btn btn-primary" style="color:white; border-radius: 10px; font-size:18px; margin-left: 7px" href="login.php" role="button">Đăng nhập</a>
                                                <a class="btn btn-primary" style="color:white; border-radius: 10px; font-size:18px; margin-left: 7px" href="register.php" role="button">Đăng Ký</a>

                                                <!-- Small modal -->

                                            </li>

                                        <?php } ?>
                                        </ul>
                                    </nav>
                                    <div class="header-line">
                                        <p>Free Ship Cho Đơn Hàng Trên 300K</p>
                                    </div>
                                </div>

                            </div>
                        </aside>
                    </div>



                </div>
            </div>
        </div>
        <!-- header-mid-area-end -->
        <!-- main-menu-area-start -->
        <div class="main-menu-area  fs14-pd10-0" id="header-sticky">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="menu-area" id="top-nav">
                            <nav>
                                <ul>
                                    <li><a href="javascript:void(0);" class="icon" onclick="myFunction()">
                                            <i class="fa fa-bars"></i>
                                        </a></li>
                                    <li class="active"><a href="index.php" style="color: white !important;">Trang chủ</a></li>
                                    <li><a href="category.php">Danh mục<i class="fa fa-angle-down"></i></a>
                                        <div class="mega-menu">
                                            <?php
                                            $category = execute("SELECT * FROM category WHERE parent_id = 0");
                                            foreach ($category as $key => $value) {
                                                $parent = $value['id'];
                                                $sub = execute("SELECT * FROM category WHERE parent_id = $parent");
                                            ?>
                                                <span>
                                                    <a href="category.php?cate_id=<?php echo $value['id']; ?>" class="title"><?php echo $value['name']; ?></a>
                                                    <?php foreach ($sub as $k => $val) { ?>
                                                        <a href="category.php?cate_id=<?php echo $val['id']; ?>"><?php echo $val['name']; ?></a>
                                                    <?php } ?>
                                                </span>
                                            <?php } ?>
                                        </div>
                                    </li>
                                    <li><a href="404.php">Tin tức</a></li>
                                    <li><a href="contact.php">Liên hệ</a></li>
                                    <li><a href="about.php">About Us</a></li>
                                </ul>
                            </nav>


                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="header-search">
                            <form action="category.php" id="search_form">
                                <input type="text" placeholder="Nhập từ khóa tìm kiếm. . ." name="search" />
                                <a href="javascript:{}" onclick="document.getElementById('search_form').submit();"><i class="fa fa-search"></i><input type="hidden"></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script type="text/javascript">
            $(document).ready(function() {
                $("#sidebar").mCustomScrollbar({
                    theme: "minimal"
                });

                $('#dismiss, .overlay').on('click', function() {
                    // hide sidebar
                    $('#sidebar').removeClass('active');
                    // hide overlay
                    $('.overlay').removeClass('active');
                });

                $('#sidebarCollapse').on('click', function() {
                    // open sidebar
                    $('#sidebar').addClass('active');
                    // fade in the overlay
                    $('.overlay').addClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });
        </script>
        <script>
            function myFunction() {
                var x = document.getElementById("top-nav");
                if (x.className === "menu-area") {
                    x.className += " responsive";
                } else {
                    x.className = "menu-area";
                }
            }
        </script>
        <script>
            $(function() {
                $('nav#menu-mobile').mmenu();
            });
            $(document).ready(function() {
                flagg = true;
                if (flagg) {
                    $('.click-menu-mobile a').click(function() {
                        $('#menu-mobile').removeClass('hidden');
                        flagg = false;
                    })
                }
            });
        </script>
        <script>
            $(document).on("click", ".mobile-menu-icon .dropdown-menu ,.drop-control .dropdown-menu, .drop-control .input-dropdown", function(e) {
                e.stopPropagation();
            });
        </script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        </head>
        <!-- main-menu-area-end -->
    </header>