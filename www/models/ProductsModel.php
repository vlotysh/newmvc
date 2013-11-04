<?php

/*
 * Модель для таблицы продукции
 */

function getLastProducts($limit = NULL) {
    $sql = "SELECT * FROM products ORDER BY id DESC";

    if ($limit) {
        $sql .= " LIMIT $limit";
    }


    $rs = mysql_query($sql);

    return createSmartyRsArray($rs);
}

/**
 * МЕТОД ЗАТОЧЕН ПОД ПОСТРАНИЧНУЮ НАВИГАЦИЮ
 * 
 * 
 * 
 * @param type $itemId идентификатор категории
 * @param type $carent текущая страничка, береться ГЕТ параметром page
 * @param type $perPage количество выводимых записей
 * @param type $order передается метод упорядочности
 * @return type
 */



function getPrductsMainCat($itemId, $carent = '', $perPage = '', $order) {
    $itemId = intval($itemId);

    $sql = "SELECT * FROM products WHERE parent_id = '$itemId' ORDER BY $order LIMIT $carent , $perPage";
d($sql);
    $rs = mysql_query($sql);

    return createSmartyRsArray($rs);
}



function getPrductsByCat($itemId, $carent = '', $perPage = '', $order) {
    $itemId = intval($itemId);

    $sql = "SELECT * FROM products WHERE category_id = '$itemId' ORDER BY $order LIMIT $carent , $perPage";

    $rs = mysql_query($sql);

    return createSmartyRsArray($rs);
}

function getCount($itemId) {

    $sql = "SELECT * FROM products WHERE category_id = '$itemId' ";

    $rs = mysql_query($sql);

    $count = createSmartyRsArray($rs);

    return $count1 = count($count);
}

function getProductById($itemId) {
    $itemId = intval($itemId);

    $sql = "SELECT * FROM products WHERE id = '{$itemId}'";

    $rs = mysql_query($sql); 

    return mysql_fetch_assoc($rs);
}

/**
 * 
 * Получение массива с товарами по масиву с их идентификаторами
 * 
 * 
 * @param array $itemId массив идентификаторов
 * @return массив смарти для вывода в шаблоне
 * 
 *  */
function getProductFromArray(array $itemIds) {

    $strIds = implode($itemIds, ', ');

    $sql = "SELECT * FROM products WHERE id in ({$strIds})";
  
    $rs = mysql_query($sql);

   return createSmartyRsArray($rs);
}