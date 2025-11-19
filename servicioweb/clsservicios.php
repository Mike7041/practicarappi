<?php

// NOMBRE DE LA CLASE 
class clsServicios{

    // PROGRAMACIÓN DE MÉTODOS
    public function sp_Acceso($usu, $pwd){
    
        // Se estructura el comando SQL para ejecutar 
        $cmdSql = "call sp_Acceso('$usu','$pwd');";

        // -------------------------------------------------
        // Variable para recepción de estatus+datos
        $datos=array();
        
        if($conn = mysqli_connect("localhost", "root", "Vanhalen144.", "bd_prosoft") ){
            // Ejecución del comando SQL y recibir resultados (recordset)
            $renglon = mysqli_query($conn, $cmdSql);
            
            if (mysqli_num_rows($renglon) > 0) {
                // Ciclo para lectura de registros
                while($resultado = mysqli_fetch_assoc($renglon) ){
                    $datos[0]["BAN"] = $resultado["usu_ban"];
                    if($datos[0]["BAN"] == "1" ){
                        // El usuario existe en BD, extraer los demás datos
                        $datos[1]["CVE"] = $resultado["usu_cve_usuario"];
                        $datos[2]["NOM"] = $resultado["usu_nombre"];
                        $datos[3]["USU"] = $resultado["usu_usuario"];
                        $datos[4]["ROL"] = $resultado["rol_nombre"];
                    }
                }
            }
            else 
                $datos[0]["BAN"] = "0";        
            
            // Cerrar conexión
            mysqli_close($conn);
        }
        // Retornar el arreglo formateado y con los datos de resultado
        return $datos;

    }
    // -------------------------

    // VISTA vwRptArticulos - MODIFICADA PARA BD_CONTACTOS
    public function vwRptArticulos(){
        // Variable para recepción de estatus+datos
        $datos = array();

        // Se estructura el comando SQL para ejecutar usando las tablas reales
        $cmdSql = "SELECT 
                    p.PRO_ID as clave,
                    p.PRO_NOMBRE as nombre,
                    p.PRO_DESCRIPCION as descripcion,
                    p.PRO_CANTIDAD as existencias,
                    p.PRO_PRECIO as precio,
                    p.PRO_FOTO as foto,
                    'Standard' as modelo,
                    'Comida' as familia
                FROM PRODUCTO p
                WHERE p.PRO_ACTIVO = 1";

        $i = 0; // <------ variable para controlar los registros del arreglo

        if($conn = mysqli_connect("localhost", "root", "Vanhalen144.", "BD_CONTACTOS")){
            // Ejecución del comando SQL y recibir resultados (recordset)
            $renglon = mysqli_query($conn, $cmdSql);
            
            // Ciclo para lectura de registros
            while($resultado = mysqli_fetch_assoc($renglon)){
                // Vaciado de datos en el arreglo de salida                
                $datos[$i]["clave"] = $resultado["clave"];
                $datos[$i]["nombre"] = $resultado["nombre"];
                $datos[$i]["descripcion"] = $resultado["descripcion"];
                $datos[$i]["existencias"] = $resultado["existencias"];
                $datos[$i]["precio"] = $resultado["precio"];
                $datos[$i]["foto"] = $resultado["foto"];
                $datos[$i]["modelo"] = $resultado["modelo"];
                $datos[$i]["familia"] = $resultado["familia"];
                $i++;
            }
            // Cerrar conexión
            mysqli_close($conn);
        }
        // Retornar el arreglo formateado y con los datos de resultado
        return $datos;
    }
    

