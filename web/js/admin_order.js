$(function () {
//меню ссылок на страницы заказов админки находится в классе sidebar-menu, файла sidebar.php модуля админки. берем проходим по нему и из адресной строки получаем адрес для каждого пункта меню
    $('.sidebar-menu a').each(function () {
        //адрес для каждого пункта меню из АДРЕСНОЙ СТРОКИ
        let location = window.location.protocol + '//' +
            window.location.host + window.location.pathname;
//адрес атрибута из ссылки(тега)
        let link = this.href;
        //если адрес из адресной строки и адрес href в теге совпадают
        if (link == location){
            //то такого пункта меню  устанавливаем active, при этом для прочих пунктов меню этот класс удаляется removeClass. Это нужно для того , что в верстке первый пункт меню по умолчанию имеет класс active
            $('.sidebar-menu li').removeClass('active');
            // //то для такого пункта меню устанавливаем класс active,
            $(this).parent().addClass('active');
            //пункт меню "Заказы", откуда выпадает две ссылки. устанавливаем не только для непосредственного родителя , но и для treeview
            $(this).closest('.treeview').addClass('active');

        }
    });
});