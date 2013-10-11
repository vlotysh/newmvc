<?php

loadResurs('ProductsModel');
loadResurs('CategoriesModel');

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