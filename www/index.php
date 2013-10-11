<?php
session_start(); //старт сесси

//если в сессии нет массива "корзина" то создаем его!
if(! isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();    
} 
//unset( $_SESSION['cart'] );

//Подключение файлов с функциями и конфигурациям
include_once 'config/config.php'; //Инициализация настроек
include_once 'config/db.php';//Инициализация настроек базы данных
include_once 'library/mainFunctions.php'; //Основные функции
include_once 'helpers/additionFunctions.php'; //Хелперы

//Определене с каким контролером будем работать!
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Index';



$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';


//Количество товаров в 
$smarty->assign('cartCntItems', count($_SESSION['cart']));


$page = isset($_GET['page']) ? $_GET['page'] : NULL;


  
        
loadPage($smarty, $controllerName, $actionName, $page);
