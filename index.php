<?php

// Error handling
ini_set('xdebug.var_display_max_depth', '10');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');
ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);

// Manage transactions and redirections
if(isset($_GET['token']) and !empty($_GET['token'])) {
    require_once ('checkout_3ds_payment.php');
} elseif(isset($_GET['sofort'])) {
    require_once('checkout_sofort.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <title>Checkout – coding test + bonus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="theme-color" content="#8c9e6e">
    <link rel="stylesheet" href="reset.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Header / logo -->
    <header>
        <h1>
            <div id="logo"></div>
            <p>QUALITY T-SHIRTS FOR UK & GERMANY</p>
        </h1>
    </header>

    <!-- Fake menu -->
    <nav>
        <a href="#">Products</a>
        <a href="#">Basket</a>
        <a href="#">Delivery</a>
        <a href="#" class="active">Payment</a>
        <a href="#">Confirmation</a>
    </nav>

    <main class="wrapper">

        <section>

            <div>

                <h3><strong>3X</strong>&nbsp;t-shirts</h3>

                <!-- Payment method selector -->
                <input type="radio" name="payment-method" id="card" onclick="paymentMethods('payment-form')" checked> <label for="card">Card</label>
                <input type="radio" name="payment-method" id="sofort" onclick="paymentMethods('sofort-block')"> <label for="sofort">Sofort</label>

                <!-- SOFORT -->
                <div id="sofort-block" class="paymentMethod">
                    <p class="center">
                        <button><a href="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http").'://'.$_SERVER["HTTP_HOST"].strtok($_SERVER["REQUEST_URI"],'?').'?sofort'; ?>">Redirect to Sofort</a></button>
                    </p>
                </div>

                <!-- BANK CARD -->
                <form id="payment-form" class="paymentMethod on" method="POST" action="https://merchant.com/charge-card">

                    <div>
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" required>
                    </div>

                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>

                    <p>Please enter your card details</p>

                    <div class="frame card-number-frame">
                    </div>

                    <div class="w2 frame expiry-date-frame">
                    </div>

                    <div class="w2 frame cvv-frame">
                    </div>

                    <button id="pay-button" disabled="">
                        PAY EUR 65.10
                    </button>

                    <div>
                        <span class="error-message error-message__card-number"></span>
                        <span class="error-message error-message__expiry-date"></span>
                        <span class="error-message error-message__cvv"></span>
                    </div>
                    <p class="success-payment-message"></p>

                </form>

            </div>

        </section>

    </main>

    <!-- Footer -->
    <footer>

        <div class="footer-content">

            <div class="links">
                <ul>
                    <li><a href="#" target="_top">Products</a></li>
                    <li><a href="#" target="_top">Your orders</a></li>
                    <li><a href="#" target="_top">About us</a></li>
                    <li><a href="#" target="_top">Login</a></li>
                </ul>
                <ul>
                    <li><a href="#" target="_top">Contact</a></li>
                    <li><a href="#" target="_top">Legal</a></li>
                    <li><a href="#" target="_blank"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/950358/logo_facebook.svg" alt="Facebook logo" class="social-media"></a> <a href="#" target="_blank"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/950358/logo_instagram.svg" alt="Instagram logo" class="social-media"></a></li>
                </ul>
            </div>
            <p>Alexis Riche April 18th 2022 – Powered by</p>
            <p><a href="https://www.checkout.com/" target="_blank"><svg width="185" height="20" viewBox="0 0 185 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M137.26 18.918C138.268 18.918 139.085 18.0864 139.085 17.0606C139.085 16.0347 138.268 15.2031 137.26 15.2031C136.252 15.2031 135.435 16.0347 135.435 17.0606C135.435 18.0864 136.252 18.918 137.26 18.918Z" fill="#fffffd"></path><path d="M32.2673 18.4301C31.4508 18.088 30.7304 17.5992 30.2021 16.9637C29.6257 16.3283 29.1935 15.5951 28.8572 14.7641C28.521 13.9332 28.377 13.0045 28.377 12.0269C28.377 11.0493 28.521 10.1206 28.8092 9.28961C29.0974 8.45865 29.5297 7.67657 30.106 7.09001C30.6824 6.45457 31.3548 5.96578 32.1232 5.62362C32.9397 5.28146 33.8043 5.08594 34.8129 5.08594C35.6774 5.08594 36.3978 5.1837 37.0702 5.4281C37.7427 5.6725 38.319 6.01466 38.8473 6.40569C39.3756 6.79673 39.7599 7.33441 40.0481 7.92097C40.3843 8.50753 40.5764 9.19185 40.6724 9.87616H37.3104C37.2143 9.28961 36.9262 8.80081 36.4939 8.40977C36.0616 8.01873 35.5333 7.82321 34.9089 7.82321C33.8523 7.82321 33.0838 8.21425 32.5555 8.94745C32.0272 9.68064 31.787 10.7071 31.787 11.978C31.787 13.2489 32.0272 14.2265 32.5555 15.0085C33.0358 15.7906 33.8523 16.1328 34.9089 16.1328C35.6294 16.1328 36.2057 15.9373 36.638 15.5951C37.0702 15.2041 37.3584 14.6664 37.5025 13.8843H40.8646C40.8165 14.5686 40.6244 15.2529 40.3362 15.8395C40.0481 16.4261 39.6638 16.9637 39.1355 17.4525C38.6552 17.8925 38.0308 18.2835 37.3584 18.5279C36.638 18.7723 35.8695 18.9189 35.005 18.9189C33.9964 18.9678 33.0838 18.7723 32.2673 18.4301Z" fill="#fffffd"></path><path d="M46.2436 7.08938C46.7239 6.40506 47.2522 5.86738 47.8286 5.52522C48.4049 5.18306 49.1254 4.98754 50.0379 4.98754C50.7103 4.98754 51.3347 5.13418 51.863 5.37858C52.3914 5.62298 52.8717 5.96514 53.2559 6.40506C53.6401 6.84498 53.9283 7.38265 54.1684 7.96921C54.4086 8.55577 54.5047 9.24009 54.5047 9.97329V18.5761H51.0465V10.4621C51.0465 9.72889 50.8544 9.14233 50.4702 8.70241C50.086 8.26249 49.5096 8.01809 48.7892 8.01809C48.0207 8.01809 47.3963 8.31137 46.916 8.84905C46.4357 9.38673 46.1476 10.1199 46.1476 11.0486V18.5761H42.6895V0.148438H46.1476V7.08938H46.2436Z" fill="#fffffd"></path><path d="M60.1724 18.4282C59.3559 18.0861 58.6355 17.5973 58.0591 16.9618C57.4828 16.3264 57.0505 15.5932 56.7623 14.7134C56.4742 13.8335 56.3301 12.9537 56.3301 11.9761C56.3301 10.9985 56.4742 10.0698 56.8104 9.23882C57.1466 8.40786 57.5788 7.67467 58.1072 7.03923C58.6835 6.40379 59.3559 5.91499 60.1244 5.57283C60.8929 5.23068 61.7574 5.03516 62.718 5.03516C63.7746 5.03516 64.6872 5.23068 65.4556 5.62171C66.2721 6.01275 66.8965 6.55043 67.4729 7.23475C68.0012 7.91907 68.4334 8.7989 68.7216 9.72762C69.0098 10.7052 69.1539 11.7806 69.1539 12.9537H59.7402C59.8842 13.9802 60.2204 14.8111 60.7488 15.3977C61.2771 15.9842 62.0456 16.2775 63.0542 16.2775C63.7266 16.2775 64.2549 16.1309 64.6872 15.8376C65.0714 15.5443 65.4076 15.1533 65.5517 14.6645H68.9618C68.8657 15.251 68.6256 15.7887 68.3374 16.3264C68.0012 16.8641 67.6169 17.304 67.1367 17.695C66.6564 18.0861 66.032 18.4282 65.3596 18.6237C64.6872 18.8681 63.9187 18.9659 63.1022 18.9659C61.9975 18.9659 61.0369 18.7704 60.1724 18.4282ZM60.7007 8.45674C60.2204 8.94554 59.9323 9.67874 59.7402 10.5097H65.5037C65.4556 9.67874 65.1675 8.99442 64.6872 8.45674C64.2069 7.91907 63.5345 7.67467 62.766 7.67467C61.8534 7.72355 61.181 7.96795 60.7007 8.45674Z" fill="#fffffd"></path><path d="M74.2927 18.4301C73.4762 18.088 72.7558 17.5992 72.2275 16.9637C71.6511 16.3283 71.2188 15.5951 70.8826 14.7641C70.5464 13.9332 70.4023 13.0045 70.4023 12.0269C70.4023 11.0493 70.5464 10.1206 70.8346 9.28961C71.1228 8.45865 71.555 7.67657 72.1314 7.09001C72.7077 6.45457 73.3802 5.96578 74.1486 5.62362C74.9651 5.28146 75.8296 5.08594 76.8383 5.08594C77.7028 5.08594 78.4232 5.1837 79.0956 5.4281C79.768 5.6725 80.3444 6.01466 80.8727 6.40569C81.401 6.79673 81.7853 7.33441 82.0734 7.92097C82.4096 8.50753 82.6018 9.19185 82.6978 9.87616H79.3358C79.2397 9.28961 78.9515 8.80081 78.5193 8.40977C78.087 8.01873 77.5587 7.82321 76.9343 7.82321C75.8777 7.82321 75.1092 8.21425 74.5809 8.94745C74.0526 9.68064 73.8124 10.7071 73.8124 11.978C73.8124 13.2489 74.0526 14.2265 74.5809 15.0085C75.0612 15.7906 75.8777 16.1328 76.9343 16.1328C77.6548 16.1328 78.2311 15.9373 78.6634 15.5951C79.0956 15.2041 79.3838 14.6664 79.5279 13.8843H82.8419C82.7939 14.5686 82.6018 15.2529 82.3136 15.8395C82.0254 16.4261 81.6412 16.9637 81.1129 17.4525C80.6326 17.8925 80.0082 18.2835 79.3358 18.5279C78.6153 18.7723 77.8469 18.9189 76.9823 18.9189C76.0218 18.9678 75.1092 18.7723 74.2927 18.4301Z" fill="#fffffd"></path><path d="M88.1738 14.1281V18.5761H84.7637V0.148438H88.1738V10.3643L92.7846 5.37858H96.9151L92.1122 10.4132L97.4914 18.5761H93.3129L89.6627 12.5639L88.1738 14.1281Z" fill="#fffffd"></path><path d="M101.285 18.4301C100.469 18.088 99.7485 17.5992 99.1241 16.9637C98.5478 16.3283 98.0675 15.5951 97.7313 14.7641C97.3951 13.9332 97.251 13.0045 97.251 12.0269C97.251 11.0493 97.3951 10.1206 97.7313 9.2896C98.0675 8.45865 98.5478 7.67657 99.1241 7.09001C99.7005 6.45457 100.421 5.96577 101.285 5.62362C102.102 5.28146 103.014 5.08594 104.023 5.08594C105.032 5.08594 105.944 5.28146 106.761 5.62362C107.577 5.96577 108.298 6.45457 108.922 7.09001C109.498 7.72545 109.979 8.45865 110.315 9.2896C110.651 10.1206 110.795 11.0493 110.795 12.0269C110.795 13.0045 110.651 13.9332 110.315 14.7641C109.979 15.5951 109.498 16.3772 108.922 16.9637C108.346 17.5992 107.625 18.088 106.761 18.4301C105.944 18.7723 105.032 18.9678 104.023 18.9678C103.014 18.9678 102.102 18.7723 101.285 18.4301ZM106.473 15.1063C107.049 14.3242 107.337 13.2978 107.337 11.978C107.337 10.6582 107.049 9.63176 106.473 8.84969C105.896 8.06761 105.08 7.62769 104.023 7.62769C102.966 7.62769 102.15 8.01873 101.574 8.84969C100.997 9.63176 100.709 10.7071 100.709 11.978C100.709 13.2489 100.997 14.3242 101.574 15.1063C102.15 15.8884 102.966 16.2794 104.023 16.2794C105.08 16.2794 105.896 15.8884 106.473 15.1063Z" fill="#fffffd"></path><path d="M120.881 17.0123H120.785C120.353 17.5989 119.825 18.0877 119.296 18.4298C118.72 18.772 118 18.9186 117.087 18.9186C115.646 18.9186 114.541 18.4787 113.725 17.6477C112.956 16.7679 112.572 15.6437 112.572 14.1773V5.37891H115.982V13.5907C115.982 14.3728 116.174 14.9594 116.511 15.3504C116.847 15.7414 117.423 15.9858 118.144 15.9858C118.96 15.9858 119.585 15.6926 120.065 15.1549C120.545 14.6172 120.785 13.884 120.785 13.0042V5.37891H124.243V18.5765H120.929V17.0123H120.881Z" fill="#fffffd"></path><path d="M127.557 5.37744V1.22266H130.919V5.37744H133.129V7.67479H130.919V14.6646C130.919 15.1534 131.015 15.4956 131.256 15.6911C131.496 15.8866 131.784 15.9844 132.216 15.9844H132.889C132.985 15.9844 133.129 15.9844 133.225 15.9355V18.575C133.033 18.575 132.889 18.6239 132.648 18.6239C132.456 18.6239 132.216 18.6728 131.976 18.6728H131.063C130.631 18.6728 130.247 18.6239 129.815 18.5261C129.382 18.4284 129.046 18.2817 128.71 18.0373C128.374 17.7929 128.086 17.4508 127.894 17.0597C127.701 16.6687 127.557 16.131 127.557 15.4956V7.67479H125.78V5.37744H127.557Z" fill="#fffffd"></path><path d="M144.079 18.3795C143.359 18.0373 142.734 17.5485 142.206 16.9131C141.678 16.2776 141.293 15.5444 141.053 14.7135C140.813 13.8825 140.669 12.9538 140.669 11.9273C140.669 10.9008 140.813 10.021 141.053 9.14117C141.341 8.31021 141.726 7.52813 142.206 6.94157C142.734 6.30614 143.359 5.81734 144.079 5.47518C144.799 5.13302 145.664 4.9375 146.625 4.9375C148.065 4.9375 149.266 5.32854 150.179 6.06174C151.091 6.79493 151.668 7.87029 151.908 9.23892H150.371C150.179 8.26133 149.794 7.47925 149.122 6.99045C148.498 6.50165 147.681 6.25726 146.673 6.25726C145.904 6.25726 145.28 6.40389 144.703 6.69717C144.175 6.99045 143.695 7.38149 143.359 7.91917C143.022 8.40797 142.734 9.04341 142.59 9.72772C142.398 10.412 142.35 11.1452 142.35 11.9273C142.35 12.7094 142.446 13.4426 142.638 14.1269C142.83 14.8112 143.07 15.3978 143.455 15.9355C143.791 16.4731 144.271 16.8642 144.799 17.1575C145.328 17.4507 146 17.5974 146.721 17.5974C147.825 17.5974 148.738 17.2552 149.41 16.6198C150.083 15.9843 150.467 15.1045 150.611 14.0291H152.1C151.956 15.5444 151.427 16.7175 150.467 17.6463C149.554 18.5261 148.306 18.966 146.721 18.966C145.664 18.9171 144.799 18.7216 144.079 18.3795Z" fill="#fffffd"></path><path d="M156.903 18.3795C156.134 18.0373 155.51 17.5485 154.982 16.9131C154.453 16.2776 154.069 15.5444 153.781 14.7135C153.493 13.8825 153.349 12.9538 153.349 11.9273C153.349 10.9008 153.493 10.021 153.781 9.14117C154.069 8.31021 154.453 7.52813 154.982 6.94157C155.51 6.30614 156.134 5.81734 156.903 5.47518C157.671 5.13302 158.488 4.9375 159.448 4.9375C160.409 4.9375 161.225 5.13302 161.994 5.47518C162.714 5.81734 163.387 6.30614 163.915 6.94157C164.443 7.57701 164.828 8.31021 165.116 9.14117C165.404 9.97212 165.5 10.9008 165.5 11.9273C165.5 12.9538 165.356 13.8336 165.116 14.7135C164.828 15.5444 164.443 16.3265 163.915 16.9131C163.387 17.5485 162.762 18.0373 161.994 18.3795C161.273 18.7216 160.409 18.9171 159.448 18.9171C158.536 18.9171 157.671 18.7216 156.903 18.3795ZM161.37 17.1575C161.946 16.8642 162.378 16.4731 162.762 15.9355C163.147 15.3978 163.435 14.8112 163.579 14.1269C163.771 13.4426 163.867 12.7094 163.867 11.9273C163.867 11.1452 163.771 10.412 163.579 9.72772C163.387 9.04341 163.099 8.45685 162.762 7.91917C162.378 7.38149 161.946 6.99045 161.37 6.69717C160.793 6.40389 160.169 6.25726 159.448 6.25726C158.728 6.25726 158.055 6.40389 157.527 6.69717C156.999 6.99045 156.519 7.38149 156.134 7.91917C155.75 8.45685 155.462 9.04341 155.27 9.72772C155.078 10.412 154.982 11.1452 154.982 11.9273C154.982 12.7094 155.078 13.4426 155.27 14.1269C155.462 14.8112 155.75 15.3978 156.134 15.9355C156.519 16.4731 156.999 16.8642 157.527 17.1575C158.055 17.4507 158.728 17.5974 159.448 17.5974C160.169 17.5974 160.841 17.4507 161.37 17.1575Z" fill="#fffffd"></path><path d="M169.295 5.23278V7.23686H169.343C169.775 6.55254 170.304 6.01486 170.928 5.57494C171.552 5.13502 172.369 4.93951 173.329 4.93951C174.146 4.93951 174.866 5.13502 175.491 5.52606C176.115 5.9171 176.547 6.55254 176.835 7.33462H176.884C177.316 6.55254 177.892 5.96598 178.613 5.52606C179.333 5.08614 180.15 4.89062 181.062 4.89062C181.638 4.89062 182.119 4.98838 182.599 5.1839C183.079 5.37942 183.512 5.62382 183.848 5.96598C184.184 6.30814 184.472 6.74806 184.664 7.28574C184.856 7.82342 184.952 8.40997 184.952 9.04541V18.577H183.415V9.24093C183.415 8.26333 183.175 7.53014 182.647 7.04134C182.119 6.55254 181.446 6.35702 180.678 6.35702C180.198 6.35702 179.717 6.45478 179.333 6.60142C178.901 6.79694 178.517 7.04134 178.228 7.33462C177.94 7.6279 177.652 8.06781 177.46 8.50773C177.268 8.99653 177.172 9.48533 177.172 10.0719V18.577H175.587V9.24093C175.587 8.26333 175.347 7.53014 174.818 7.04134C174.338 6.55254 173.714 6.35702 172.945 6.35702C172.465 6.35702 172.033 6.45478 171.6 6.6503C171.168 6.84582 170.784 7.09022 170.4 7.43238C170.063 7.77454 169.775 8.16557 169.583 8.65437C169.391 9.09429 169.295 9.63197 169.295 10.1696V18.577H167.71V5.23278H169.295Z" fill="#fffffd"></path><path d="M15.4091 12.0244L21.5568 1.07536C21.7009 0.830957 21.7009 0.586558 21.5568 0.342159C21.4127 0.146639 21.1726 0 20.9324 0H8.2527C8.01256 0 7.77241 0.146639 7.62832 0.342159L1.09635 11.6334C0.952259 11.8778 0.952259 12.1711 1.09635 12.3666L7.62832 23.6578C7.77241 23.9022 8.01256 24 8.2527 24H20.9324C21.1726 24 21.4127 23.8534 21.5568 23.6578C21.7009 23.4134 21.7009 23.169 21.5568 22.9246L15.4091 12.0244ZM14.5926 10.558L9.50146 1.4664H19.7317L14.5926 10.558ZM8.20467 2.19959L13.728 12.0244L8.20467 21.8493L2.53722 12.0244L8.20467 2.19959ZM9.50146 22.5336L14.5926 13.442L19.6837 22.5336H9.50146Z" fill="#fffffd"></path></svg></a></p>

        </div>

    </footer>

    <script src='https://cdn.checkout.com/js/framesv2.min.js'></script>
    <script>
        // Manage color for Checkout Frames API style
        const   dark_color = '#323416',
                medium_color = '#8c9e6e',
                light_color = '#fffffd',
                error_color = '#f80';

        // Global Frames
        const   payButton = document.getElementById("pay-button"),
                form = document.getElementById("payment-form");

        Frames.init({
            publicKey: 'pk_test_4296fd52-efba-4a38-b6ce-cf0d93639d8a',
            // localization: 'DE-DE',
            localization: {
                cardNumberPlaceholder: '•••• •••• •••• ••••',
                expiryMonthPlaceholder: 'MM',
                expiryYearPlaceholder: 'YY',
                cvvPlaceholder: 'CVV',
            },
            style: {
                base: {
                    color: medium_color,
                    fontSize: '1em',
                    fontFamily: '"Open Sans", "Century Gothic", "Calibri", "Trebuchet MS", Arial, Helvetica, "sans-serif"',
                    letterSpacing: '.1em'
                },
                autofill: {
                    backgroundColor: medium_color,
                    color: light_color
                },
                hover: {
                    color: medium_color
                },
                focus: {
                    color: medium_color
                },
                valid: {
                    color: dark_color
                },
                invalid: {
                    color: error_color,
                },
                placeholder: {
                    base: {
                        color: medium_color,
                        fontSize: '1em',
                        letterSpacing: '.1em'
                    },
                    focus: {
                    },
                },
            },
        });

        var errors = {};
        errors["card-number"] = "Please enter a valid card number";
        errors["expiry-date"] = "Please enter a valid expiry date";
        errors["cvv"] = "Please enter a valid cvv code";

        Frames.addEventHandler(
            Frames.Events.FRAME_VALIDATION_CHANGED,
            onValidationChanged
        );
        function onValidationChanged(event) {
            console.log("CARD_VALIDATION_CHANGED: %o", event);

            var e = event.element;

            if (event.isValid || event.isEmpty) {
                clearErrorMessage(e);
            } else {
                setErrorMessage(e);
            }
        }

        function clearErrorMessage(el) {
            var selector = ".error-message__" + el;
            var message = document.querySelector(selector);
            message.textContent = "";
        }

        function setErrorMessage(el) {
            var selector = ".error-message__" + el;
            var message = document.querySelector(selector);
            message.textContent = errors[el];
        }

        Frames.addEventHandler(
            Frames.Events.CARD_VALIDATION_CHANGED,
            cardValidationChanged
        );
        function cardValidationChanged() {
            console.log("CARD_VALIDATION_CHANGED: %o", event);
            payButton.disabled = !Frames.isCardValid();
        }

        Frames.addEventHandler(
            Frames.Events.CARD_TOKENIZATION_FAILED,
            onCardTokenizationFailed
        );
        function onCardTokenizationFailed(error) {
            console.log("CARD_TOKENIZATION_FAILED: %o", error);
            Frames.enableSubmitForm();
        }

        Frames.addEventHandler(Frames.Events.CARD_TOKENIZED, onCardTokenized);
        function onCardTokenized(event) {
            var email = document.querySelector("#email").value;
            var name = document.querySelector("#name").value;
            var el = document.querySelector(".success-payment-message");
            el.innerHTML =
                "Card tokenization completed<br>" +
                'Your card token is: <span class="token">' +
                event.token +
                "</span><br>Redirecting...";
            document.location.href='?token='+event.token+'&email='+email+'&name='+name+'';
        }

        form.addEventListener("submit", onSubmit);
        function onSubmit(event) {
            console.log('form submited');
            event.preventDefault();
            Frames.submitCard();
        }

        function paymentMethods(el) {
            console.log('el:'+el);
            const paymentMethod = document.querySelectorAll('.paymentMethod');
            for (var i = 0; i < paymentMethod.length; i++) {
                console.log('paymentMethod[i].id:'+paymentMethod[i].id);
                if(el !== paymentMethod[i].id) {
                    paymentMethod[i].classList.remove("on");
                } else {
                    paymentMethod[i].classList.add("on");
                }
            }
        }
    </script>

</body>
</html>
