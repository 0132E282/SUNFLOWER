<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $descriptionWeb['title'] ?? '' ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="public/assets/images/icons/favicon.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/assets/vendor-web/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/fonts/linearicons-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/assets/vendor-web/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/assets/vendor-web/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/assets/vendor-web/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/assets/vendor-web/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/assets/vendor-web/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/assets/vendor-web/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/assets/vendor-web/MagnificPopup/magnific-popup.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/assets/vendor-web/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/assets/css-web/util.css">
    <link rel="stylesheet" type="text/css" href="public/assets/css-web/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!--===============================================================================================-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
</head>

<body class="animsition" onload="handleLoadCart()">

    <!-- Header -->
    <?php View('components/header/header-default-web', $data) ?>

    <!-- Cart -->

    <?php View('components/cart', $data) ?>

    <?php View($content, $data) ?>



    <?php View('components/footer/footer-web', $data) ?>


    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>
    <?php View('components/modal/modal-detail-products', $data) ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!--===============================================================================================-->
    <script src="public/assets/vendor-web/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="public/assets/vendor-web/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="public/assets/vendor-web/bootstrap/js/popper.js"></script>
    <script src="public/assets/vendor-web/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="public/assets/vendor-web/select2/select2.min.js"></script>
    <script>
        $(".js-select2").each(function() {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <!--===============================================================================================-->
    <script src="public/assets/vendor-web/daterangepicker/moment.min.js"></script>
    <script src="public/assets/vendor-web/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="public/assets/vendor-web/slick/slick.min.js"></script>
    <script src="public/assets/js-web/slick-custom.js"></script>

    <!--===============================================================================================-->
    <script src="public/assets/vendor-web/parallax100/parallax100.js"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
    <!--===============================================================================================-->
    <script src="public/assets/vendor-web/MagnificPopup/jquery.magnific-popup.min.js"></script>
    <script>
        $('.gallery-lb').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>
    <!--===============================================================================================-->
    <script src="public/assets/vendor-web/isotope/isotope.pkgd.min.js"></script>
    <!--===============================================================================================-->
    <script src="public/assets/vendor-web/sweetalert/sweetalert.min.js"></script>
    <script>
        $('.js-addwish-b2').on('click', function(e) {
            e.preventDefault();
        });

        $('.js-addwish-b2').each(function() {
            var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-b2');
                $(this).off('click');
            });
        });

        $('.js-addwish-detail').each(function() {
            var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");
                $(this).addClass('js-addedwish-detail');
                $(this).off('click');
            });
        });

        /*---------------------------------------------*/

        $('.form-cart').each(function() {
            var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
            $(this).on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serializeArray(),
                    success: function(data) {
                        swal(nameProduct, "thêm thành công", "success");
                        handleLoadCart();
                    },
                    error: function(error) {
                        swal(nameProduct, JSON.parse(error.responseText).message, 'error');
                    }
                })
            });
        });
    </script>
    <!--===============================================================================================-->
    <script src="public/assets/vendor-web/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script>
        $('.js-pscroll').each(function() {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function() {
                ps.update();
            })
        });
    </script>
    <script>
        function handleLoadCart() {
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.querySelector('#cart').innerHTML = this.responseText;
                document.querySelector('.js-show-cart').setAttribute('data-notify', document.querySelectorAll('.header-cart-item').length);
            };
            xhttp.open('GET', 'http://localhost/php/SUNFLOWER/views/components/cartList.php');
            xhttp.send();
        }
    </script>
    <!--===============================================================================================-->
    <script src="public/assets/js-web/main.js"></script>
</body>

</html>