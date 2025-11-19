<?php
if (!isset($_SESSION['cveUsuario'])){
  echo "<script language = 'javascript'> alert('Acceso Denegado, debes de iniciar sesion ...'); </script>";
  echo "<script language = 'javascript'> document.location.href='inicio.php?op=acceso'; </script>";
}
$totalProductos=0;
   //######### HACE USO DEL SERVICIO WEB QUE ESTA PUBLICADO DE MANERA LOCAL ########		 
     //######### HACE USO DEL SERVICIO WEB QUE ESTA PUBLICADO DE MANERA LOCAL ########		 
      $cliente=new SoapClient(null, array('uri'=>'http://localhost/',
	  					'location'=>'http://localhost:8080/programacionweb/1erseg/practica5/servicioweb/servicioweb.php'));	
	  					//'location'=>'http://34.232.76.225/practica5/servicioweb/servicioweb.php'));	
	  
	  //SE EJECUTA UN MÉTODO DEL SERVICIO WEB, PASANDO SUS PARAMETROS
	  $datos=$cliente->vwRptUsuarios();
      
?>

<!DOCTYPE HTML>
<html>
     <head>
         	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
     </head>
<body >
<form id="frmConexion" name="frmConexion" method="POST">
<div class="container">
  <table width="70%" align="center">
		<tr>			
			<td align="center" colspan="6">
			  <hr color="#800080"/>
			  <h1>Usuarios Registrados</h1>
			  <br />
			</td>			
		</tr>
		        
<!--crear las columnas de la tabla-->
  <tr>
    <td class="bg-secondary text-white" align="left"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
    <td class="bg-secondary text-white" align="left"><b>Clave</b></td>
    <td class="bg-secondary text-white" align="left"><b>Nombre del Usuario</b></td>
    <td class="bg-secondary text-white" align="left"><b>Usuario</b></td>
    <td class="bg-secondary text-white" align="left"><b>E-mail</b></td>
    <td class="bg-secondary text-white" align="left"><b>Rol</b></td>  
  </tr>

<?php 
          
	for($rr=0;$rr<count($datos);$rr++){	
		echo "<tr>";
		
    echo "<td bg-primary>";
    echo "   <a href='?op=editusuario&ne=".$datos[$rr]["clave"]."' class='btn btn-warning' isActive('rptusuarios.php',$current) title='Editar' >Editar<i class='fa fa-pencil-square-o'></i></a>";
    echo "   <a href='?op=delusuario&ne=".$datos[$rr]["clave"]."' class='btn btn-danger' title='Eliminar' >Eliminar <i class='fa fa-times-circle'></i></a>";
    echo "</td>";   
        
    echo "<td><font class='Etiquetas2'>".$datos[$rr]["clave"]."</td>";
		echo "<td><font class='Etiquetas2'>".$datos[$rr]["nombre"]."</td>";
    echo "<td><font class='Etiquetas2'>".$datos[$rr]["usuario"]."</td>";
    echo "<td><font class='Etiquetas2'>".$datos[$rr]["email"]."</td>";
		echo "<td><font class='Etiquetas2'>".$datos[$rr]["rol"]."</td>";
		echo "</tr>";
  }      

?>
 
 </table>
 <br />
 <br />
 
 <center> 
 <a href='?op=insusuarios' class='btn btn-primary <?= isActive('rptusuarios.php',$current) ?>'> Registrar Usuario</a>	
 
 <hr color="#800080" width="600px" />
 </center>


<br />
</div>
</form>
</body>
</html>
