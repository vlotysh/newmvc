 <div class="leftColumn">
        <div class="menuCaption">Меню</div>
           <ul>  
        {foreach $rsCategories as $item}
        
             
            {if $rsCategory['id'] == $item['id'] || $item['id'] == $rsOneCategory['parent_id']} 
             
                  
                <li>   <a class="carent" href="/category/{$item['id']}/">{$item['name']}
                 {else}
                 <li>   <a href="/category/{$item['id']}/">{$item['name']}</a>
            
            {/if}
           
                             
            {if isset($item['children'])}
               <ul>
                {foreach $item['children'] as $itemChild}
                      {if $rsCategory['id'] == $itemChild['id']}                    
                    <li> {$itemChild['name']}</li>
                    {elseif  $itemChild['id'] == $rsProduct['category_id']}
                        <li>{$itemChild['name']}</li>
                      {else}
                      <li> <a href="/category/{$itemChild['id']}/">{$itemChild['name']}</a> </li>
                      
                     {/if}
                     
                {/foreach} 
                </ul>
            {/if} 
            </li>
        
        {/foreach}
        </ul>
        
        
        {if isset($arUser)}
            
             <div id="userBox">
                 Привет, <a href="/user/" id="userLink">{$arUser['displayName']}</a> !<br />
            <a href="/user/logout/" onclick="logout();">Выход</a>
            
            </div>
          {else}  
          
          <div id="userBox" class="hideme">
           <p> Привет, <a href="/user/" id="userLink">{$arUser['displayName']}</a> !</p>
            <a href="/user/logout/" onclick="logout();">Выход</a>
            
            </div>
      
        {if !isset($arUser)}
        <div id="loginBox">
            <div class="menuCaprion">Авторизация</div>
            <input type="text" id="loginEmail" name="loginEmail" value="" /><br />
            <input type="text" id="loginPwd" name="loginPwd" value=""/><br />
            Запомнить меня: <input type="checkbox" id="remember" name="remember" value="true"/><br />
            <input type="button" onclick="login();" value="Войти" /><br />
        </div>
        {/if}
        
        <div id="registerBox" style="margin-top: 10px;">
        <div class="menuCaprion showHidden" style="cursor: pointer; margin-bottom: 10px;">Регистрация</div>
        
        
        <div class="hidenn">
              email:<br />
              <input  required type="email" id="email" name="email" value=""/><br />
              пароль: <br />
              <input  required type="password" id="pwd1" name="pwd1" value=""/><br />
              повторите пароль: <br />
              <input  required type="password" id="pwd2" name="pwd2" value=""/><br />
              <input type="button" onclick="registerNewUser()" value="Зарегестрироваться" />
          </div>
                                
        </div>
        {/if}
         <div class="menuCaption">Корзина</div>
        <a href="/cart/" title="Перейти в корзину">В корзину</a>
        <p>В корзине</p>
        <span id="cartCntItems">
            {if $cartCntItems > 0}{$cartCntItems}{else}пусто{/if}
        </span>
    </div>