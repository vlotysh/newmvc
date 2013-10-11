<?php
http://biznesguide.ru/coding/131.html
    
   // or
    
    http://it-ride.blogspot.com/2009/08/pagination-with-smarty.html
    
function pagination($total, $per_page, $num_links, $start_row, $url=''){
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
        if ($i <= 0) $i = 0;
        $output .= '<i>←</i><a href="'.$url.'?p='.$i.'">Предыдущая</a>';
    }
    else{
        $output .='<span><i>←</i>Предыдущая</span>';
    }
    
    $output .= '<span class="divider">|</span>';

    //Формируем ссылку на следующую страницу
    if ($cur_page < $num_pages){
        $output .= '<a href="'.$url.'?p='.($cur_page * $per_page).'">Следующая</a><i>→</i>';
    }
    else{
        $output .='<span>Следующая<i>→</i></span>';
    }

    $output .= '</span><br/>';

    //Формируем ссылку на первую страницу
    if  ($cur_page > ($num_links + 1)){
        $output .= '<a href="'.$url.'" title="Первая"><img src="images/left_active.png"></a>';
    }

    // Формируем список страниц с учетом стартовой и последней страницы   >
        for ($loop = $start; $loop <= $end; $loop++){
        $i = ($loop * $per_page) - $per_page;

        if ($i >= 0)
        {
            if ($cur_page == $loop)
            {
               //Текущая страница
               $output .= '<span>'.$loop.'</span>'; 
            }
            else
            {

               $n = ($i == 0) ? '' : $i;

               $output .= '<a href="'.$url.'?p='.$n.'">'.$loop.'</a>';
            }
        }
    }

    //Формируем ссылку на последнюю страницу
    if (($cur_page + $num_links) < $num_pages){
        $i = (($num_pages * $per_page) - $per_page);
        $output .= '<a href="'.$url.'?p='.$i.'" title="Последняя"><img src="images/right_active.png"></a>';
    }

    return '<div class="wrapPaging"><strong>Страницы:</strong>'.$output.'</div>';
}

?>