      public function vwRptUsuarios(){
        // Variable para recepción de estatus+datos
        $datos=array();

        // Se estructura el comando SQL para ejecutar 
        $cmdSql = "select * from vwRptUsuarios;";

        $i = 0; // <------ variable para controlar los registros del arreglo

        
        if($conn = mysqli_connect("localhost", "root", "Vanhalen144.", "bd_prosoft") ){
            // Ejecución del comando SQL y recibir resultados (recordset)
            $renglon = mysqli_query($conn, $cmdSql);
            
            // Ciclo para lectura de registros
            
            while($resultado = mysqli_fetch_assoc($renglon) ){
                // Vaciado de datos en el arreglo de salida                
                $datos[$i]["clave"] = $resultado["clave"];
                $datos[$i]["nombre"] = $resultado["nombre"];
                $datos[$i]["usuario"] = $resultado["usuario"];
                $datos[$i]["existencias"] = $resultado["existencias"];
                $datos[$i]["email"] = $resultado["email"];
                $datos[$i]["rol"] = $resultado["rol"];
                $i++;
            }
            // Cerrar conexión
            mysqli_close($conn);
        }
        // Retornar el arreglo formateado y con los datos de resultado
        return $datos;
    }
    
     public function sp_InsUsuario($nom,$pat,$mat,$tel,$mail,$usu, $pwd, $rol){
    
        // Se estructura el comando SQL para ejecutar 
        $cmdSql = "call sp_InsUsuario('$nom','$pat','$mat','$tel','$mail','$usu','$pwd', $rol);";

        // -------------------------------------------------
        // Variable para recepción de estatus+datos
        $datos=array();
        
        if($conn = mysqli_connect("localhost", "root", "Vanhalen144.", "bd_prosoft") ){
            // Ejecución del comando SQL y recibir resultados (recordset)
            $renglon = mysqli_query($conn, $cmdSql);
            
            if (mysqli_num_rows($renglon) > 0) {
                // Ciclo para lectura de registros
                while($resultado = mysqli_fetch_assoc($renglon) ){
                    $datos[0]["BAN"] = $resultado["usu_ban"];
                }
            }
            else 
                $datos[0]["BAN"] = "0";        
            
            // Cerrar conexión
            mysqli_close($conn);
        }
        // Retornar el arreglo formateado y con los datos de resultado
        return $datos;

    }

   public function sp_ElimUsuario($cve)
{
    $cmdSql = "CALL sp_ElimUsuario('$cve');";

    $datos = array();

    // Conexión
    $conn = mysqli_connect("localhost", "root", "Vanhalen144.", "bd_prosoft", 3306);

    if ($conn === false) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Ejecutar SP
    $renglon = mysqli_query($conn, $cmdSql);

    if ($renglon && mysqli_num_rows($renglon) > 0) {
        $resultado = mysqli_fetch_assoc($renglon);
        $datos[0]["BAN"] = $resultado["usu_ban"];
    } else {
        $datos[0]["BAN"] = "0";
    }

    mysqli_close($conn);

    return $datos;
}


public function sp_EditUsuario($id, $nom, $pat, $mat, $tel, $mail, $usu, $pwd, $rol)
{
    $cmdSql = "CALL sp_EditUsuario('$id', '$nom', '$pat', '$mat', '$tel', '$mail', '$usu', '$pwd', '$rol');";

    $datos = array();

    if ($conn = mysqli_connect("localhost", "root", "Vanhalen144.", "bd_prosoft", 3306)) {

        $renglon = mysqli_query($conn, $cmdSql);

        if (mysqli_num_rows($renglon) > 0) {
            while ($resultado = mysqli_fetch_assoc($renglon)) {
                $datos[0]["BAN"] = $resultado["usu_ban"];
            }
        } else {
            $datos[0]["BAN"] = "0";
        }

        mysqli_close($conn);
    } else {
        die("Error de conexión: " . mysqli_connect_error());
    }

    return $datos;
}

    public function obtenerProductoConVendedor($claveProducto) {
        $datos = array();
        
        // Usando el stored procedure
        $cmdSql = "CALL sp_MostrarProductos('$claveProducto')";
        
        if($conn = mysqli_connect("localhost", "root", "Vanhalen144.", "BD_CONTACTOS")) {
            $renglon = mysqli_query($conn, $cmdSql);
            
            if(mysqli_num_rows($renglon) > 0) {
                $datos = mysqli_fetch_assoc($renglon);
            }
            
            mysqli_close($conn);
        }
        
        return $datos;
    }

}

?>