<?php 
		class Productos extends Controllers{
		public function __construct()
		{
			session_start();
			parent::__construct();			
			//session_regenerate_id(true);
			if (empty($_SESSION['login'])){
				header('Location: '.base_url().'/login');
			}
			getPermisos(3);
		}

		public function Productos()
		{
			$data['page_tag'] = "Productos";
			$data['page_title'] = "Productos";
			$data['page_name'] = "productos";
			$data['page_functions_js'] = "functions_productos.js";
			$this->views->getView($this,"productos",$data);
		}

		//Para listar
		public function getProductos(){

				if($_SESSION['permisosMod']['r']){		    
				    $arrData = $this->model->selectProductos();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					if($arrData[$i]['status'] == 1){
						$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
					}

					if($_SESSION['permisosMod']['r']){
						$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['idproducto'].')" title="Ver Producto"><i class="far fa-eye"></i></button>';
					}

					if($_SESSION['permisosMod']['u']){					
						$btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['idproducto'].')" title="Editar Producto"><i class="fas fa-pencil-alt"></i></button>';
					}
					if($_SESSION['permisosMod']['d']){
						$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idproducto'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">
					    '.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
				die();
		}

		//Para extraer los datos de 1 solo registro
		public function getProducto($idproducto){

			if($_SESSION['permisosMod']['r']){

					$intIdproducto = intval($idproducto);
					if($intIdproducto > 0)
					{
						$arrData = $this->model->selectProducto($intIdproducto);
						if(empty($arrData)){
							$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
						}else{
							$arrResponse = array('status' => true, 'data' => $arrData);
						}
						echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
					}
				}
				die();
		}

		//Para registrar y actualizar
		public function setProducto(){
		
				$intIdProducto = intval($_POST['idProducto']);
				$strProducto =  ucwords(strClean($_POST['NombreProducto']));
				$strDescipcion = strClean($_POST['DescripcionProducto']);
				$intStatus = intval($_POST['listStatus']);
				$request_producto = "";

				if($intIdProducto == 0)
				{
					//Crear
					if($_SESSION['permisosMod']['w']){
					$request_producto = $this->model->insertProducto($strProducto, $strDescipcion, $intStatus);
					$option = 1;
				}
				}else{
					//Actualizar
					if($_SESSION['permisosMod']['u']){
						$request_producto = $this->model->updateProducto($intIdProducto, $strProducto, $strDescipcion, $intStatus);
						$option = 2;
				}
				}
				if($request_producto > 0 )
				{
					if($option == 1)
					{
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
					}else{
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					}
				}else if($request_producto == 'exist'){					
					$arrResponse = array('status' => false, 'msg' => '¡Atención! El Producto ya existe.');
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
			die();
		}

		public function delProducto()
		{
			if($_POST){

				if($_SESSION['permisosMod']['d']){

					$intIdproducto = intval($_POST['idProducto']);
					$requestDelete = $this->model->deleteProducto($intIdproducto);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el producto');

					}else if($requestDelete == 'exist'){

						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un producto asociado al inventario.');
					}else{

						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el producto.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			die();
		}
	}

		public function getSelectProductos(){

			$htmlOptions = "";
					$arrData = $this->model->selectProductos();
					if(count($arrData) > 0 ){
						for ($i=0; $i < count($arrData); $i++) { 
							if($arrData[$i]['status'] == 1 ){
							$htmlOptions .= '<option value="'.$arrData[$i]['idproducto'].'">'.$arrData[$i]['nombre'].'</option>';
							}
						}
					}
					echo $htmlOptions;
					die();	
		}
	}
?>