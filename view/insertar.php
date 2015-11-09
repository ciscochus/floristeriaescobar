<?php
//require
require_once '../core/Conectar.php';
require_once("../controller/UsuariosController.php");
// Configura los datos de tu cuenta
$conectar=new Conectar();
$con = $conectar->conexion();



if(isset($_POST['submitLogin'])){

	if(isset($_POST["user"])){
		//si existe el parametro user
		$user = mysqli_real_escape_string($con,$_POST['user']);

		if(isset($_POST["pass"])){
			//si existe el parametro pass
			$password = md5(mysqli_real_escape_string($con,$_POST['pass']));

			$consulta = "SELECT * FROM usuarios WHERE username='" . $user . "' AND password='" . $password . "'";
			$salida = mysqli_query($con, $consulta);

			if(mysqli_num_rows($salida)==1){
				$_SESSION['usuario'] = $user;
				echo "true";
			}
		}
		else {
			//si no existe el parametro pass
			header("Location: ../index.php?nopass");
			exit();
		}
	}
	else {
		//si no existe el paramentro user
		header("Location: ../index.php?nouser=" + $_POST['user']);
		exit();
	}
}

?>
