<?php
// Inicializar variables
$mensaje = "";
$tipoMensaje = "";

// Procesar el formulario cuando se envía
if(isset($_POST['btnGuardar'])){
    try {
        // Capturar los datos del formulario
        $clave = trim($_POST['txtClave']);
        $nombre = trim($_POST['txtNombre']);
        $apePat = trim($_POST['txtApePat']);
        $apeMat = trim($_POST['txtApeMat']);
        $telefono = trim($_POST['txtTelefono']);
        $correo = trim($_POST['txtCorreo']);
        $usuario = trim($_POST['txtUsuario']);
        $pwd = trim($_POST['txtPwd']);
        $rol = $_POST['selRol'];
        
        // Validar que los campos no estén vacíos
        if(empty($clave) || empty($nombre) || empty($apePat) || empty($usuario) || empty($pwd)){
            $mensaje = "Error: Todos los campos obligatorios deben ser llenados (Clave, Nombre, Apellido Paterno, Usuario y Contraseña)";
            $tipoMensaje = "danger";
        } else {
            // Conectar al servicio web SOAP
            $cliente = new SoapClient(null, array(
                'uri' => 'http://localhost/',
                'location' => 'http://localhost:8080/programacionweb/1erseg/practica5/servicioweb/servicioweb.php'
            ));
            
            // Llamar al método sp_InsUsuario del servicio web
            // Parámetros: $nom, $pat, $mat, $tel, $mail, $usu, $pwd, $rol
            $resultado = $cliente->sp_InsUsuario(
                $nombre,
                $apePat,
                $apeMat,
                $telefono,
                $correo,
                $usuario,
                $pwd,
                $rol
            );
            
            // Verificar el resultado (BAN = 1 significa éxito)
            if(isset($resultado[0]["BAN"]) && $resultado[0]["BAN"] == "1"){
                $mensaje = "Usuario registrado exitosamente";
                $tipoMensaje = "success";
                
                // Limpiar el formulario después de un registro exitoso
                $_POST = array();
                $clave = $nombre = $apePat = $apeMat = $telefono = $correo = $usuario = $pwd = '';
                $rol = '1';
            } else {
                $mensaje = "Error al registrar el usuario. Verifique que el usuario no esté duplicado.";
                $tipoMensaje = "danger";
            }
        }
        
    } catch(SoapFault $e){
        $mensaje = "Error de conexión con el servicio web: " . $e->getMessage();
        $tipoMensaje = "danger";
    } catch(Exception $e){
        $mensaje = "Error: " . $e->getMessage();
        $tipoMensaje = "danger";
    }
}

// Mantener los valores del formulario en caso de error
if(!isset($clave)) $clave = isset($_POST['txtClave']) ? $_POST['txtClave'] : '';
if(!isset($nombre)) $nombre = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : '';
if(!isset($apePat)) $apePat = isset($_POST['txtApePat']) ? $_POST['txtApePat'] : '';
if(!isset($apeMat)) $apeMat = isset($_POST['txtApeMat']) ? $_POST['txtApeMat'] : '';
if(!isset($telefono)) $telefono = isset($_POST['txtTelefono']) ? $_POST['txtTelefono'] : '';
if(!isset($correo)) $correo = isset($_POST['txtCorreo']) ? $_POST['txtCorreo'] : '';
if(!isset($usuario)) $usuario = isset($_POST['txtUsuario']) ? $_POST['txtUsuario'] : '';
if(!isset($pwd)) $pwd = '';
if(!isset($rol)) $rol = isset($_POST['selRol']) ? $_POST['selRol'] : '1';
?>

<!DOCTYPE html>
<html>
<head>
    <!--meta name=viewport content="witdh=device-witdh, initial-scale=1, maximum-scale=1, height=device-height, user-scale=true" -->
	<title>Administrador - Registro/Modificación</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body >
<form method="POST" name="frmRegistrar">    
    <center>
       
            <div id="container" class="container">
                <h2>Registro de Usuarios</h2>
                    <br>
                    <div class='row justify-content-center'>
                     <div class="columna col-2">Clave: </div>
			         <div class="columna col-4">
                        <input type="text" class="form-control"  name='txtClave' placeholder="Clave ..." value="">
                     </div>    
                    </div>
                    
                    <div class='row justify-content-center'>
                     <div class="columna col-2">Nombre: </div>
			         <div class="columna col-4">
                        <input type="text" class="form-control"  name='txtNombre' placeholder="Nombre(s)" value="">
                     </div>    
                    </div>
                    <div class='row justify-content-center' >
                        <div class="columna col-2">Apellido Paterno: </div>
                        <div class="columna col-4">
                        <input type="text" class="form-control"  name='txtApePat' placeholder="Apellido paterno" value="">
                        </div>
                    </div>
                    <div class='row justify-content-center'>
                         <div class="columna col-2">Apellido Materno: </div>
                        <div class="columna col-4">
                            <input type="text" class="form-control"  name='txtApeMat' placeholder="Apellido materno" value="">
                        </div>
                    </div>
                    <div class='row justify-content-center'>
                     <div class="columna col-2">Teléfono: </div>
			         <div class="columna col-4">
                        <input type="text" class="form-control"  name='txtTelefono' placeholder="Teléfono" value="">
                     </div>    
                    </div>   
                    <div class='row justify-content-center'>
                     <div class="columna col-2">Correo: </div>
			         <div class="columna col-4">
                        <input type="text" class="form-control"  name='txtCorreo' placeholder="Correo" value="">
                     </div>    
                    </div>                    

                    <div class='row justify-content-center'>
                         <div class="columna col-2">Usuario: </div>
                       <div class="columna col-4">
                        <input type="text" class="form-control"  name='txtUsuario' placeholder="Usuario" value="">
                       </div>
                    </div>
                    

                    <div class='row justify-content-center'>
                         <div class="columna col-2">Contraseña: </div>
                      <div class="columna col-4">
                        <input type="text" class="form-control"  name='txtPwd' placeholder="Contraseña" value="">
                      </div>
                    </div>
                    
                    <div class='row justify-content-center'>
                     <div class="columna col-2">Rol: </div>
			         <div class="columna col-4">
                        <select id="selRol" name="selRol">
                            <option value="1">Administrador</option>
                            <option value="2">Ventas</option>
                            <option value="3">Compras</option>
                            <option value="4">Cliente</option>
                        </select>
                     </div>    
                    </div>
                    <br>
                    <input type="reset" name="btnLimpiar" class="btn btn-warning" value="Limpiar">
                    <input type="submit" name="btnGuardar" class="btn btn-primary" value="Registrar">
                    
                    <a href="?op=rptusuarios" class='btn btn-success'>Regresar</a>
                    <br /><br />
            </div>
        
    </center>
   	<script language="javascript" src="bootstrap/css/jquery-1.3.2.min.js" />
</form>
</body>
</html>