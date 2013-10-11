<?php


/**
 * Функция для загрузки ресурвсов на в контроллер и не только
 * с помощью нее можно подключать, хелперы, модели и тд
 * 
 * @param type $name 
 * 
 * @return boolean при неудачном выполнеии вохращает фелс
 */
function loadResurs($name) {
    
define('ControllerPrefix', 'controllers/');
define('ModelsPrefix', 'models/');
define('HelpersPrefix', 'helpers/');
define('LibPrefix', 'helpers/');

define('Path1Postfix', '.php');


    if (file_exists(ControllerPrefix . $name . Path1Postfix)) {
        include_once (ControllerPrefix . $name . Path1Postfix);
       
    } elseif (file_exists(ModelsPrefix . $name . Path1Postfix)) {
        include_once (ModelsPrefix . $name . Path1Postfix);
    } elseif (file_exists(HelpersPrefix . $name . Path1Postfix)) {
        include_once HelpersPrefix . $name . Path1Postfix;
    } elseif (file_exists(LibPrefix . $name . Path1Postfix)) {
        include_once (LibPrefix . $name . Path1Postfix);
    } 
    else 
    {
        return FALSE;
    }
}

/**
 * 
 * Хлебные крошки
 * 
 * 
 */
function breadCrumbs ($rsChildCats = null) {

}