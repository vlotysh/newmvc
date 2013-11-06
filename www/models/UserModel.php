<?php

/*
 * Модель для фукнкция работы с пользователями
 */

/**
 * Регистрация нового пользователя
 * 
 * 
 * @param type $email почта
 * @param type $pwdMD5 пароль в хэше
 * @param type $name имя пользователя
 * @param type $phone номер телефона
 * @param type $adress адресс
 */
function registerNewUser ($email, $pwdMD5, $name, $phone, $adress) 
{
    $email = htmlspecialchars(mysql_real_escape_string($email));
    $name = htmlspecialchars(mysql_real_escape_string($name));
    $phone = htmlspecialchars(mysql_real_escape_string($phone));
    $adress = htmlspecialchars(mysql_real_escape_string($adress));
    
    $sql = "INSERT INTO users (`email`,`pwd`,`name`,`phone`,`adress`) VALUES ('{$email}','{$pwdMD5}'
        ,'{$name}','{$phone}','{$adress}')";
    
     $rs = mysql_query($sql); 
    
     
     if($rs) {
         $sql = "SELECT * FROM users
             WHERE (`email` = '{$email}' and `pwd` = '{$pwdMD5}')
             LIMIT 1";
   
     $rs = mysql_query($sql); 
     $rs = createSmartyRsArray($rs);        
     
     if(isset($rs[0])) {
         $rs['success'] = 1;
     } else {
          $rs['success'] = 0;
     }
     } else {
         $rs['success'] = 0;
     } 
     
     return $rs;
}


/**
 * Функция для проверки регистрационных данных
 * 
 * 
 * @param type $email
 * @param type $pwd1
 * @param type $pwd2
 * 
 * @returb массив данных
 */
function checkRegisterParams($email,$pwd1, $pwd2) {
    $res = null;
    
    if(!$email) {
        $res['success'] = false;
        $res['message'] = 'Введите email';
        return $res;
    }
    
    if(!$pwd1) {
        $res['success'] = false;
        $res['message'] = 'Ввыедите пароль';
        return $res;
    }
    
     if(!$pwd2) {
        $res['success'] = false;
        $res['message'] = 'Введите пароль повторно';
        return $res;
    }
    
    if($pwd1 != $pwd2) {
        $res['success'] = false;
        $res['message'] = 'Пароли не совпадают';
        return $res;
    }
    
    return $res;
}


/**
 * Проверка почты в базе данных
 * т.е. провверка на то зарегестрирован ли пользователь
 * 
 */
function checkUserEmail($email) {
    $email = mysql_real_escape_string($email);
    
   $sql = "SELECT id FROM users WHERE email='{$email}'";
   $rs = mysql_query($sql);
   $rs = createSmartyRsArray($rs);
  
   return $rs;
}

/**
 * Функция для залогинивания пользователей
 * @$emal
 * 
 */
function  loginUser ($email, $pwd){
    $email = htmlspecialchars(mysql_real_escape_string($email));
    $pwd = md5($pwd);
    
    $sql = "SELECT * FROM users
        WHERE (`email` = '$email' and `pwd` = '$pwd')
            LIMIT 1 ";
        $rs = mysql_query($sql);
        
        $rs = createSmartyRsArray($rs);
        
        if(isset($rs[0])) {
            $rs['success'] = 1;
            
        } else {
            $rs['success'] = 0;
        }
        
        return $rs;
    
}

/**
 * 
 *Функция для обнавления данных потеля
 *
 * @param type $name
 * @param type $phone
 * @param type $adress
 * @param type $pwdCur
 * @param type $pwd1
 * @param type $pwd2
 * 
 * @return TRUE в случае успеха обновления
 */
function updateUserData ($name, $phone, $adress, $pwdCur, $pwd1, $pwd2) {
    $email = htmlspecialchars(mysql_real_escape_string($_SESSION['user']['email']));
    $name = htmlspecialchars(mysql_real_escape_string($name));
    $phone = htmlspecialchars(mysql_real_escape_string($phone));
    $adress = htmlspecialchars(mysql_real_escape_string($adress));
    $pwd1 = trim($pwd1);
    $pwd2 = trim($pwd2);
    
    $newPwd = null;
    
    if ($pwd1 && ($pwd1 == $pwd2)) {
        $newPwd = md5($pwd1);
    }
    
    $sql = "UPDATE users SET";
    
    if ($newPwd) {
       $sql .= "`pwd` = '{$newPwd}',"; 
    }
    
    $sql .= " `name` = '{$name}',
        `phone` = '{$phone}',
         `adress` = '{$adress}'
             WHERE 
             `email` = '{$email}' AND `pwd` = '{$pwdCur}'
                 LIMIT 1";
             
             $rs = mysql_query($sql);
}   