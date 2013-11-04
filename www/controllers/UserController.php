<?php

/*
 * контроллер фийкций пользователей
 */

loadResurs('CategoriesModel');
loadResurs('UserModel');


/**
 * Cтраничка пользователя которая доступна после регистрации
 */
function indexAction($smarty) {
    if (!$_SESSION['user']) {
        redirect('/');
    }
    
    
    $rsCategories = getAllMainCatsWithChildren();
 

    $smarty->assign('pageTitle', 'Страничка пользователя');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);
    
    layOut($smarty, 'user');
    d($_SESSION['user'], 1);
}






/**
 * 
 * регистрация пользователя
 * Инициализирование сессионной переменной ($_SESSION['user'])
 * 
 * 
 * @return json массив
 */
function registerAction() {
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
    $email = trim($email);

    $pwd1 = isset($_REQUEST['pwd1']) ? $_REQUEST['pwd1'] : null;
    $pwd2 = isset($_REQUEST['pwd2']) ? $_REQUEST['pwd2'] : null;

    $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null;
    $adress = isset($_REQUEST['adress']) ? $_REQUEST['adress'] : null;

    $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
    $name = trim($name);

    $resData = null;

    //Проверка все ли данные введены и совпадают ли пароли
    $resData = checkRegisterParams($email, $pwd1, $pwd2);


    if (!$resData && checkUserEmail($email)) {
        $resData['success'] = false;
        $resData['message'] = "Пользователь с таким email ('{$email}') уже зарегестрирован";
    }

    if (!$resData) {
        $pwdMD5 = md5($pwd1);

        $userData = registerNewUser($email, $pwdMD5, $name, $phone, $adress);

        if ($userData['success']) {
            $resData['message'] = 'Пользователь успешно зарегестрирован';
            $resData['success'] = 1;

            $userData = $userData[0];

            $resData['userName'] = $userData['name'] ? $userData['name'] : $userData['email'];
            $resData['email'] = $email;

            $_SESSION['user'] = $userData;
            $_SESSION['user']['displayName'] = $userData['name'] ? $userData['name'] : $userData['email'];
           
            $json = json_encode($resData); 
        setcookie("user",$json,0x7FFFFFFF,"/");
        } else {
            $resData['success'] = 0;
            $resData['message'] = 'Ошибка регистрации';
        }
    }

    echo json_encode($resData);
}

function logoutAction() {
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
        unset($_SESSION['cart']);
    }
    
  setcookie("user","",0x7FFFFFFF,"/");
    //переадресация на главную страничку
    redirect('/');
}

/**
 * 
 * AJAX функция для регистрации пользователей
 * 
 * @return json массив данных пользователя
 * 
 */
function loginAction() {

    //C опомьщую AJAX JS передаем сюда мыло и пароль
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
    $email = trim($email);

    $pwd = isset($_REQUEST['pwd']) ? $_REQUEST['pwd'] : null;
    $pwd = trim($pwd);
    
    $remember = isset($_REQUEST['remember']) ? $_REQUEST['remember'] : null;
    
    $userData = loginUser($email, $pwd);

    if ($userData['success']) {
        $userData = $userData[0];

        $_SESSION['user'] = $userData;
        $_SESSION['user']['displayName'] = $userData['name'] ? $userData['name'] : $userData['email'];
      
        $resData = $_SESSION['user'];
        $resData['success'] = 1;
        
        $json = json_encode($resData); 
       // d($remember);
        if ($remember == 'true') {
        setcookie("user",$json,0x7FFFFFFF,"/");
        
        }
       
    } else {
        $resData['success'] = 0;
        $resData['message'] = 'Неверный логин или пароль';
    }
    
    echo json_encode($resData);
}