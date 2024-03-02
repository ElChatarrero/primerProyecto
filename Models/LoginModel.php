<?php 

	class LoginModel extends Mysql
	{
		private $intIdUsuario;
		private $strUsuario;
		private $strPassword;
		private $strToken;

		public function __construct()
		{
			parent::__construct();
		}

		public function loginUser(string $usuario, string $password){

			$this->strUsuario = $usuario;
			$this->strPassword = $password;
		    $sql = "SELECT idpersona, status FROM persona WHERE 
			        correo = '$this->strUsuario' and 
			        password = '$this->strPassword' and 
			        status != 0";
			$request = $this->select($sql);
			return $request;        
		}

		public function sessionLogin(int $idUser){

			$this->intIdUsuario = $idUser;

			//Burcar Rol
			$sql = "SELECT p.idpersona, p.nacionalidad, p.cedula, p.nombre,
			p.apellido, p.telefono, p.correo, r.idrol, r.nombrerol, p.status FROM persona p INNER JOIN rol r ON p.rolid = r.idrol WHERE p.idpersona = $this->intIdUsuario";
			$request = $this->select($sql);
			$_SESSION['userData'] = $request;
			return $request;
		}	

		public function getUserCorreo(string $strCorreo){

			$this->strUsuario =  $strCorreo;
			$sql = "SELECT idpersona, nombre, apellido, status FROM persona WHERE correo = '$this->strUsuario' and status = 1";
			$request = $this->select($sql);
			return $request;
		}

		public function setTokenUser(int $idpersona, string $token){

			$this->intIdUsuario = $idpersona;
			$this->strToken = $token;
			$sql = "UPDATE persona SET token = ? WHERE idpersona = $this->intIdUsuario";
			$arrData = array($this->strToken);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function getUsuario(string $correo, string $token){

			$this->strUsuario = $correo;
			$this->strToken = $token;
			$sql = "SELECT idpersona FROM persona WHERE correo = '$this->strUsuario' and token = '$this->strToken' and status = 1 ";
			$request = $this->select($sql);
			return $request;
		}

		public function insertPassword(int $idpersona, string $password){

			$this->intIdUsuario = $idpersona;
			$this->strPassword = $password;
			$sql = "UPDATE persona SET password = ?, token = ? WHERE idpersona = $this->intIdUsuario ";
			$arrData = array($this->strPassword,"");
			$request = $this->update($sql,$arrData);
			return $request;
		}
	}
 ?>