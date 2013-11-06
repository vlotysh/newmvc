/**
 * Фнкция для добавления товара в корзину
 * 
 * @param {type} ItemId
 * @returns в случае успеха обновляются данные в корзине
 * 
 */


function addToCart(itemId) {

    console.log("js - addToCart ("+ itemId +")");
    $.ajax ({
        type: 'POST',
        async: false,
        url: '/cart/addtocart/' + itemId + '/',
       
        dataType: 'json',
        success: function(data){
            if(data['success']) {
                $('#cartCntItems').html(data['cntItems']);
                
                $('#addCart_'+ itemId).hide();
                $('#removeCart_' + itemId).show();
            }
        }
        
})

}

/**
 * Фнкция для удаление товара из корзины
 * 
 * @param {type} ItemId
 * @returns в случае успеха обновляются данные в корзине
 * 
 */
function removeFromCart(itemId) {
    console.log("js - removeFromCart ("+ itemId +")");
    $.ajax ({
        type: 'POST',
        async: false,
        url: '/cart/removefromcart/' + itemId + '/',
        
        dataType: 'json',
        success: function(data){
            if(data['success']) {
                $('#cartCntItems').html(data['cntItems']);
                if(data['cntItems'] == 0) {
                    $('#cartCntItems').html('пусто');
                }
                $('#removeCart_' + itemId).hide();
                $('#addCart_'+ itemId).show();
                
            }
        }
        
        
    });

}

/**
 * Функция для подсчета суммы цены оваров
 *
 * @param {type} itemId идентиикатор для склеивания полей
 * 
 */
function conversionPrice(itemId) {
     if($('#itemCnt_' + itemId).val() == 0) {
      $('#itemCnt_' + itemId).val(1);
       
    }
    
    
    var newCnt = $('#itemCnt_' + itemId).val();
    
    var itemPrice = $('#itemPrice_' + itemId).attr('value');
    var itemRealPrice = newCnt * itemPrice;
    
    $('#itemRealPrice_' + itemId).html(itemRealPrice);
}

/**
 * Подсчет суммы к оплате
 * 
 * 
 * @returns {undefined}
 */

function totalPrice() {
      var sum = 0;
        $("span.count ").each( function () {
	            sum += parseInt( $(this).text(), 10 );
                    
                    
        });
        $(".total").html(sum);
}

/**
 * Cборка данных из формы
 * 
 * @param {type} obj_form
 * @returns {unresolved}
 */
function getData(obj_form ) {
    var hData = {};
    
    $('input, textarea, select').each(function (){
        if(this.name && this.name!='') {
            hData[this.name] = this.value;
            console.log('hData['+this.name + ']=' + hData[this.name]);
        }
    
        });
       
        return hData;
}

/**
 * 
 * Ajax регистрация нового прользователя
 * 
 * @returns {undefined}
 */
function registerNewUser() {
    var postData = getData('#registerBox');
    
    $.ajax({
        type: 'POST',
        async: false,
        url: "/user/register/",
        data:postData,
        dataType:'json',
        success: function(data) {
            if(data['success']) {
            alert(data['message']);
                   $('#registerBox').hide();
                   $('#userLink').attr('href','/user/');
                   $('#userLink').html(data['userName']);
                   $('#userBox').show();
            } else {
            alert(data['message']);
            }
                 
        //блок в левом столбце
      
            
        }
        
        
    })
            
}


/**
 * Ajax Авторизация пользователя
 * 
 * 
 * @returns {undefined}
 */
function login() {
    var email = $('#loginEmail').val();
    var pwd = $('#loginPwd').val();
    if ($('#remember').is(":checked")) var remember = $('#remember').val();
    else var remember = false;
    
    var postData = "email=" + email + "&pwd="+pwd+ "&remember="+remember;
    
    $.ajax ({
        type: 'POST',
        async: false,
        url: "/user/login/",
        data: postData,
        dataType: 'json',
        success: function(data) {
            if(data['success']) {
                 $('#registerBox').hide();
                 $('#loginBox').hide();
            
                 $('#userLink').attr('href','/user/');
                  $('#grittings').html('Привет,');
                 $('#userLink').html(data['displayName']);
                 $('#userBox').show();
                
            } else {
                alert(data['message']);
            }
        }
        
        
    })
}

function showRegisterBox() {
   
         $('#registerBox').show();
         
   
    
    
}