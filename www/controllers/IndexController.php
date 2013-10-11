<?php

 
loadResurs('CategoriesModel');
loadResurs('ProductsModel');

function indexAction ($smarty) {
    $rsCategories = getAllMainCatsWithChildren();
    
    $rsProducts = getLastProducts(3);

    $smarty->assign('pageTitle', 'Главная страница');
    $smarty->assign('text', 'Текст страницы');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);


   
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'index');
    loadTemplate($smarty, 'footer');
}

function staticActiom ($smarty) {
        $rsCategories = getAllMainCatsWithChildren();
    
    $rsProducts = getLastProducts(3);

    $smarty->assign('pageTitle', 'Главная страница');
    $smarty->assign('text', 'Текст страницы');
    $smarty->assign('rsCategories', $rsCategories);
    

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'static');
    loadTemplate($smarty, 'footer');
}



?>
