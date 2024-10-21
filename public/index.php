<?php

session_start();

require_once '../vendor/autoload.php';
require_once '../App/Config/config.php';
use App\Controllers\FrontController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uriSegments = explode('/', trim($uri, '/'));
$frontController = new FrontController();

switch ($uriSegments[0]) {
    
    case '':
        $frontController->index();
        break;

    case 'logout':
        $frontController->logout();

    case 'rendezvous':
        $frontController->rendezvous();
        break;

    case 'rendezvousAdmin':
        $frontController->rendezvousAdmin();
        break;

    case 'services':
        $frontController->services();
        break;
     
    case 'about':
        $frontController->about();
        break;
    
    case 'actus':
        $frontController->actus();
        break;
            
    case 'dashboard':
        $frontController->dashboard();
        break;
        
    case 'login':
        $frontController->login();
        break;
                
    case 'register':
        $frontController->register();
        break;
            
    default:
        header("HTTP/1.0 404 not found");
        echo '404 not found';
        break;
}
?>