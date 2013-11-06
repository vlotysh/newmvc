<h1>Регистрационные данные</h1>
<p class="user_title"><span>Логин:</span> {$arUser['email']}</p>


    <p class="user_title"><span>Имя пользователя:</span>  <input type="text" id="newName" value="{$arUser['name']}" placeholder="Имя"/></p>
        <p class="user_title"><span>Телефон пользователя:</span>  <input type="text" id="newPhone" value="{$arUser['phone']}" placeholder="Телефон"/></p>
    
        <p class="user_title"><span>Адрес для доставки:</span>  <textarea cols="22" rows="5" noresize type="text" id="newAdress" value="{$arUser['adress']}" placeholder="Адрес"/></textarea></p>

 <p>Смена пароля <br>
 -----------------
 </p>
 
 
 <p class="user_title"><span>Текущий пароль:</span>  <input id="curPwd" type="password" value="" placeholder="Текущий пароль"/></p>
  
   <p class="user_title"><span>Новый пароль:</span>  <input id="pwd1" type="password" value="" placeholder="Новый пароль"/></p>
    <p class="user_title"><span>Повторите новый пароль:</span>  <input id="pwd2" type="password" value="" placeholder="Повторить новый пароль"/></p>
    <input type="button" value="Cохранить изменения" onClick="updateUserData();" />