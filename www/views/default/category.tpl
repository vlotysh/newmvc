{* cтраница категорий*}

{if $rsOneCategory['parent_id'] != 0 && count($rsProducts) != 0}
<form action="" method="GET">
    
       
    <INPUT type="radio" NAME="q" value="price ASC" {if $query == 'price ASC'}  checked=""{/if}><span>По возрастанию цены</span>
     <INPUT type="radio" name="q" value="price DESC"  {if $query == 'price DESC'}checked="" {/if}> <span>По убыванию цены</span>
    <!--
       <p><select name="per_page">
    <option disabled>Выберите героя</option>
    <option value="2" selected>2</option>
    <option value="5">5</option>
    <option value="10">10</option>
  
   </select></p>-->
<input type="submit" value="Показать">
</form>
    
{/if}


{if count($rsProducts) > 0 && $rsChildCats == null}
  <h2>Товары категорий {$rsCategory['name']}</h2>
  <p style="margin-bottom: 10px;">В категории {$rsCategory['name']} {$count} {if $count > 5} товаров{else}товара{/if} </p>
 
{elseif count($rsProducts) == 0 && $rsChildCats == null}
     <h2>Товары категорий {$rsCategory['name']}</h2>
    <p>Товаров нет!</p>
{elseif count($rsProducts) == 0 && $rsChildCats != null}    
    <h2>{$rsCategory['name']}</h2>
     
  {/if}

  <div class="products">
{foreach $rsProducts as $item name = products}
    <div>
        <a href="/product/{$item['id']}/">
            <img src="/images/products/{$item['image']}" height="100" />
        </a><br />
            <a href="/product/{$item['id']}/">{$item['name']}</a><br />
            <span>Стоимость: {$item['price']} грн.</span>
            
    </div>
          {if $smarty.foreach.products.iteration mod 4 == 0}
              <div style="clear: both;"></div>
          {/if}
            
{/foreach}


  </div>

<div class="clear"></div>
{if count($rsProducts) > 0 && $rsChildCats == null}
    <div class="pegenation">
    {$pages}
    </div>
{/if}

{foreach $rsChildCats as $item name = childCats}
    <h2><a href="/category/{$item['id']}/">{$item['name']}</a></h2>
{/foreach}