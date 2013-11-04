<?php

loadResurs('ProductsModel');
loadResurs('CategoriesModel');
/**
 * Формирование страницы корзины
 * 
 * 
 * @param type $smarty
 */
function indexAction ($smarty) {
   //Проверяем массив карт в Сессии если нет то инициализируем пустой массив для
   //$itemIds
    
    $itemIds = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
 
    $rsCategories = getAllMainCatsWithChildren();


    $smarty->assign('pageTitle', 'Корзина');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);
    layOut($smarty, 'cart');
     
     
     
}






/**
 * 
 * Функция для добавления товара в корзину
 * 
 * Получает ид товара
 * 
 * return json данные
 * возращает информацию об успешном добавление товара в корзину и колчество товара
 * 
 * 
 */
function addtocartAction() {
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : null;
    if (!$itemId)  return false;


    $resData = array();

    if (isset($_SESSION['cart']) && array_search($itemId, $_SESSION['cart']) === false) {
        $_SESSION['cart'][] = $itemId;
        $resData['cntItems'] = count($_SESSION['cart']);
        $resData['success'] = 1;
     
    } else {
        $resData['success'] = 0;
    }

    echo json_encode($resData);
}


/**
 * функция для удаления товара из корзины
 * 
 * @param integer id GET параметр, ID товара который хотим удалить
 * @return json информация об операции (успешность, кол-во элементов в корзине)
 */
function removefromcartAction () {
     $itemId = isset($_GET['id']) ? intval($_GET['id']) : null;
     if (!$itemId)  exit();
      
     $resData = array();
     
     $key = array_search($itemId, $_SESSION['cart']);
     
     if  ($key !== null) {
         unset( $_SESSION['cart'][$key]);
          $resData['success'] = 1;
          $resData['cntItems'] = count($_SESSION['cart']);
     } else {
        $resData['success'] = 0;
    }
     
    echo json_encode($resData);
}