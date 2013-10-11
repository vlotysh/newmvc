<?php

//<КОНСТАНТЫ>
define('PathPrefix', 'controllers/');
define('PathPostfix', 'Controller.php');

//
//Smarty шаблоны

//Использование шаблона по умолчанию
$template = 'default';


define('TemplatePrefix', "views/{$template}/");
define('TemplatePostfix', ".tpl");

//Пути стилей, скрипатов шаблона и тд
define('TemplateWebPath', "/views/{$template}/");
define('SMARTY_DIR', 'library/Smarty/libs/');


// <КОНСТАНТЫ/>


require_once(SMARTY_DIR . 'Smarty.class.php');

//Объявление объекта
$smarty = new Smarty();

$smarty->setTemplateDir(TemplatePrefix);
$smarty->setCompileDir('tmp/smarty/templates_c');
$smarty->setCacheDir('tmp/smarty/cache');
$smarty->setConfigDir('library/Smarty/configs');

$smarty->assign('templateWebPath', TemplateWebPath);
        





