<?php
loadResurs('CategoriesModel');
loadResurs('StaticModel');

function indexAction($smarty) {
$rsCategories = getAllMainCatsWithChildren();

    $smarty->assign('text', 'Текст страницы');
    $smarty->assign('rsCategories', $rsCategories);
$smarty->assign('pageTitle', 'Заголовок');
    

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'static');
    loadTemplate($smarty, 'footer');

}
function contactsAction($smarty) {
$rsCategories = getAllMainCatsWithChildren();

    $smarty->assign('text', 'Текст страницы 1');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('pageTitle', 'Контакты');
    

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'static');
    loadTemplate($smarty, 'footer');

}





    ?>
