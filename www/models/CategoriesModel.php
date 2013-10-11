<?php

/*
 * Отвечает за работу с таблицей категорий
 * и для манипулирование данных
 */

/*
 * Получение дочерних элекментов
 * 
 * @param integer $catID ID категории
 * 
 * @return array массив дочерних категорий
 */

function getChildrenForCat($catId) {
    $sql = "SELECT * FROM categories WHERE parent_id = '$catId'";
        

    $rs = mysql_query($sql);
    

    
    return createSmartyRsArray($rs);
}


/**
 * ПОлучаем все категории
 * 
 * @return type
 */
function getAllMainCatsWithChildren() {
   $sql = 'SELECT * FROM categories WHERE parent_id = 0';

   $rs = mysql_query($sql);
   
   $smartyRs = array();
   
   while ($row = mysql_fetch_assoc($rs)) {
    
       $rsChildren = getChildrenForCat($row['id']);
       
       if($rsChildren ) {
           $row['children'] = $rsChildren;
       }
       
       
       $smartyRs[] = $row;
   }
   

   return $smartyRs;
}

function getCatById($catId) {
    
    
    
    $catId = intval($catId);
    
    $sql = "SELECT * FROM categories WHERE id ='{$catId}' LIMIT 0 , 2";
    
    $rs = mysql_query($sql);


    return mysql_fetch_assoc($rs);
    
};

