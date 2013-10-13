<?php

/**
 * 
 * Функция для дебага, позволяет получать значения переменной($value) и выводить их на экран, 
  тем самым становится возможно лакозовать ошибку.
 * 
 * $die служит для прекращения работы всей программы. По умолчанию 1, что значит
 * завершение работы в дебаг режиме
 * 
 * @param type $value
 * @param type $die
 */
function d($value = null, $die = 1) {
    echo 'DebugMod: <br > <pre>';
    print_r($value);
    echo '</pre>';

    if ($die)
        die();
}

/**
 * Функция для приобразование кириллицы в латиницу
 * 
 * 
 * @staticvar array $lang2tr
 * @param type $string
 * @return type
 */
function NormalizeStringToURL( $string )
{
	static $lang2tr = array(
		// russian
		'й'=>'j','ц'=>'c','у'=>'u','к'=>'k','е'=>'e','н'=>'n','г'=>'g','ш'=>'sh',
		'щ'=>'sh','з'=>'z','х'=>'h','ъ'=>'','ф'=>'f','ы'=>'y','в'=>'v','а'=>'a',
		'п'=>'p','р'=>'r','о'=>'o','л'=>'l','д'=>'d','ж'=>'zh','э'=>'e','я'=>'ja',
		'ч'=>'ch','с'=>'s','м'=>'m','и'=>'i','т'=>'t','ь'=>'','б'=>'b','ю'=>'ju','ё'=>'e','и'=>'i',

		'Й'=>'J','Ц'=>'C','У'=>'U','К'=>'K','Е'=>'E','Н'=>'N','Г'=>'G','Ш'=>'SH',
		'Щ'=>'SH','З'=>'Z','Х'=>'H','Ъ'=>'','Ф'=>'F','Ы'=>'Y','В'=>'V','А'=>'A',
		'П'=>'P','Р'=>'R','О'=>'O','Л'=>'L','Д'=>'D','Ж'=>'ZH','Э'=>'E','Я'=>'JA',
		'Ч'=>'CH','С'=>'S','М'=>'M','И'=>'I','Т'=>'T','Ь'=>'','Б'=>'B','Ю'=>'JU','Ё'=>'E','И'=>'I',

		// special
		' '=>'-', '\''=>'', '"'=>'', '\t'=>'', '«'=>'', '»'=>'', '?'=>'', '!'=>'', '*'=>''
	);
	$url = preg_replace( '/[\-]+/', '-', preg_replace( '/[^\w\-\*]/', '', strtolower( strtr( $string, $lang2tr ) ) ) );
	
	return  $url;
}

/**
 * 
 * Преобразуем в массив под категорий из выборки 
 * функции getChildrenForCat
 * 
 * 
 * @param type $rs
 * @return boolean
 */
function createSmartyRsArray($rs) {
    if (!$rs)
        return FALSE;

    $smartyRs = array();

    while ($row = mysql_fetch_assoc($rs)) {
    
        $smartyRs[] = $row;
        
    }
    
   
    return $smartyRs;
}

/**
 * 
 * функция ДЛЯ загрузки страниц
 * @param type $controllerName имя контроллера
 * @param type $actionName метод контроллера
 */
function loadPage($smarty, $controllerName, $actionName = 'index') {
    include_once (PathPrefix . $controllerName . PathPostfix);

    $function = $actionName . 'Action';

    if (!function_exists($function))
        $function = index . 'Action';


    $function($smarty);
}

/**
 * 
 * @param type $smarty
 * @param type $templayteName
 */
function loadTemplate($smarty, $templayteName) {
    $smarty->display($templayteName . TemplatePostfix);
}

/**
 * Используется для загрузки нескольких шалонов сразу
 * @smarty первым парметром передается смарти объект
 * @templayteName втрой имя шаблона котороый нужно поставить
 * (к примеру, 'product', 'category','cart') 
 * 
 * @param type $smarty
 * @param type $templayteName
 */
function layOut($smarty, $templayteName){
     loadTemplate($smarty, 'header');
    loadTemplate($smarty, $templayteName);
    loadTemplate($smarty, 'footer');
}




/**
 * 
 * @param type $total ОБЩЕЕ КОЛИЧЕСТВО ЗАПИСЕЙ
 * @param type $per_page количество записей на страницу
 * @param type $num_links количество ссылок по левому и правому краю от активной
 * @param type $start_row с какой начинается
 * @param type $id идентификатор категории
 * @param $OnlyArrow если 0 то будут  все странички, если передать 1 то будут толко
 * стрелочки вперед и 
 * @return string строчка с постраничной навигацией
 */
function pagination($total, $per_page, $num_links, $start_row, $id, $q){
   
    

//Получаем общее число страниц
    $num_pages = ceil($total/$per_page);

    if ($num_pages == 1) return '';

    //Получаем количество элементов на страницы
    $cur_page = $start_row;

    //Если количество элементов на страницы больше чем общее число элементов
    // то текущая страница будет равна последней
    if ($cur_page > $total){
        $cur_page = ($num_pages - 1) * $per_page;
    }

    //Получаем номер текущей страницы
    $cur_page = floor(($cur_page/$per_page) + 1);

    //Получаем номер стартовой страницы выводимой в пейджинге
    $start = (($cur_page - $num_links) > 0) ? $cur_page - $num_links : 0;
    //Получаем номер последней страницы выводимой в пейджинге
    $end   = (($cur_page + $num_links) < $num_pages) ? $cur_page + $num_links : $num_pages;

    $output = '<span class="ways">';

    //Формируем ссылку на предыдущую страницу
    if  ($cur_page != 1){
        $i = $start_row - $per_page;
        if ($i <= 0) $i = '' ;
        $output .= '<i>←</i><a href="/category/'.$id.'/'.$i.$q.'">Предыдущая</a>';
    }
    else{
        $output .='<span><i>←</i>Предыдущая</span>';
    }
    
    $output .= '<span class="divider">|</span>';

    //Формируем ссылку на следующую страницу
    if ($cur_page < $num_pages){
        $output .= '<a href="/category/'.$id.'/'.($cur_page * $per_page).$q.'">Следующая </a><i>→</i>';
    }
    else{
        $output .='<span>Следующая<i>→</i></span>';
    }

    $output .= '<br></span>';

    //Формируем ссылку на первую страницу
    
     $output .= '<span class="num_links">';
    if  ($cur_page > ($num_links + 1)){
        $output .= '<a href="/category/'.$id.'/'.$q.'" title="Первая">Первая</a>';
    }

    // Формируем список страниц с учетом стартовой и последней страницы   >
         
    if ($OnlyArrow == 0) { 
        for ($loop = $start; $loop <= $end; $loop++){
        $i = ($loop * $per_page) - $per_page;

     if ($i >= 0)
        {
            if ($cur_page == $loop)
            {
               //Текущая страница
               $output .= '<span class="carent">'.$loop.'</span>'; 
            }
            else
            {

               $n = ($i == 0) ? '' : $i;

               $output .= '<a href="/category/'.$id.'/'.$n.$q.'">'.$loop.'</a>';
            } 
        }
    }
    }
    //Формируем ссылку на последнюю страницу
    if (($cur_page + $num_links) < $num_pages){
        $i = (($num_pages * $per_page) - $per_page);
        $output .= '<a href="/category/'.$id.'/'.$i.$q.'" title="Последняя ">Последняя</a>';
    }
    $output .= '</span>';
    return $output;
}
