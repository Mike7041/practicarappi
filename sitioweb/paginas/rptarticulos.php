<?php
$totalProductos = 0;
// ######### HACE USO DEL SERVICIO WEB QUE ESTA PUBLICADO DE MANERA LOCAL ########		 
$cliente = new SoapClient(null, array(
    'uri' => 'http://localhost/',
    'location' => 'http://localhost:8080/programacionweb/1erseg/Rappi/servicioweb/servicioweb.php'
));

// SE EJECUTA UN MÉTODO DEL SERVICIO WEB, PASANDO SUS PARAMETROS
$consulta = $cliente->vwRptArticulos();
?>

<html>
<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .rappi-header {
            background: linear-gradient(135deg, #FF2E63, #FF8A00);
            color: white;
            padding: 15px 0;
            margin-bottom: 20px;
        }
        .date-section {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 10px;
            margin: 10px 0;
        }
        .product-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            background: white;
            transition: transform 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-3px);
        }
        .product-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 15px 15px 0 0;
        }
        .product-info {
            padding: 15px;
        }
        .product-name {
            font-size: 1.1rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        .product-price {
            font-size: 1.3rem;
            font-weight: bold;
            color: #28a745;
        }
        .section-title {
            font-weight: bold;
            margin: 20px 0;
            color: #333;
            border-left: 4px solid #FF2E63;
            padding-left: 10px;
        }
        .user-info {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .back-btn {
            background: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            text-decoration: none;
            display: inline-block;
        }
        .back-btn:hover {
            color: white;
            background: #5a6268;
        }
    </style>
</head>
<body>

    <div class="rappi-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6">
                    <h3 class="mb-0"><strong>Rappi</strong></h3>
                    <small>Rappi Pachuca</small>
                </div>
                <div class="col-6 text-end">
                    <i class="bi bi-person-circle fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Fecha y usuario -->
        <div class="date-section">
            <div class="row">
                <div class="col-6">
                    <strong>Fecha:</strong> <?php echo date('d/m/Y'); ?>
                </div>
                <div class="col-6 text-end">
                    <strong>Usuario:</strong> 
                    <?php 
                    // Aquí iría el nombre del usuario logueado
                    echo isset($_SESSION['nomUsuario']) ? $_SESSION['nomUsuario'] : 'Invitado';
                    ?>
                </div>
            </div>
        </div>

        <h4 class="section-title">Productos Disponibles</h4>

        <div class="row">
            <?php 
            foreach($consulta as $producto){
            echo '
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="product-card">
                    <a href="?op=detalle_producto&clave='.$producto['clave'].'" style="text-decoration: none; color: inherit;">
                        <img src="'.$producto['foto'].'" class="product-image" alt="'.$producto['nombre'].'">
                        <div class="product-info">
                            <div class="product-name">'.$producto['nombre'].'</div>
                            <div class="product-price">$'.$producto['precio'].'</div>
                        </div>
                    </a>
                </div>
            </div>';
            }
            ?>
        </div>

        <!-- Botón regresar -->
        <div class="text-center mt-4">
            <a href="?op=bienvenida" class="back-btn">
                <i class="bi bi-arrow-left"></i> Regresar al Inicio
            </a>
        </div>
    </div>
</body>
</html>