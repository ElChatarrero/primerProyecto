<?php 

	class UsuariosModel extends Mysql
	{
		private $intIdUsuario;
		private $strNacionalidad;
		private $strCedula;
		private $strNombre;
		private $strApellido;
		private $intTelefono;
		private $strCorreo;
		private $strPassword;
		private $strToken;
		private $intTipoId;
		private $intStatus;

		public function __construct()
		{
			parent::__construct();
		}	

		//Funcion para Registrar Usuarios
			public function insertUsuario($nacionalidad, string $cedula, string $nombre, string $apellido, int $telefono, string $correo, string $password, int $tipoid, int $status){

					$this->strNacionalidad = $nacionalidad;
					$this->strCedula = $cedula;
					$this->strNombre = $nombre;
					$this->strApellido = $apellido;
					$this->intTelefono = $telefono;
					$this->strCorreo = $correo;
					$this->strPassword = $password;
					$this->intTipoId = $tipoid;
					$this->intStatus = $status;
					$return = 0;

					$sql = "SELECT idpersona FROM persona WHERE correo = '{$this->strCorreo}' OR cedula = '{$this->strCedula}'";
					$request = $this->select_all($sql);

						if(empty($request)){
						$query_insert  = "INSERT INTO persona(nacionalidad,cedula,nombre,apellido,telefono,correo,password,rolid,status) VALUES(?,?,?,?,?,?,?,?,?)";
				        $arrData = array($this->strNacionalidad, $this->strCedula, $this->strNombre, $this->strApellido, $this->intTelefono, $this->strCorreo, $this->strPassword, $this->intTipoId, $this->intStatus);
				        $request_insert = $this->insert($query_insert,$arrData);
				        $return = $request_insert;
					}else{
					$return = "exist";
				}
				return $return;
		}

		//Funcion para Traer los datos de los usuarios
		public function selectUsuarios()
		{
			$whereAdmin = "";
			if($_SESSION['idUser'] != 1){
				$whereAdmin = " and p.idpersona != 1";
			}


			$sql = "SELECT p.nacionalidad, p.idpersona,p.cedula,p.nombre,p.apellido,p.telefono,p.correo,p.status,r.idrol,r.nombrerol
					FROM persona p 
					INNER JOIN rol r
					ON p.rolid = r.idrol
					WHERE p.status != 0 ".$whereAdmin;
					$request = $this->select_all($sql);
					return $request;
		}

		// Para traer los datos de 1 usuario
		public function selectUsuario(int $idpersona){
			$this->intIdUsuario = $idpersona;
			$sql = "SELECT p.idpersona,p.nacionalidad,p.cedula,p.nombre,p.apellido,p.telefono,p.correo,r.idrol,r.nombrerol,p.status, DATE_FORMAT(p.datecreated, '%d-%m-%Y') as fechaRegistro 
					FROM persona p
					INNER JOIN rol r
					ON p.rolid = r.idrol
					WHERE p.idpersona = $this->intIdUsuario";
			$request = $this->select($sql);
			return $request;
		}

		public function updateUsuario(int $idUsuario, $nacionalidad, string $cedula, string $nombre, string $apellido, int $telefono, string $correo, string $password, int $tipoid, int $status){

			$this->intIdUsuario = $idUsuario;
			$this->strNacionalidad = $nacionalidad;
			$this->strCedula = $cedula;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strCorreo = $correo;
			$this->strPassword = $password;
			$this->intTipoId = $tipoid;
			$this->intStatus = $status;

			$sql = "SELECT * FROM persona WHERE (correo = '{$this->strCorreo}' AND idpersona != $this->intIdUsuario)
										  OR (cedula = '{$this->strCedula}' AND idpersona != $this->intIdUsuario) ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				if($this->strPassword  != "")
				{
					$sql = "UPDATE persona SET nacionalidad = ?, cedula=?, nombre=?, apellido=?, telefono=?, correo=?, password=?, rolid=?, status=? 
							WHERE idpersona = $this->intIdUsuario ";
					$arrData = array($this->strNacionalidad,
						$this->strCedula,
	        						$this->strNombre,
	        						$this->strApellido,
	        						$this->intTelefono,
	        						$this->strCorreo,
	        						$this->strPassword,
	        						$this->intTipoId,
	        						$this->intStatus);
				}else{
					$sql = "UPDATE persona SET nacionalidad=?, cedula=?, nombre=?, apellido=?, telefono=?, correo=?, rolid=?, status=? 
							WHERE idpersona = $this->intIdUsuario ";
					$arrData = array($this->strNacionalidad,
						$this->strCedula,
	        						$this->strNombre,
	        						$this->strApellido,
	        						$this->intTelefono,
	        						$this->strCorreo,
	        						$this->intTipoId,
	        						$this->intStatus);
				}
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
			return $request;
		}
		
		public function deleteUsuario(int $intIdpersona)
		{
			$this->intIdUsuario = $intIdpersona;
			$sql = "UPDATE persona SET status = ? WHERE idpersona = $this->intIdUsuario ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function updatePerfil(int $idUsuario, string $nacionalidad, string $cedula, string $nombre, string $apellido, int $telefono, string $password){

			$this->intIdUsuario = $idUsuario;
			$this->strNacionalidad = $nacionalidad;
			$this->strCedula = $cedula;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strPassword = $password;

			if($this->strPassword != ""){
				$sql = "UPDATE persona SET nacionalidad = ?, cedula = ?, nombre = ?, apellido = ?, telefono = ?, password = ? WHERE idpersona = $this->intIdUsuario ";
				$arrData = array($this->strNacionalidad, $this->strCedula, $this->strNombre, $this->strApellido, $this->intTelefono, $this->strPassword);
			}else{
				$sql = "UPDATE persona SET nacionalidad = ?, cedula = ?, nombre = ?, apellido = ?, telefono = ? WHERE idpersona = $this->intIdUsuario ";
				$arrData = array($this->strNacionalidad, $this->strCedula, $this->strNombre, $this->strApellido, $this->intTelefono);
			}
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function existePersona($nacionalidad, $cedula){

			$this->strNacionalidad = $nacionalidad;
			$this->strCedula = $cedula;

		$sql = "SELECT count(*) as cantidad FROM persona WHERE nacionalidad='$this->strNacionalidad' and cedula=$this->strCedula";
		$request = $this->select($sql);
		$cantidad = $request['cantidad'];
		return $cantidad;
		}

		public function existeCorreo($correo){

			$this->strCorreo = $correo;

		$sql = "SELECT count(*) as cantidad FROM persona WHERE correo='$this->strCorreo'";
		$request = $this->select($sql);
		$cantidad = $request['cantidad'];
		return $cantidad;
		}
	}
 ?>