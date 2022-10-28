<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Menu {
		private $arr_menu;

		/**
		 * @return mixed
		 */
		public function __construct($arr)
		{
			$this->arr_menu = $arr;
		}

		/**
		 * @return mixed
		 */
		public function construirMenu()
		{
			$ret_menu = "<nav><ul>";
			foreach ($this->arr_menu as $opcion){
				$ret_menu .= "<li>" . $opcion . "</li>";
			}
			$ret_menu .= "</ul><ul>";
		}
	}

?>
