<?php 
    namespace App\Controllers;

    class Utama extends BaseController{
        public function index(){
            return view('template/template.php');
        }
        
    }
?>