<?php

define("CLIENT_ID", "AR6KiHAiLXm1JEzbMtaIl6PJHOgFCTw9HIWWbSP-gXOGa-6zvfYTPRYOLTAS3Oy1mXK1nkRpPx1BdjuR");
define("CURRENCY", "MXN");
define("KEY_TOKEN", "ABC");
define("MONEDA", "$");

session_start();

$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}
?>