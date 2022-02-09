<?php
include_once "Conexion.php";

class Usuario
{
    var $datos;

    public function __construct()
    {
        // se va a conectar a la base de datos
        $db = new Conexion(); // $db ya no es una variable es un objeto
        $this->conexion = $db->pdo;
        // $this hace referencia al objeto que se crea en una instancia de clase
    }

    function Loguearse($dni, $password)
    {
        $sql = "SELECT * FROM usuario WHERE dni_usuario=:dni and password=:password";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(':dni' => $dni, ':password' => $password));
        $this->datos = $query->fetchAll(); // retorna objetos o no
        return $this->datos;
    }
    function Registrarse($nombre, $cedula, $celular, $email, $password, $us_tipo)
    {
        // Reviso si ya existe un usuario con las mismas credenciales
        $sql = "SELECT * FROM usuario WHERE correo=:email AND password=:password";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(':email' => $email, ':password' => $password));
        $this->datos = $query->fetchAll(); // retorna objetos o no
        if (!empty($this->datos)) {
            return "user no add";
        } else {
            // En caso contrario agrego al usuario
            $sql = "INSERT INTO usuario(nombre, cedula, celular, correo, password, us_tipo) VALUES (:nombre, :cedula, :celular, :email, :password, :us_tipo)";
            $query = $this->conexion->prepare($sql);
            $query->execute(array(':nombre' => $nombre, ':cedula' => $cedula, ':celular' => $celular, ':email' => $email, ':password' => $password, ':us_tipo' => $us_tipo));
            return "user add";
        }
    }
    function obtener_datos_usuario($id_usuario)
    {
        $sql = "SELECT U.id_usuario, U.nombre, U.apellido, U.dni_usuario, UT.nombre as tipo_usuario FROM usuario as U inner join tipo_usuario as UT on U.us_tipo=UT.id_tipo_usuario WHERE U.id_usuario=:id_usuario";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(':id_usuario' => $id_usuario));
        $this->datos = $query->fetchAll(); // retorna objetos o no
        return $this->datos;
    }
    function actualizar_usuario($id_usuario, $nombres, $cedula, $celular)
    {
        $sql = "UPDATE usuario SET nombre=:name_user, cedula=:cedula_user, celular=:phone_user WHERE id_usuario=:id_user";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(':name_user' => $nombres, ':cedula_user' => $cedula, ':phone_user' => $celular, ':id_user' => $id_usuario));
        echo "actualizacion_exitosa";
    }
    function actualizar_admin($id_usuario, $nombres, $email, $password)
    {
        $sql = "UPDATE usuario SET nombre=:name_user, correo=:email_user, password=:password_user WHERE id_usuario=:id_user";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(':name_user' => $nombres, ':email_user' => $email, ':password_user' => $password, ':id_user' => $id_usuario));
        echo "actualizacion_exitosa";
    }
    // Obtener datos de quejas por usuario Logueado
    function obtener_datos_envios()
    {
        $sql = "SELECT RE.id_registro_envio, RE.remito, RE.fecha_manifiesto, RE.contenido, (SELECT nombre_sede FROM sedes WHERE id_sedes=RE.origen) as origen, (SELECT nombre_sede FROM sedes WHERE id_sedes=RE.destino) as destino FROM registro_envio as RE";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        $this->datos = $query->fetchAll(); // retorna objetos o no
        return $this->datos;
    }
    // Obtener datos de las sedes para el formulario de registro de envios
    function llenar_sedes()
    {
        $sql = "SELECT * FROM sedes";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        $this->datos = $query->fetchAll(); // retorna objetos o no
        return $this->datos;
    }
    // Obtener datos de los clientes para el formulario de registro de envios
    function llenar_clientes($tipo_documento, $documento)
    {
        $sql = "SELECT * FROM cliente WHERE tipo_documento=:tipo_documento and numero_documento=:numero_documento";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(':tipo_documento' => $tipo_documento, ':numero_documento' => $documento));
        $this->datos = $query->fetchAll(); // retorna objetos o no
        return $this->datos;
    }
    // buscar_cant_registros
    function buscar_cant_registros()
    {
        $sql = "SELECT * FROM registro_envio";
        $query = $this->conexion->query($sql);
        $cant = $query->rowCount();
        echo $cant + 1;
    }



    // Crear quejas
    function crear_envio($remito, $origen, $destino, $remitente, $consignado, $contenido, $peso, $piezas, $fecha)
    {
        $sql = "INSERT INTO registro_envio(remito, fecha_manifiesto, origen, destino, remitente, consignado, contenido, peso, piezas ) VALUES (:remito, :fecha_manifiesto, :origen, :destino, :remitente, :consignado, :contenido, :peso, :piezas)";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(':remito' => $remito, ':fecha_manifiesto' => $fecha, ':origen' => $origen, ':destino' => $destino, ':remitente' => $remitente, ':consignado' => $consignado, ':contenido' => $contenido, ':peso' => $peso, ':piezas' => $piezas));
        echo "envio_creado";
    }

    // Actualizar queja
    function actualizar_queja($id_queja, $tipo_queja, $descripcion, $direccion)
    {
        $sql = "UPDATE quejas SET id_tipo_quejas=:id_tipo_quejas, descripcion=:descripcion, direccion=:direccion WHERE id_quejas=:id_quejas";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(':id_tipo_quejas' => $tipo_queja, ':descripcion' => $descripcion, ':direccion' => $direccion, ':id_quejas' => $id_queja));
        echo "actualizacion_exitosa";
    }

    // GESTION POR PARTE DEL ADMINISTRADOR

    // Buscar quejas por correo en el admin
    function buscar_quejas_user_email($email)
    {
        $sql = "SELECT QJ.id_quejas, TQJ.nombre_tipo_queja as tipo_queja, QJ.descripcion, QJ.direccion, QJ.fecha FROM quejas as QJ inner join tipo_quejas as TQJ on QJ.id_tipo_quejas=TQJ.id_tipo_quejas inner join usuario as US on QJ.id_usuario=US.id_usuario WHERE US.correo=:email_user";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(':email_user' => $email));
        $this->datos = $query->fetchAll(); // retorna objetos o no
        return $this->datos;
    }
    // Buscar usuario por correo en el admin
    function buscar_user_email($email)
    {
        $sql = "SELECT * FROM usuario WHERE correo=:email_user";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(':email_user' => $email));
        $this->datos = $query->fetchAll(); // retorna objetos o no
        return $this->datos;
    }
    // Resetear clave de usuario por correo en el admin
    function reset_clave_user($password, $id_user_reset)
    {
        $sql = "UPDATE usuario SET password=:password WHERE id_usuario=:id_user_reset";
        $query = $this->conexion->prepare($sql);
        $query->execute(array(':password' => $password, ':id_user_reset' => $id_user_reset));
        echo "clave_actualizada";
    }
}
