<?php
  require 'config/config.php';
  require 'config/database.php';
  $db = new Database();
  $con = $db->conectar();

  $sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo=1");
  $sql->execute();
  $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

  //session_destroy();

?>

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
    <a href="index.php">
    <img src="./img/logo.png" width="70" height="70"/></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link" href="index.php">Inicio</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Contacto</a>
        </li>

        <li class="nav-item">
        <a href="checkout.php" style="color: green; padding: 0 20px" class="fas fa-shopping-cart"><span id="num_cart" class="badge bg-danger"> <?php echo $num_cart; ?> </span></a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Buscar productos" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>

<!-- Inicio -->
<section id="inicio">
  <div>
    <h5>Prep??rate para el invierno</h5>
    <h1>Los mejores precios por tiempo limitado</h1>
    <p>Las ofertas e-shop incluyen una gran cantidad de productos a precios increibles.</p>
  </div>
</section>

<!-- Marcas -->
<br>
 <section id="marca" class="container">
  <div class=" row">
    <img class=" img-fluid col-lg-3 col-md-6 col-sm-12" src="./img/xboxps.jpg"/>
    <img class=" img-fluid col-lg-3 col-md-6 col-sm-12" src="./img/lego.jpg"/>
    <img class=" img-fluid col-lg-3 col-md-6 col-sm-12" src="./img/supreme.jpg"/>
    <img class=" img-fluid col-lg-3 col-md-6 col-sm-12" src="./img/adidas.jpg"/>
  </div>
 </section>

 <!-- Productos -->
<br>
<main>
  <div class="container">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-md-4 row-cols-md-5 g-3">
      <?php foreach($resultado as $row) { ?>
      <div class="col">
      <div class="card shadow-sm">
          <?php
            $id = $row['id'];
            $imagen = "img/productos/" . $id . "/principal.jpg";

            if(!file_exists($imagen)){
              $imagen = "img/no-photo.jpg";
            }
          ?>
        <img src="<?php echo $imagen; ?>" height="280" width="500" class="d-block w-100">
        <div class="card-body" >
          <h5 class="card-title"><?php echo $row['nombre']; ?></h5>
          <p class="card-text">$ <?php echo number_format($row['precio'], 2, '.', ','); ?></p> 
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <a href="details.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>" class="btn btn-warning">Detalles</a>
            </div>
            <button class="btn btn-success" type="button" onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>')"> Agregar </button>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
  function addProducto(id, token){
    let url='clases/carrito.php'
    let formData = new FormData()
    formData.append('id', id)
    formData.append('token', token)

    fetch(url, {
      method: 'POST',
      body: formData,
      mode: 'cors'
    }).then(response => response.json())
    .then(data => {
      if(data.ok){
        let elemento = document.getElementById("num_cart")
        elemento.innerHTML = data.numero
      }
    })
  }
</script>

<footer>Creado por lobo solitario - Luis Ugarte</footer>

</body>
</html>