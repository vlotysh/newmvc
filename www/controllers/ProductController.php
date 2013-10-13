<?php

/*
 * контроллер страницы товаров (product/4/)
 */

loadResurs('ProductsModel');
loadResurs('CategoriesModel');

function indexAction($smarty) {
    $itemId = isset($_GET['id']) ? $_GET['id'] : null;
    if (!$itemId)
        exit();


    $rsProduct = getProductById($itemId); //выборка конкретного продукта
    $rsCategories = getAllMainCatsWithChildren(); //выборка всех котегорий для построения меню

    $rsOneCategory = getCatById($rsProduct['category_id']); //выброка категории 
    //к которой пренадлежит товар
    
    if(in_array($itemId, $_SESSION['cart'])) {
        $smarty->assign('ItemInCart', 1);
    }
    
    $smarty->assign('pageTitle', $rsProduct['name']);
    $smarty->assign('rsOneCategory', $rsOneCategory);
    $smarty->assign('rsProduct', $rsProduct);
    $smarty->assign('rsCategories', $rsCategories);
    
    layOut($smarty,'product');

    
}