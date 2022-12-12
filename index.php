<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./css/style.css"/>
</head>
<body>
    
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light py-3p">
  <div class="container">
    <img src="./img/logo.png" width="70" height="70"/>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link" href="#">Inicio</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Shop</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Blog</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Contacto</a>
        </li>

        <li class="nav-item">
          <i class="fas fa-shopping-cart"></i>
          <i class="fas fa-user"></i>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Buscar productos" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>

<!-- Home -->
<section id="inicio">
  <div>
    <h5>Prepárate para el invierno</h5>
    <h1>Los mejores precios por tiempo limitado</h1>
    <p>Las ofertas e-shop incluyen una gran cantidad de productos a precios increibles</p>
    <button>Comprar ahora</button>
  </div>
</section>

<!--Brand-->
<br>
 <section id="marca" class="container">
  <div class=" row">
    <img class=" img-fluid col-lg-3 col-md-6 col-sm-12" src="./img/xboxps.jpg"/>
    <img class=" img-fluid col-lg-3 col-md-6 col-sm-12" src="./img/lego.jpg"/>
    <img class=" img-fluid col-lg-3 col-md-6 col-sm-12" src="./img/supreme.jpg"/>
    <img class=" img-fluid col-lg-3 col-md-6 col-sm-12" src="./img/adidas.jpg"/>
  </div>
 </section>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>