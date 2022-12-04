<?php
require __DIR__ . '/vendor/autoload.php';


// use App\Lib\Config;

// $LOG_PATH = Config::get('LOG_PATH', '');
// echo "[LOG_PATH]: $LOG_PATH";

// use App\Lib\Logger;

// Logger::enableSystemLogs();
// $logger = Logger::getInstance();
// $logger->info('Hello World');

// Router::get('/twigTeszt', function (Request $req, Response $res) {
//     $loader = new FilesystemLoader(__DIR__ . '\App\templates');
//     $twig = new Environment($loader);
//     echo $twig->render('guitars.html.twig', ['teszt' => 'Hello World3']);
// });


use App\Lib\App;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;
use App\Controller\GuitarController;
use App\Model\GuitarDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;




Router::get('/', function () {
    (new GuitarController())->home();
});

Router::get('/guitars', function (Request $req, Response $res) {
    return ((new GuitarController())->list());
});

Router::get('/guitarAdd', function (Request $req, Response $res) {
    (new GuitarController())->add();
});

Router::post('/guitarAdd', function (Request $req, Response $res) {
    (new GuitarController())->save();
});

Router::get('/guitarEdit/([0-9]*)', function (Request $req, Response $res) {
    (new GuitarController())->editById($req->params[0]);
});

Router::post('/guitarEdit', function (Request $req, Response $res) {
    (new GuitarController())->update();
});

Router::get('/guitarDelete/([0-9]*)', function (Request $req, Response $res) {
    (new GuitarController())->deleteById($req->params[0]);
});

Router::post('/guitarDelete', function (Request $req, Response $res) {
    (new GuitarController())->delete();
});


App::run();