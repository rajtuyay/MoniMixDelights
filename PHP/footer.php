<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/font.css">
    <style>
        .home5 {
            background-color: #feeaf7;
            border-top: 3px dashed #FA8BCE;
            margin: 20px auto 0;
            /* Add margin for spacing */
            width: 100%;
            height: 70vh;
            padding-bottom: 50px;
            display: flex;
        }

        .home5 .home51 {
            width: 44%;
            display: block;
        }

        .home5 .home51 .home511 {
            margin: 60px 40px 40px 60px;
        }

        .home5 .home51 .home511 img {
            float: left;
        }

        .home5 .home51 .home511 p {
            color: #B91EB3;
            font-family: 'Open Sans';
            line-height: 27px;
            text-align: justify;
            letter-spacing: 1px;
            font-size: 18px;
            margin-left: 15px;
            margin-right: 90px;
        }

        .home5 .home51 .home511 #orderNow {
            margin-left: 15px;
            font-family: 'Open Sans';
            margin-top: 7px;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            background-color: #FA8BCE;
            color: white;
            width: 75%;
            border: none;
            border-radius: 10px;
            text-align: center;
            padding: 15px;
            z-index: 100;
        }

        .home5 .home51 .home511 #orderNow:hover {
            background-color: #f95cba;
        }

        /*--nav---*/
        .home5 .home52 .home521 h1 {
            /*navigation*/
            color: #B91EB3;
            font-weight: 600;
            font-family: 'Open Sans';
            font-size: 23px;
            margin-top: 60px;
        }

        .home5 .home52 .home521 h1,
        .home5 .home52 .home521 a {
            margin-left: 40px;
        }

        .home5 .home52 .home521 a {
            color: #fd69c2;
            font-family: 'Open Sans';
            font-size: 18px;
            text-decoration: underline;
            text-underline-offset: 6px;
            letter-spacing: 1px;
            line-height: 35px;
        }

        /*-- nav---*/


        .home5 .home53 .home531 h1 {
            color: #B91EB3;
            font-weight: 600;
            font-family: 'Open Sans';
            font-size: 23px;
            margin-top: 60px;
        }



        .home5 .home53 .home531 p {
            margin-top: 20px;
            color: #B91EB3;
            font-family: 'Open Sans';
            line-height: 32px;
            text-decoration: none;
            font-size: 18px;
        }

        .home5 .home52 {
            width: 28%;
            display: block;
        }

        .home5 .home53 {
            width: 28%;
            display: block;
        }

        .home5 .home53 img {
            /*facebook and mail - logo */
            width: 30px;
            height: 30px;
            margin-right: 5px;
        }

        @media (max-width: 1100px) {
            .home5 .home51 .home511 #orderNow {
                display: block;
            }
        }

        @media (max-width: 960px) {
            .home5 {
                float: left;
                display: block;
                height: auto;
                padding-bottom: 0;
            }

            .home5 .home51 {
                width: 40%;
                height: auto;
                float: left;
                height: auto;
            }

            .home5 .home52,
            .home5 .home53 {
                width: 30%;
                height: auto;
                align-items: center;
                float: left;
            }

            .home5 .home51 .home511 img {
                width: 50px;
                height: 50px;
            }

            .home5 .home51 .home511 a img {
                width: 130px;
                height: 50px;
            }

            .home5 .home51 .home511 p {
                font-size: 0.9rem;
                margin-right: 0;
            }

            .home5 .home52 .home521 h1,
            .home5 .home53 .home531 h1 {
                font-size: 1.2rem;
            }

            .home5 .home52 .home521 a,
            .home5 .home53 .home531 p {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 769px) {
            .home5 {
                float: left;
                display: block;
                height: auto;
                padding-bottom: 0;
            }

            .home5 .home51 {
                width: 40%;
                height: auto;
                float: left;
                height: auto;
            }

            .home5 .home51 .home511 {
                margin: 30px;
            }

            .home5 .home52 .home521 h1,
            .home5 .home53 .home531 h1 {
                margin-top: 30px;
            }

            .home5 .home52,
            .home5 .home53 {
                width: 30%;
                height: auto;
                align-items: center;
                float: left;
            }

            .home5 .home51 .home511 img {
                width: 50px;
                height: 50px;
            }

            .home5 .home51 .home511 a img {
                width: 130px;
                height: 50px;
            }

            .home5 .home51 .home511 p {
                font-size: 0.9rem;
                margin: 10px 0 0 10px;
            }

            .home5 .home51 .home511 #orderNow {
                margin-left: 0;
            }

            .home5 .home52 .home521 h1,
            .home5 .home53 .home531 h1 {
                font-size: 1.2rem;
            }

            .home5 .home52 .home521 a,
            .home5 .home53 .home531 p {
                font-size: 0.9rem;
            }

            .home5 .home51 .home511 p,
            .home5 .home52 .home521 p,
            .home5 .home53 .home531 p {
                margin: 0;
            }

            .home5 .home53 img {
                width: 23px;
                height: 23px;
            }
        }

        @media (max-width: 680px) {
            .home5 {
                float: left;
                display: block;
                height: auto;
                padding-bottom: 0;
            }

            .home5 .home51 {
                width: 100%;
                height: auto;
                float: left;
                height: auto;
            }

            .home5 .home51 .home511 {
                margin: 30px;
            }

            .home5 .home51 .home511 #orderNow {
                width: 40vh;
                font-size: 0.9rem;
            }

            .home5 .home52 .home521 h1,
            .home5 .home53 .home531 h1 {
                margin-top: 30px;
            }

            .home5 .home52,
            .home5 .home53 {
                width: 50%;
                height: auto;
                align-items: center;
                float: left;
            }

            .home5 .home51 .home511 img {
                width: 50px;
                height: 50px;
            }

            .home5 .home51 .home511 a img {
                width: 130px;
                height: 50px;
            }

            .home5 .home51 .home511 p {
                font-size: 0.9rem;
            }

            .home5 .home52 .home521 h1,
            .home5 .home53 .home531 h1 {
                font-size: 1.2rem;
            }

            .home5 .home52 .home521 a,
            .home5 .home53 .home531 p {
                font-size: 0.9rem;
            }

            .home5 .home51 .home511 p,
            .home5 .home52 .home521 p,
            .home5 .home53 .home531 p {
                margin: 0;
            }

            .home5 .home53 img {
                width: 23px;
                height: 23px;
            }
        }

        @media (max-width: 430px) {
            .home5 .home51 {
                width: 100%;
                height: auto;
                float: left;
                height: auto;
                padding: 30px 30px 20px 30px;
            }

            .home5 .home51 .home511 {
                margin: 0;
                display: flex;
                text-align: center;
                align-items: center;
                justify-content: center;
                flex-wrap: wrap;
            }

            .home5 .home51 .home511 p {
                width: 50vh;
                margin: 20px 0 30px 0;
            }

            .home5 .home51 .home511 #orderNow {
                width: 50vh;
                font-size: 0.9rem;
                margin: auto;
            }
        }
    </style>
