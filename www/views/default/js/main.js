/**
 * Фнкция для добавления товара в корзину
 * 
 * @param {type} ItemId
 * @returns в случае успеха обновляются данные в корзине
 * 
 */


function addToCart(itemId) {

    console.log("js - addToCart ()");
    $.ajax ({
        type: 'POST',
        async: false,
        url: '/cart/addtocart/' + itemId + '/',
       
        dataType: 'json',
        success: function(data){
            if(data['success']) {
                $('#cartCntItems').html(data['cntItems']);
                
                $('a#addCart_'+ itemId).hide();
                $('#removeCart_' + itemId).show();
            }
        }
        
})

}


