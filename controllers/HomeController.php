<?php

class HomeController{
    
    public function index(){
        include("views/home/index.php");
    }
    public function login(){

        include("views/home/login.php");
    }
}