<?php

// ######### HACE USO DEL SERVICIO WEB ########
$cliente = new SoapClient(null, array(
    'uri' => 'http://localhost/',
    'location' => 'http://localhost:8080/programacionweb/1erseg/Rappi/servicioweb/servicioweb.php'
));

// Obtener el ID del producto desde la URL
$producto_id = isset($_GET['clave']) ? intval($_GET['clave']) : 0;

// SE EJECUTA EL MÉTODO DEL SERVICIO WEB CON EL STORED PROCEDURE
try {
    $producto = $cliente->obtenerProductoConVendedor($producto_id);
} catch (Exception $e) {
    die("Error al obtener el producto: " . $e->getMessage());
}

if(empty($producto)) {
    die("Producto no encontrado");
}
?>

<html>
<head>

</head>
<body>
    <div class="product-header">
        <div class="container">
            <h1><?php echo $producto['PRODUCTO']; ?></h1>
        </div>
    </div>

    <div class="container">
        <img src="<?php echo $producto['FOTO_PRO']; ?>" class="product-image" alt="<?php echo $producto['PRODUCTO']; ?>">

        <div class="price-section">
            <div class="price">$<?php echo $producto['COSTO']; ?> MXN</div>
        </div>

        <div class="description-section">
            <h4>Descripción:</h4>
            <p><strong><?php echo $producto['DESCRIPCION']; ?></strong></p>
        </div>

        <div class="divider"></div>

        <div class="whatsapp-section">
            <h3>📱 Enviar mensaje al vendedor</h3>
            
            <div class="vendedor-info">
                <h5>Detalles del vendedor</h5>
                <p><strong>Nickname:</strong> "<?php echo $producto['ALIAS']; ?>"</p>
                <p><strong>Nombre:</strong> <?php echo $producto['USUARIO']; ?></p>
                <p><strong>Contacto:</strong> <?php echo $producto['TELEFONO']; ?></p>
            </div>

            <?php
            $mensaje = "Hola, me interesa el producto: " . $producto['PRODUCTO'] . " - $" . $producto['COSTO'];
            //$whatsapp_url = "https://wa.me/52" . $producto['TELEFONO'] . "?text=" . urlencode($mensaje);
            ?>
            <a href="<?php echo $whatsapp_url; ?>" target="_blank" class="whatsapp-btn">
                <i class="bi bi-whatsapp"></i> Contactar por WhatsApp
            </a>
        </div>

        <div class="text-center">
            <a href="?op=rptarticulos" class="back-btn">
                <i class="bi bi-arrow-left"></i> Seleccionar otro producto
            </a>
        </div>
    </div>
</body>
</html>