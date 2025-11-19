<?php
    $nom = "";
    $ap = "";
    $am = "";
    $tel = "";
    $mail = "";  
    $usu = "";
    $pas = "";
    $rol = "";

    $datos = "";
    
     //######### HACE USO DEL SERVICIO WEB QUE ESTA PUBLICADO DE MANERA LOCAL ########		 
    $cliente=new SoapClient(null, array('uri'=>'http://localhost/',
    'location'=>'http://localhost:8080/programacionweb/1erseg/practica5/servicioweb/servicioweb.php'));	

// -----------------------------------------------------------------------------------
// INSERCION DEL NUEVO USUARIO
    if(!empty($_POST["txtNombre"]) && !empty($_POST["txtApePat"]) && 
       !empty($_POST["txtApeMat"]) && !empty($_POST["txtTelefono"]) && 
       !empty($_POST["txtCorreo"]) && !empty($_POST["txtUsuario"]) && 
       !empty($_POST["txtPwd"]) && !empty($_POST["selRol"]) )
    {
        $nom = htmlspecialchars($_POST["txtNombre"]);
        $ap = htmlspecialchars($_POST["txtApePat"]);
        $am = htmlspecialchars($_POST["txtApeMat"]);
        $tel = htmlspecialchars($_POST["txtTelefono"]);
        $mail = htmlspecialchars($_POST["txtCorreo"]);   
        $usu = htmlspecialchars($_POST["txtUsuario"]);
        $pas = htmlspecialchars($_POST["txtPwd"]);
        $rol = htmlspecialchars($_POST["selRol"]);

        //SE EJECUTA UN MÉTODO DEL SERVICIO WEB, PASANDO SUS PARAMETROS
        $datos = $cliente->sp_editUsuario($_POST["txtClave"], $nom, $ap, $am, $tel, $mail, $usu, $pas, $rol);
        if((int)$datos[0]["BAN"] == 0)
            echo '<script language="javascript">alert("Usuario registrado correctamente.")</script>';
        if((int)$datos[0]["BAN"] == 1)
            echo '<script language="javascript">alert("Usuario no registrado, el nombre ya existe")</script>';
        if((int)$datos[0]["BAN"] == 2)
            echo '<script language="javascript">alert("Usuario no registrado, el usuario ya existe")</script>';
        if((int)$datos[0]["BAN"] == 3)
            echo '<script language="javascript">alert("Usuario no registrado, el rol no existe")</script>';                         
                   

    }
// -----------------------------------------------------------------------------------


    
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
                    <input type="submit" name="btnGuardar" class="btn btn-primary" value="Editar">
                    <a href="?op=rptusuarios" class='btn btn-success'>Regresar</a>
                    <br /><br />
            </div>
        
    </center>
   	<script language="javascript" src="bootstrap/css/jquery-1.3.2.min.js" />
</form>
</body>
</html>