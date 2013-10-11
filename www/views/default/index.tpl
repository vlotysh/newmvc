{* шаблон главной страницы*}


<div class="last">
     <p>Последние поступления</p>
{foreach $rsProducts as $item name = products}
    <div style="float: left; padding: 10px 0px; margin: 10px 0px; text-align: center;" >
        <a href="/product/{$item['id']}/">
            <img src="/images/products/{$item['image']}" width="100" />
        </a><br />
            <a href="/product/{$item['id']}/">{$item['name']}</a>
    </div>
          {if $smarty.foreach.products.iteration mod 1 == 0}
              <div style="clear: both;"></div>
          {/if}
            
{/foreach}

</div>