<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"></head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="index.css">
    <title>Projekat</title>
    <style>


  </style>
</head>
<body>

<div id="carousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carousel" data-slide-to="0" class="active"></li>
    <li data-target="#carousel" data-slide-to="1"></li>
    <li data-target="#carousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block" src="images/image_<?php $random = rand(1,10); echo $random; ?>.jpg" alt="First slide" height="200px">
    </div>
    <div class="carousel-item">
      <img class="d-block" src="images/image_<?php $random = rand(1,10); echo $random; ?>.jpg" alt="Second slide" height="200px">
    </div>
    <div class="carousel-item">
      <img class="d-block" src="images/image_<?php $random = rand(1,10); echo $random; ?>.jpg" alt="Third slide" height="200px">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<div>

  <nav class="navbar navbar-expand-sm bg-primary navbar-dark ">
    <ul class="navbar-nav w-100">
      <li class="nav-item w-25">
        <a class="nav-link" href="?link=1" name="link1"><i class="fas fa-briefcase"></i> Posao</a>
      </li>
      <li class="nav-item w-25">
        <a class="nav-link" href="?link=2" name="link2"><i class="fas fa-heart"></i> Ljubav</a>
      </li>
      <li class="nav-item w-25">
        <a class="nav-link" href="?link=3" name="link3"><i class="fas fa-battery-full"></i> Motivacija</a>
      </li>
      <li class="nav-item w-25">
        <a class="nav-link" href="?link=4" name="link4"><i class="fas fa-medkit"></i> Zdravlje</a>
      </li>
    </ul>
  </nav>

  <section class="sekcija text-white bg-secondary" >

    <?php 

      if(isset($_GET['link'])){
        $link=$_GET['link'];
        if ($link == '1'){
            include 'Posao.php';
        }
        if ($link == '2'){
            include 'Ljubav.php';
        }
        if ($link == '3'){
            include 'Motivacija.php';
        }
        if ($link == '4'){
            include 'Zdravlje.php';
        }
        }
          else
          {
            include 'Start.php';
          }
    ?>

  </section>

</div>


<div class="slike">
  <span class="posao"><img src="posao.jpg" height=271px; width=25%;></span>

  <span><img src="ljubav.jpg" height=271px; width=25%;></span>

  <span class="motivacija"><img src="motivacija.jpg" height=271px; width=25%;></span>

  <span class="zdravlje"><img src="zdravlje.jpg" height=271px; width=24%;></span>
</div>



<div>
  <footer class="bg-primary">
    <p><span class="vreme">Trenutni datum i vreme :</span> <?php  $date = date('m/d/Y h:i:s a', time()); echo "<br> <span style = 'color: gold;'>$date</span>"; ?></p>
  </footer>
</div>

</body>
</html>