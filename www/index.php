<?php
session_start(); //старт сесси

//если в сессии нет массива "корзина" то создаем его!
if(! isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();    
} 


$_SESSION['query'];



//Подключение файлов с функциями и конфигурациям
include_once 'config/config.php'; //Инициализация настроек + инициализация шаблона
include_once 'config/db.php';//Инициализация настроек базы данных
include_once 'library/mainFunctions.php'; //Основные функции
include_once 'helpers/additionFunctions.php'; //Хелперы

//
//
//
//Редирект для запрета повторойной отправки через F5 решение универсальное!.
//
//
//

if($_POST['q']) {
    $_SESSION['query'] = $_POST['q'];
 //  unset($_POST['q']); 
    redirect($_SERVER['REQUEST_URI']);
}
//Определене с каким контролером будем работать!
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Index';



$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';


if (isset($_COOKIE['user'])) {
    $_SESSION['user'] = json_decode($_COOKIE['user'], true);
}



if (isset($_SESSION['user'])) {
    $smarty->assign('arUser', $_SESSION['user']);
}

    //d($_COOKIE['user']);
//Количество товаров в корзине
$smarty->assign('cartCntItems', count($_SESSION['cart']));

$smarty->assign('controllerName', $controllerName);

$page = isset($_GET['page']) ? $_GET['page'] : NULL;


        
loadPage($smarty, $controllerName, $actionName, $page);

 