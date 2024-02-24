<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Business Permit</title>
  <link rel="alternate icon" href="dist/img/logo.png" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="node_modules/font/font.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
       .slideshow-container {
            max-width: 600px;
            position: relative;
            margin: auto;
        }

        .slide {
            display: none;
            text-align: center;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .prev, .next {
            position: absolute;
            top: 50%;
            width: auto;
            padding: 10px;
            margin-top: -22px;
            font-size: 10px;
            font-weight: bold;
            color: white;
            background-color: #1F72FC;
            border: none;
            cursor: pointer;
        }

        .next {
            right: 0;
        }
  </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
<div class="container">
<a href="index.php" class="navbar-brand">
<img src="dist/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
</a>
<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse order-3" id="navbarCollapse">

<ul class="navbar-nav">
<li class="nav-item">
<a href="index.php" class="nav-link">Home</a>
</li>
</ul>
</div>

<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
<li class="nav-item">
<a class="nav-link" href="login.php" role="button">
Login <i class="fas fa-arrow-circle-right"></i>
</a>
</li>
</ul>
</div>
</nav>


<div class="content-wrapper">
<br>
<div class="content">
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="card card-primary card-outline">
<div class="card-header">
<h5 class="card-title m-0"></h5>
</div>
<div class="row">
    <div class="col-lg-6" style="border-right: 1px solid #D3D3D3;">
        <div class="card-body">
        <h6 class="card-title"></h6>
        <p class="card-text"><b>Business Permit ng Bayan</b></p>
        <hr>
         <p class="card-text"><b>Register and Renew Your Business to US</b></p> 
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
        <hr>
        </p>
        <div class="float-right">
        <a href="login.php" class="btn btn btn-primary">Proceed <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        </div>
    </div>
    <div class="col-lg-6">
         <img src="dist/img/gilas.png" style="height: 100%; width: 100%;object-fit:contain;">
    </div>
</div>
</div>
</div>
</div>
<br>
<div class="row">
     <div class="col-lg-12">
        <div class="card card-primary card-outline">
        <div class="card-header">
        <h5 class="card-title m-0"><b>Mission & Vision</b></h5>
        </div>
        <div class="card-body">
        <h6 class="card-title"></h6>
        <p class="card-text">
            <div class="row">
                <div class="col-lg-6" style="border-right: 1px sold #D3D3D3; height: 100px;">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text" style="text-align: justify; text-indent: 25px; height: 100px;">
                        To deliver fast and efficient services and encourage businessmen to augment revenues and job opportunities in the locality and inspect every establishment in accordance with the rules and guidelines imposed.
                        </p>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-6" style="border-right: 1px sold #D3D3D3;">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text" style="text-align: justify; text-indent: 25px; height: 100px;">
                        Be the most efficient, prompt and business-friendly business permits and licensing office.
                        </p>
                        </div>
                    </div>
                </div>
            </div>
        </p>
        </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
        <div class="card-header">
        <h5 class="card-title m-0"><b>Activities</b></h5>
        </div>
        <div class="card-body">
        <h6 class="card-title"></h6>
        <p class="card-text">
            <div class="col-lg-12">
                <div class="slideshow-container">
                   <!--  <div class="slide">
                       
                    </div>
                    <div class="slide">
                        
                    </div>
                    <div class="slide">
                        
                    </div> -->
                    <?php
                     for ($x = 1; $x <= 6; $x++) {
                          echo ' <div class="slide">
                            <img src="dist/img/activities/'.$x.'.jpg" style="height:100%; width:100%;">
                            </div>';
                        }   
                    ?>

                    <button class="prev" onclick="plusSlides(-1)">❮</button>
                    <button class="next" onclick="plusSlides(1)">❯</button>
                </div>
            </div>
        </p>
        
        </div>
        </div>
    </div>
</div>

</div>
</div>

</div>


<aside class="control-sidebar control-sidebar-dark">

</aside>


<footer class="main-footer">
<strong>Copyright &copy; 2023-2030 <a href="#"></a>Business Permit</strong> All rights reserved.
</footer>
</div>
<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function showSlides(n) {
        let i;
        const slides = document.getElementsByClassName("slide");

        if (n > slides.length) {
            slideIndex = 1;
        }

        if (n < 1) {
            slideIndex = slides.length;
        }

        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        slides[slideIndex - 1].style.display = "block";
    }
    // Auto proceed to next slide every 2 seconds
setInterval(function () {
    plusSlides(1);
}, 2000);
</script>


<script src="plugins/jquery/jquery.min.js"></script>

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
