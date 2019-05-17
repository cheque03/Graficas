<?php 

/**
 * 
 */
class RanndomTable
{
	public $IDr = 0;

	//funcion que crea y devuelve un objeto de conexion a la base de datos y chequea el estado de la misma

	public function conectarBD()
	{
		$server = "localhost";
		$usuario = "";
		$pass = "";
		$BD = "bd_test";

		//variable que guarda la conexion de la base de datos
		$conexion = mysqli_connect($server, $usuario, $pass, $BD);
		//comprobamos si la conexion ha tenido exito
		if (!$conexion){
			echo "Ha sucedido un error en la conexion de la BD";
		}
		//debolvemos el obejeto de conexion para usarlo en las consultas
		return $conexion;
	}

	//Cerrar la conexion de la base de datos
	function desconectarBD($conexion){
		//cierra la conexion y guarda el estado de la operacion eun una variable
		$close = mysqli_close($conexion);
		//comprobamos si se ha cerrado la conexion correctamente
		if (!$close) {
			echo "Ha sucedido un error inesperado en la desconexion de la BD";
		}
		//devuelve el estado del cierre de conexion
		return $close;
	}

	//devuelve un array multidimensional con el resultado de la consulta
	function getArraySQL($sql){
		//creamos la conexion
		$conexion = $this->conectarBD();

		//generamos la consulta 
		if (!$result = mysqli_query($conexion, $sql)) die();

		$rawdata = array();
		//guardamos en un array multidimensional todos los datos de la consulta
		$i=0;
		while ($row = mysqli_fetch_array($result)) {
			
			//guardamos en rawdata todos los vectores/filas que nos devuelve la consulta
			$rawdata[$i] = $row;
			$i++;
		}

		//cerramos la base de datos
		$this->desconectarBD($conexion);
		//devolvemos rawdata
		return $rawdata;
	}

	//inserta en la bases un nuevo registro en la tabla usuarios
	function insertRandom(){
		//generamos un numero entero aleatorio entre 0 y 100
		$ran = rand(0,20);
		//creamos la conexion
		$conexion = $this->conectarBD();
		//escribimos la sentencia sql necesaria respentado los tipos de datos
		$sql = "insert into random (valor) values (".$ran.")";
		//hacemos la consulta y la comprobamos
		$consulta = mysqli_query($conexion,$sql);
		if (!$consulta) {
			echo "No se ha podido issertar en la base de datos". mysqli_error($conexion);
		}
		//desconnectamos la base de datos.
		$this->desconectarBD($conexion);
		//devolvemos el resultado de la consulta
		return $consulta;
	}

	function getAllinfo(){
		//creamos la consulta
		$sql = "SELECT * FROM random;";
		//obtenemos el array con toda la informacion
		return $this->getArraySQL($sql);
	}

}


?>
