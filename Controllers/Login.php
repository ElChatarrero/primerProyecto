<?php 

	class Login extends Controllers{
		public function __construct()
		{

			session_start();
			//sessionStar();
			parent::__construct();		
			//session_regenerate_id(true);
			if (isset($_SESSION['login'])){
				header('Location: '.base_url().'/dashboard');
			}
			
		}

		public function login()
		{
			$data['page_tag'] = "Login - Sistema A.G.B";
			$data['page_title'] = "Sistema A.G.B";
			$data['page_name'] = "login";
			$data['page_functions_js'] = "functions_login.js";
			$this->views->getView($this,"login",$data);
		}

		public function loginUser(){
			//dep($_POST);
			if($_POST){
				if (empty($_POST['txtCorreo']) || empty($_POST['txtPassword'])){
					$arrResponse = array('status' => false, 'msg' => "Error de Datos" );
				}else{
					$strUsuario = strtolower(strClean($_POST['txtCorreo']));
					$strPassword = hash("SHA256", $_POST['txtPassword']);
					$requestUser = $this->model->loginUser($strUsuario, $strPassword);
					if(empty($requestUser)){
						$arrResponse = array('status' =>false, 'msg' => 'El usuario o la Contraseña es incorrecto.' );
					}else{

						$arrData = $requestUser;
						if($arrData['status'] == 1){
							$_SESSION['idUser'] = $arrData['idpersona'];
							$_SESSION['login'] = true;
							$_SESSION['timeout'] = true;
							$_SESSION['inicio'] = time();

							$arrData = $this->model->sessionLogin($_SESSION['idUser']);
							sessionUser($_SESSION['idUser']);
							$arrResponse = array('status' => true, 'msg' => 'ok');
						}else{
							$arrResponse = array('status' => false, 'msg' => 'Usuario Inactivo');
						}

					}

				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function resetPass(){
			if($_POST){

				error_reporting(0);

				if (empty($_POST['txtCorreoReset'])){
					$arrResponse = array('status' => false, 'msg' => 'Error de datos');
				}else{
					$token = token();
					$strCorreo = strtolower(strClean($_POST['txtCorreoReset']));
					$arrData = $this->model->getUserCorreo($strCorreo);

					if(empty($arrData)){
						$arrResponse = array('status' => false, 'msg' => 'Usuario no existente');
					}else{
						$idpersona = $arrData['idpersona'];
						$nombreUsuario = $arrData['nombre'].' '.$arrData['apellido'];

						$url_recovery = base_url().'/login/confirmUser/'.$strCorreo.'/'.$token;

						$requestUpdate = $this->model->setTokenUser($idpersona,$token);

						$dataUsuario = array('nombreUsuario' => $nombreUsuario, 'correo' => $strCorreo, 'asunto' => 'Recuperar cuenta - '.NOMBRE_REMITENTE, 'url_recovery' => $url_recovery);

					
						if($requestUpdate){

							$sendCorreo = sendCorreo($dataUsuario, 'correo_cambioPassword');

							if($sendCorreo){

								$arrResponse = array('status' => true, 'msg' => 'Se ha enviado un correo a tu cuenta para cambiar tu contraseña.');
							}else{

								$arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta mas tarde.');
							}	
						}else{
							$arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta mas tarde.');
						}
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function confirmUser(string $params){

			if(empty($params)){
				header('location: '.base_url());
			}else{

				$arrParams = explode(',',$params);
				$strCorreo = strClean($arrParams[0]);
				$strToken = strClean($arrParams[1]);

				$arrResponse = $this->model->getUsuario($strCorreo,$strToken);
				if(empty($arrResponse)){
					header("Location: ".base_url());
				}else{
			       $data['page_tag'] = "Cambiar contraseña";
			       $data['page_name'] = "cambiar_contraseña";
			       $data['page_title'] = "Cambiar contraseña";
			       $data['correo'] = $strCorreo;
			       $data['token'] = $strToken;
			       $data['idpersona'] = $arrResponse['idpersona'];
			       $data['page_functions_js'] = "functions_login.js";
			       $this->views->getView($this,"cambiar_password",$data);

				}	
			}
			die();	
		}


		public function setPassword(){

			if(empty($_POST['idUsuario']) || empty($_POST['txtCorreo']) || empty($_POST['txtToken']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm'])){

				$arrResponse = array('status' => false, 'msg' => 'Error de datos');
			}else{
				$intIdpersona = intval($_POST['idUsuario']);
				$strPassword = $_POST['txtPassword'];
				$strPasswordConfirm = $_POST['txtPasswordConfirm'];
				$strCorreo = strClean($_POST['txtCorreo']);
				$strToken = strClean($_POST['txtToken']);

				if($strPassword != $strPasswordConfirm){
					$arrResponse = array('status' => false, 'msg' => 'Las contraseñas no coinciden.');
				}else{
					$arrResponseUser = $this->model->getUsuario($strCorreo,$strToken);
				if(empty($arrResponseUser)){
					$arrResponse = array('status' => false, 'msg' => 'Error de Datos.');
				}else{
					$strPassword = hash("SHA256",$strPassword);
					$requestPass = $this->model->insertPassword($intIdpersona,$strPassword);
					if($requestPass){
						$arrResponse = array('status' => true, 'msg' => 'Contraseña actualiza con éxito.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intente más tarde.');
					}
				}	
			}
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();




		}








	}
 ?>