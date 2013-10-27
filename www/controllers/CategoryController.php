<?php

/*
 * КОнтроллер для вывода категорий
 * 
 *
 * 
 * 
 * 
 * пример /categories/1 
 */


//include_once 'models/CategoriesModel.php';
//include_once 'models/ProductsModel.php';
loadResurs('ProductsModel');
loadResurs('CategoriesModel');

/**
 * 
 * Формирование страницы категорий
 * 
 * @param type $smarty
 */
function indexAction($smarty) {
    
    
    $catId = isset($_GET['id']) ? $_GET['id'] : 'null';
    if (!$catId)
        exit();


    $start_row = isset($_GET['page']) ? $_GET['page'] : '0';
    $start_row = intval($start_row);


    $rsProducts = null;
    $rsChildCats = null;

    $rsCategory = getCatById($catId);



    if ($_REQUEST['q']) {
        $q = '?q=' . $_REQUEST['q'];
    };

    if (!$q) {
        $q = '';
    }
    
    
    

    if ($_SESSION['query'] ) {
        $query = $_SESSION['query'];
    } else {
        $query = 'price ASC';
    }

    $perPage = 4; //Количество записей на страничке
    $num_links = 2; //Количество ссылок навигации с лева и справа

    if ($rsCategory['parent_id'] == 0) {//проверка на главность категории
        $rsChildCats = getChildrenForCat($catId);
    } else {// ... если дочерние
        $rsProducts = getPrductsByCat($catId, $start_row, $perPage, $query);
    }




    $count = getCount($catId);

    $pages = pagination($count, $perPage, $num_links, $start_row, $catId);


    $rsOneCategory = getCatById($catId); //выброка категории 

    $rsCategories = getAllMainCatsWithChildren();

    $smarty->assign('pageTitle', 'Товары категории' . $rsCategory['name']);
    $smarty->assign('count', $count);

     $smarty->assign('catId', $catId);
    $smarty->assign('pages', $pages);
    $smarty->assign('query', $query);
    $smarty->assign('rsCategory', $rsCategory);
    $smarty->assign('rsOneCategory', $rsOneCategory);
    $smarty->assign('rsProducts', $rsProducts);
    $smarty->assign('rsChildCats', $rsChildCats);
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('page', $page);
   
    layOut($smarty, 'category');
    
    

}
