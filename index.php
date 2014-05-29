<?php

// Nastavení interního kódování pro funkce pro práci s řetězci
mb_internal_encoding("UTF-8");

// Callback pro automatické načítání tříd controllerů a modelů
function autoloadFunction($class)
{
	// Končí název třídy řetězcem "Controller" ?
    if (preg_match('/Controller$/', $class)) {
        require("controllers/" . $class . ".php");
    }
    else {
        require("models/" . $class . ".php");
    }
}

// Registrace callbacku (Pod starým PHP 5.2 je nutné nahradit fcí __autoload())
spl_autoload_register("autoloadFunction");

$router = new RouterController();;
$router->process(array($_SERVER['REQUEST_URI']));
$router->renderView();