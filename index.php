<?php

include("session_check.php"); //checking whether to redirect the user to his/her account if previously logged in

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Rustom</title>
    <link rel="icon" href="icon.ico">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic">
    <!--<link rel="stylesheet" href="assets/css/untitled.css">-->
</head>

<style>

#signupbut
{
    margin-left:234px;
}

#header a
{
    font-size: 22.5px;
}

#loginbut,#loginbut:hover,#loginbut:focus,#loginbut:visited
{
    padding:3.5px 7.5px;
    border-radius:2.5px;
    border:none;
    background-color: rgba(114,22,77,0.9);
    text-decoration:none;
    color:white;
}


@media screen and (max-width:769px)
{
    #signupbutholder
    {
        min-width:75%;
        max-width:75%;
        margin:auto;
        overflow:hidden;
    }

    #signupbut
    {
        margin-left:0px;
    }

    #header a
    {
        font-size:20px;
    }
}

@media screen and (max-width:400px)
{
    #header a
    {
        font-size:15px;
    }
}

</style>


<body>
    <nav class="navbar navbar-light navbar-expand bg-light navigation-clean">
        <div class="container" id="header"><a class="navbar-brand" href="#" style="color: rgba(114,22,77,0.9)">RUSTOM <span style="color:black">Car Dealership</span></a>
                <div class="collapse navbar-collapse" id="navcol-1"><a class="ml-auto" id="loginbut" href="login.php">Login</a></div>
        </div>
    </nav>
    <header class="masthead text-white text-center" style="background: url('assets/img/bg-neon.jpg')no-repeat center center;background-size: cover;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h1 class="text-capitalize text-center text-white mb-5">GET! SET! VROOM!</h1>
                </div>
                <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                    <form action="register.html">
                        <div class="form-row">
                            <div class="col-12 col-md-3" id="signupbutholder">
                            <button class="btn btn-primary btn-block btn-lg" type="submit" id="signupbut" style="border:none;background-color: rgba(114,22,77,0.9);padding-left: 18px">Sign up!</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <section class="showcase">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image:url(&quot;assets/img/la.jpg&quot;);"><span></span></div>
                <div class="col-lg-6 my-auto order-lg-1 showcase-text">
                    <h2 style="color: rgba(114,22,77,0.9);">Latest Deals!</h2>
                    <h2 style="color: rgba(0,0,0,1);">RUSTOM - the first buy limo-MARKET.</h2>
                    <h4 style="color: rgba(0, 0, 0, 0.49);">Find all the latest cars at incredible prices.</h4>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-lg-6 text-white showcase-img" style="background-image:url(&quot;assets/img/lt.jpg&quot;);"><span></span></div>
                <div class="col-lg-6 my-auto order-lg-1 showcase-text">
                    <h2 style="color: rgba(114,22,77,0.9);">Timeless! Luxury! Performance!</h2>
                    <h2 style="color: rgba(0,0,0,1);">Enjoy your OPULENCE!</h2>
                    <h4 style="color: rgba(0, 0, 0, 0.49);">RUSTOM brings you all range of premium cars at your service.</h4>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image:url(&quot;assets/img/ba.jpg&quot;);"><span></span></div>
                <div class="col-lg-6 my-auto order-lg-1 showcase-text">
                    <h2 style="color: rgba(114,22,77,0.9);">Best Assured!</h2>
                    <h2 style="color: rgba(0,0,0,1);">We CARE for your CAR!</h2>
                    <h4 style="color: rgba(0, 0, 0, 0.49);">All dealerships care about their customers but RUSTOM takes it to a whole new level.</h4>
                </div>
            </div>
        </div>
    </section>
    <section class="testimonials text-center bg-light">
        <div class="container">
            <h2 class="mb-5" style="color: rgba(114,22,77,0.9);">Listen to what the Experts say......</h2>
            <div class="row">
                <div class="col-lg-4">
                    <div class="mx-auto testimonial-item mb-5 mb-lg-0"><img class="rounded-circle img-fluid mb-3" src="assets/img/e1m.jpg">
                        <h5>Elon Musk</h5>
                        <h5>CEO- TESLA, INC.</h5>
                        <p class="font-weight-light mb-0" style="color: rgba(114,22,77,0.9);">"Team Rustom has all physics to be the greatest car dealer of all times."</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mx-auto testimonial-item mb-5 mb-lg-0"><img class="rounded-circle img-fluid mb-3" src="assets/img/hb.jpg">
                        <h5>Herbert Diess</h5>
                        <h6>CHAIRMAN- VOLKSWAGEN AG</h6>
                        <p class="font-weight-light mb-0" style="color: rgba(114,22,77,0.9);">"If anyone ask me about the RustomCars, I'd just say One Word - ELEGANT."</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mx-auto testimonial-item mb-5 mb-lg-0"><img class="rounded-circle img-fluid mb-3" src="assets/img/s6d.jpg">
                        <h5>Stefano Domenicali</h5>
                        <h5>CEO- LAMBORGHINI</h5>
                        <p class="font-weight-light mb-0" style="color: rgba(114,22,77,0.9);">"Whenever I visit Rustom, I feel like Lamborghini is just a portion of it."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="call-to-action text-white text-center" style="background: url(&quot;assets/img/bg-feedback.jpg&quot;) no-repeat center center;background-size: cover;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h2 class="mb-4">Ideas are the currency of our success!</h2>
                </div>
                <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                    <form>
                        <div class="form-row">
                            <div class="col-12 col-md-9 mb-2 mb-md-0"><input class="form-control form-control-lg" type="text" placeholder="Feedback"></div>
                            <div class="col-12 col-md-3"><button class="btn btn-primary btn-block btn-lg" type="submit" style="border:none;background-color: rgba(114,22,77,0.9);">Submit</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer" style="background-color: rgba(114,22,77,0.9);">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 my-auto h-100 text-center text-lg-left">
                    <ul class="list-inline mb-2">
                        <li class="list-inline-item"><a href="#" style="color: rgb(248,249,250);">About</a></li>
                        <li class="list-inline-item"><a href="#" style="color: rgb(248,249,250);">Contact</a></li>
                        <li class="list-inline-item"><a href="#" style="color: rgb(248,249,250);">Terms of Use &amp Privacy Policy</a></li>
                        <li class="list-inline-item"></li>
                    </ul>
                    <p class="text-left text-muted small mb-4 mb-lg-0" style="color: rgb(248,249,250);">© RUSTOM. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
