<h3>{$rsProduct['name']}</h3>


<img height="335" src="/images/products/{$rsProduct['image']}"/>

<p>Цена {$rsProduct['price']} гривен</p>

<a id="addCart_{$rsProduct['id']}" href="#"
   onClick="addToCart({$rsProduct['id']}) ; return false;"  alt="Добавить в корзину">Добавить в корзину</a>

<p> Описание <br /> {$rsProduct['description']} </p>