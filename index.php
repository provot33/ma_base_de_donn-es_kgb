<?php
require_once __DIR__.'/config.php';

// Sécurise le cookie de session avec httponly
session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => $_SERVER['SERVER_NAME'],
    'httponly' => true
]);
session_start();
define('_ROOTPATH_', __DIR__);
define('_TEMPLATEPATH_', __DIR__.'/Template');
spl_autoload_extensions(".php");
spl_autoload_register();
spl_autoload_register(function ($class){
   require_once _ROOTPATH_. '/' . strtolower(str_replace('\\', '/', $class) . '.php');
});

use App\Controller\Controller;
// Nous avons besoin de cette classe pour verifier si l'utilisateur est connecté
use App\Entity\Administrator;


$controller = new Controller();
$controller->route();

?>