</head>

<body>
    <div class="home5">
        <div class="home51">
            <div class="home511">
                <img src="../IMG/logo-monimix.png" width="80px" height="80">
                <a href="index.php"><img src="../IMG/brand-name-monimix2.png" width="180" height="80"></a>
                <br><br><br>
                <p>We make sweets with love and passion, bringing you a delightful blend of classic and Filipino-inspired treats.</p>
                <br><a href="order-now.php" id="orderNow">order now</a>
            </div>
        </div>

        <div class="home52">
            <div class="home521">
                <h1 id="nav">Navigation</h1><br>
                <p>
                    <a href="index.php" id="na1">Home</a><br>
                    <a href="products.php" id="na2">Products</a><br>
                    <a href="history.php" id="na3">History</a><br>
                    <a href="about.php" id="na4">About</a><br>
                    <a href="profile.php" id="na5">Profile</a>
                </p><br>

            </div>
        </div>

        <div class="home53">
            <div class="home531">
                <h1>Contact Info</h1><br>
                <p>
                    +63 926 956 9811<br>
                    monimixdelights@gmail.com<br><br>
                    Monday - Saturday<br>
                    9:00am - 4:30pm
                </p>
            </div>
            <br>
            <img src="../IMG/facebook-logo.png">
            <img src="../IMG/email-logo.png">
        </div>

    </div>
</body>

</html>