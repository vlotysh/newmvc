 <div class="leftColumn">
        <div class="menuCaption">Меню</div>
      
        {foreach $rsCategories as $item}
            
            {if $rsCategory['id'] == $item['id']} 
                 <p>{$item['name']}</p>
                 {else}
                     <a href="/category/{$item['id']}/">{$item['name']}</a><br />
            
            {/if}
            <div class="sub_cat">
                 
            {if isset($item['children'])}
               
                {foreach $item['children'] as $itemChild}
                      {if $rsCategory['id'] == $itemChild['id']}                    
                    <p> -- {$itemChild['name']}</p>
                    {elseif  $itemChild['id'] == $rsProduct['category_id']}
                        <p> -- {$itemChild['name']}</p>
                      {else}
                      <p> -- <a href="/category/{$itemChild['id']}/">{$itemChild['name']}</a></p>
                      
                     {/if}
                     
                {/foreach} 
            {/if} 
            </div>
        {/foreach}
        
        <div class="menuCaption">Корзина</div>
        <a href="/cart/" title="Перейти в корзину">В корзину</a>
        <p>В корзине</p>
        <span id="cartCntItems">
            {if $cartCntItems > 0}{$cartCntItems}{else}пусто{/if}
        </span>
    </div>