<?php 

	class Dashboard extends Controllers{
		public function __construct()
		{

			session_start();
			//sessionStar();
			parent::__construct();
			//session_regenerate_id(true);
			if (empty($_SESSION['login'])){
				header('Location: '.base_url().'/login');
			}

			getPermisos(1);
		}

		public function Dashboard()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Dashboard";
			$data['page_title'] = "Dashboard";
			$data['page_name'] = "dashboard";
			$data['page_functions_js'] = "functions_dashboard.js";
			$data['usuarios'] = $this->model->cantUsuarios();
			$data['inventario'] = $this->model->cantInventario();
			$data['productos'] = $this->model->cantProductos();
			$data['menus'] = $this->model->cantMenus();
			$data['ultiMenu'] = $this->model->ultiMenu();
			$data['stock'] = $this->model->stock();
			//$data['resta'] = $this->model->resStock();
			//dep($data['stock']);exit;
			$this->views->getView($this,"dashboard",$data);
		}

	}
 ?>