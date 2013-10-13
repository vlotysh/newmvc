<h1> Корзина </h1>

{if !$rsProducts}
    В корзине пусто
    {else} 
        <table width="100%" border="1" cellpadding="10" cellspacing="0">
        <thead align="center" >
            <td>
                №
            </td>
        <td width="90">
                Фото
            </td>
            <td width="200">
                 Наименование
            </td> 
            <td>
               Количество
            </td> 
            <td>
                Цена за единицу, грн
            </td> 
            <td width="60">
                Общая цена, грн
            </td> 
            <td width="120">
                Действие
            </td> 
        </thead>
        <tbody align="center">
        {foreach $rsProducts as $item name = cart}
           <tr>
               <td>
                   {$smarty.foreach.cart.iteration}
               </td>
               <td>
                   <img height="80" src="/images/products/{$item['image']}"/>
               </td>
               <td>
                   <a target="_blank" href="/product/{$item['id']}/">{$item['name']}</a>
               </td>
               <td>
                   <input style="width: 40px; text-align: center;" name="itemCnt_{$item['id']}" id="itemCnt_{$item['id']}"
                          type="text" value="1" onchange="conversionPrice({$item['id']});"/>
               </td>
                 <td>
                     <span id="itemPrice_{$item['id']}" value="{$item['price']}">
                   {$item['price']}
                     </span>
               </td>  
                <td>
                     <span id="itemRealPrice_{$item['id']}">
                   {$item['price']}
                     </span>                
                
               </td> 
                 <td>
  <a id="removeCart_{$item['id']}" href="#"  onClick="removeFromCart({$item['id']}) ; return false;" alt="Удалить">Удалить</a>

<a id="addCart_{$item['id']}" class="hideme" href="#"  onClick="addToCart({$item['id']}) ; return false;"  alt="Востановить ">Востановить</a>

               </td> 
           </tr>   
        {/foreach}
        </tbody>
        </table>
        
        <a href="/category/">Продолжить покупку</a>
        
    {/if}