<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	header('location:404.php');
}else{
include 'mycomponent/mymenumanager/includes/config.php';
include 'mycomponent/mymenumanager/includes/functions.php';
switch($_GET[act]){
  default:
	$tablemenu = new MyTable('menu_group');
	$menus = $tablemenu->numRow();
	if ($menus != "0"){
		/**
		 * MyController
		 * This is the base class for all controllers
		 * Every controller will extend this class
		 */
		class MyController {
			protected $db;

			/**
			 * Constructor. Initialize database connection
			 */
			public function __construct() {
				include 'mycomponent/mymenumanager/includes/db.php';
				$this->db = new DB;
				$this->db->Connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
			}

			/**
			 * Includes the view file and display the data
			 *
			 * @param string $view_file
			 * @param array $data
			 */
			protected function view($view_file, $data = '') {
				if (is_array($data)) {
					extract($data);
				}
				$file = 'mycomponent/mymenumanager/templates/' . $view_file . '.php';
				if (file_exists($file)) {
					include $file;
				} else {
					die("Cannot include $view_file");
				}
			}
		}
		/**
		 * default controller & method
		 */
		$controller = 'menu';
		$method = 'menumanager';

		/**
		 * url structure: index.php?act=controller.method
		 */
		if (isset($_GET['act'])) {
			$act = explode('.', $_GET['act']);
			$controller = $act[0];
			if (isset($act[1])) {
				$method = $act[1];
			}
		}

		$controller_file = 'mycomponent/mymenumanager/modules/' . $controller . '.php';
		if (file_exists($controller_file)) {
			include $controller_file;
			$Class_name = ucfirst($controller);
			$instance = new $Class_name;
			if (!is_callable(array($instance, $method))) {
				die("Cannot call method $method");
			}
			$instance->$method();
		} else {
			$controller_file = 'mycomponent/mymenumanager/modules/menu.php';
			include $controller_file;
			$instance = new Menu;
			$instance->menumanager();
		}
		break;
	}else{
		$table = new MyTable('menu_group');
		$table->save(array(
			'id' => '1',
			'title' => 'Main Menu'
		));
		/**
		 * MyController
		 * This is the base class for all controllers
		 * Every controller will extend this class
		 */
		class MyController {
			protected $db;

			/**
			 * Constructor. Initialize database connection
			 */
			public function __construct() {
				include 'mycomponent/mymenumanager/includes/db.php';
				$this->db = new DB;
				$this->db->Connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
			}

			/**
			 * Includes the view file and display the data
			 *
			 * @param string $view_file
			 * @param array $data
			 */
			protected function view($view_file, $data = '') {
				if (is_array($data)) {
					extract($data);
				}
				$file = 'mycomponent/mymenumanager/templates/' . $view_file . '.php';
				if (file_exists($file)) {
					include $file;
				} else {
					die("Cannot include $view_file");
				}
			}
		}
		/**
		 * default controller & method
		 */
		$controller = 'menu';
		$method = 'menumanager';

		/**
		 * url structure: index.php?act=controller.method
		 */
		if (isset($_GET['act'])) {
			$act = explode('.', $_GET['act']);
			$controller = $act[0];
			if (isset($act[1])) {
				$method = $act[1];
			}
		}

		$controller_file = 'mycomponent/mymenumanager/modules/' . $controller . '.php';
		if (file_exists($controller_file)) {
			include $controller_file;
			$Class_name = ucfirst($controller);
			$instance = new $Class_name;
			if (!is_callable(array($instance, $method))) {
				die("Cannot call method $method");
			}
			$instance->$method();
		} else {
			$controller_file = 'mycomponent/mymenumanager/modules/menu.php';
			include $controller_file;
			$instance = new Menu;
			$instance->menumanager();
		}
	}
	break;
}
/* End of index.php */
}
?>