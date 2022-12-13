<?php
  require 'config/config.php';
  require 'config/database.php';
  $db = new Database();
  $con = $db->conectar();

  $productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

  $lista_carrito = array();

  if($productos != null){
    foreach($productos as $clave => $cantidad){

        $sql = $con->prepare("SELECT id, nombre, precio, descuento, $cantidad AS cantidad FROM productos WHERE id=? AND activo=1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
    }
}

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
          <a class="nav-link" href="#">Contacto</a>
        </li>

        <li class="nav-item">
        <a style="color: green; padding: 0 20px" class="fas fa-shopping-cart" href="carrito.php"><span id="num_cart" class="badge bg-danger"> <?php echo $num_cart; ?> </span></a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Buscar productos" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>

 <!-- Productos -->
<br>
<main>
  <div class="container">
        <div class="table-response">
            <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if($lista_carrito == null){
                    echo '<tr><td colspan="5" class="text-center"<b>Lista vacía</b>></td></tr>';
                } else {

                    $total = 0;
                    foreach($lista_carrito as $producto){
                        $_id = $producto['id'];
                        $nombre = $producto['nombre'];
                        $precio = $producto['precio'];
                        $descuento = $producto['descuento'];
                        $cantidad = $producto['cantidad'];
                        $precio_desc = $precio - (($precio * $descuento) / 100);
                        $subtotal = $cantidad * $precio_desc;
                        $total += $subtotal;
                        ?>
            
                <tr>
                    <td><?php echo $nombre; ?></td>
                    <td><?php echo MONEDA . number_format($precio_desc,2, '.', ','); ?></td>
                    <td><input 
                        type="number" min="1" max="10" value="<?php echo $cantidad?>" size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizaCantidad(this.value, <?php echo $_id; ?>)">
                    </td>
                    <td>
                        <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal,2, '.', ',');  ?></div>
                    </td>
                    <td><a href="#" id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $_id; ?>" data-ds-toogle="modal" data-bs-target="eliminaModal">Eliminar</a></td>
                </tr>
                <?php } ?>

                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2">
                            <p class="h3" id="total"><?php echo MONEDA . number_format($total, 2, '.', ',');?></p>
                        </td>
                    </tr>

            </tbody>
            <?php } ?>
            </table>
        </div>

        <div class="row">
            <div class="col-md-5 offset-md-7 d-grid gap-2">
                <button class="btn btn-primary btn-lg">Realizar pago</button>
            </div>
        </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
  function actualizaCantidad(cantidad, id){
    let url = 'clases/actualizar_carrito.php'
    let formData = new FormData()
    formData.append('action', 'agregar')
    formData.append('id', id)
    formData.append('cantidad', cantidad)

    fetch(url, {
      method: 'POST',
      body: formData,
      mode: 'cors'
    }).then(response => response.json())
    .then(data => {
      if(data.ok){

        let divsubtotal = document.getElementById('subtotal_' + id)
        divsubtotal.innerHTML = data.sub

        let total = 0.00
        let list = document.getElementsByName('subtotal[]')

        for(let i = 0; i < list.length; i++){
            total += parseFloat(list[i].innerHTML.replace(/[$,]/g, ''))
        }

        total = new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2            
        }).format(total)
        document.getElementById('total').innerHTML = '<?php echo MONEDA; ?>' + total
      }
    })
  }
</script>

</body>
</html>