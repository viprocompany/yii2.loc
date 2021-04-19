jQuery(document).ready(function($) {
    $(".scroll").click(function(event){
        event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
    });

    var navoffeset=$(".agileits_header").offset().top;
    $(window).scroll(function(){
        var scrollpos=$(window).scrollTop();
        if(scrollpos >=navoffeset){
            $(".agileits_header").addClass("fixed");
        }else{
            $(".agileits_header").removeClass("fixed");
        }
    });

    $(".dropdown").hover(
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');
        }
    );

    /*
  var defaults = {
  containerID: 'toTop', // fading element id
  containerHoverID: 'toTopHover', // fading element hover id
  scrollSpeed: 1200,
  easingType: 'linear'
  };
*/
    $().UItoTop({ easingType: 'easeOutQuart' });


    $('#example').okzoom({
        width: 150,
        height: 150,
        border: "1px solid black",
        shadow: "0 0 5px #000"
    });


});
jQuery(document).ready(function( $ ) {
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });
});
$(window).load(function(){
    $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
            $('body').removeClass('loading');
        }
    });

//сокрытие открытие форм добавления комментариев к отзывам на товары на детальной странице товаров
    $('.comment-comment').on('click', function () {
        // действует на соседние элементы внутри одного родителя
        $(this).parent().find( ".comment-form_comment" ).toggleClass('hide');
    });
});


$('.example1').wmuSlider();


paypal.minicart.render();

paypal.minicart.cart.on('checkout', function (evt) {
    var items = this.items(),
        len = items.length,
        total = 0,
        i;

    // Count the number of each item in the cart
    for (i = 0; i < len; i++) {
        total += items[i].get('quantity');
    }

    if (total < 3) {
        alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
        evt.preventDefault();
    }
});





//cart start
//функция получает данные о добавлении товара в корзину
function showCart(cart){
    //внутри #modal-cart ищем класс .modal-body и вставляет  методом html туда ответ в виде данных cart о товаре
    $('#modal-cart .modal-body').html(cart);
    //показ модального окна корзины встроенным во Yii2 методом modal c добавленными в корзину данными
    $('#modal-cart').modal();
    //всплывающее  модальное окно с товарами в корзине ,если элемент #cart-sum не пустой, то мы поместим туда это значение
    let cartSum = $('#cart-sum').text() ?
    //поместим туда значение '',если в #cart-sum' пусто, но если значение есть , то оно там остается как есть
        $('#cart-sum').text() : '0$';

    if (cartSum){
        //в кнопке корзины в шапке сайта размещаем текст взятый из '#cart-sum', если cartSum  не пустая
        $('.cart-sum').text(cartSum);

       //всплывающее  модальное окно с товарами в корзине ,если элемент количества товаров #cart-qty не пустой, то мы поместим туда это значение
        let cartQty = $('#cart-qty').text() ?
            //поместим туда значение 'корзина 0$' если в #cart-qty' пусто, если значение есть , то оно там остается как есть
            $('#cart-qty').text() : '0шт.';

        if(cartQty){
            //в кнопке корзины в шапке сайта размещаем текст взятый из '#cart-qty', если cartQty  не пустая
            $('.cart-qty').text(cartQty);
        }
    }
}
//вывод товаров корзины в модальное окно на странице сайта при клике на кнопку "корзина" в шапкес сайта
function getCart(){
    $.ajax({
        //данные отправляем в экшн actionShow контроллера CartController
        url: 'cart/show',
        type: 'GET',
        success: function (res) {
            if(!res) alert('Ошибка');
            showCart(res);
        },
        error: function(){
            alert('Error!');
        }
    });
}

//полная очистка корзины от товаров одним кликом
function clearCart(){
    $.ajax({
        //данные отправляем в экшн actionClear контроллера CartController
        url: 'cart/clear',
        type: 'GET',
        success: function (res) {
            if(!res) alert('Ошибка');
            showCart(res);
        },
        error: function(){
            alert('Error!');
        }
    });
}

//ajax script . Добавляем товары в корзину
$('.add-to-cart').on('click', function () {
// забираем значение data-id из тега ссылки "В КОРЗИНУ"
      let id = $(this).data('id');
    // alert(id);
    // console.log(id);
    $.ajax({
//данные отправляем в экшн add контроллера cart
        url: 'cart/add',
        // передаем параметр id значение которого получаем из  let id
        data: {id: id},
        type: 'GET',
        success: function (res) {
            // в консоли смотрим ответ сервера, то есть return от actionAdd
            console.log(res);
            if(!res) alert('Ошибка');
            showCart(res);
        },
        error: function(){
            alert('Error!');
        }
    });
    return false;
});


//удаление товаров из корзины
//обращаемся к модальному окну modal-cart и внутри него ищем див modal-body с контентом  о продуктах  и по клику делигируем событие от modal-body всем элеметнтам с классом del-item. так как они находятся внутри именно этого класса modal-body и являются одной из ячеек в строке таблицы о каждом конкретном товаре и служат для его удаления
$('#modal-cart .modal-body').on('click', '.del-item', function () {
    // получаем айдишник крестика по атрибуту data-id из тега с классом del-item
    let id = $(this).data('id');
    $.ajax({
      // запрос отправляем на контроллер CartController в экшн actionDelItem
        url: 'cart/del-item',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            if(!res) alert('Ошибка');
            //определяем страницу, где находимся
            let now_location = document.location.pathname;
            console.log(now_location);
            //если мы находимя на странице оформления заказа. мы перезапрашиваем эту страницу. Это нужно для того чтобы изменяя количество товаров в корзине в модальном окне при нахождении на странице оформления заказа менялась информация на всей странице, а не только  в модальном окне
            if(now_location == '/cart/checkout'){
                //перезапуск
                location = 'cart/checkout';
            }
            // показываем модальное окно с корзиной
            showCart(res);
        },
        error: function(){
            alert('Error!');
        }
    });
});

// cart end
//Checkout оформление за заказа, скрипты из вёрстки

// изменение значений инпутов для количества выбраноого товара

$('.value-plus, .value-minus').on('click', function(){
    //получаем айди товара
    let id = $(this).data('id'),
        // проводим действие с количеством товара. прибавляем или отнимаем
        qty = $(this).data('qty');
    //запускаем оверлей для защиты инпутов "+" или "-" от случайного нажатия пользователем
    $('.cart-table .overlay').fadeIn();
    // отправляем запрос на изменение количества товара в заказе
    $.ajax({
         //запрос на экшн actionChangeCart
        url: 'cart/change-cart',
        //одноименные переменные индекса и количества в джаваскрипте и пхп, получаем из дата-атрибутов инпутов
        data: {id: id, qty: qty},
        type: 'GET',
        success: function(res){
            if(!res) alert('Error product!');
            // перезапрос страницы заказа
            location = 'cart/checkout';
        },
        error: function(){
            alert('Error!');
        }
    });
});

// $('.value-plus').on('click', function(){
//     var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
//     divUpd.text(newVal);
// });
//
// $('.value-minus').on('click', function(){
//     var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
//     if(newVal>=1) divUpd.text(newVal);
//
//     // удаление товара из корзины на странице оформления заказа
//     $('.close1').on('click', function(c){
//         $('.rem1').fadeOut('slow', function(c){
//             $('.rem1').remove();
//         });
//     });
// });


