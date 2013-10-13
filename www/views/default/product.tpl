<h3>{$rsProduct['name']}</h3>


<img height="335" src="/images/products/{$rsProduct['image']}"/>

<p>Цена {$rsProduct['price']} гривен</p>


<a id="removeCart_{$rsProduct['id']}" {if !$ItemInCart} class="hideme" {/if}href="#"  onClick="removeFromCart({$rsProduct['id']}) ; return false;" alt="Удалить из корозины">Удалить из корзины</a>

<a id="addCart_{$rsProduct['id']}" {if $ItemInCart} class="hideme" {/if}href="#"  onClick="addToCart({$rsProduct['id']}) ; return false;"  alt="Добавить в корзину">Добавить в корзину</a>

<p> Описание <br /> {$rsProduct['description']} </p>