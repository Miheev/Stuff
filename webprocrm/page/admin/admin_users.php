<?php
/**
 * Created by PhpStorm.
 * User: storm //Granrodeo //Uverword //live tune feat hatsuane mico
 * Date: 6/20/14
 * Time: 3:39 PM
 */

?>

<div class="sys-msg"></div>
<div class="order-filter" style="display: none;">
    <button type="button" class="btn btn-default">Активные</button>
    <button type="button" class="btn btn-default">Выполненные</button>
    <button type="button" class="btn btn-default">Архивные</button>
    <script>
        $(document).ready(function(){
            $('.order-filter button').click(function(){
                id= $('.order-filter button').index($(this));
                $('.edit-content tbody tr').each(function(){
                    if ( parseInt($(this).data('time')) == id)
                        $(this).css('display', 'table-row');
                    else
                        $(this).css('display', 'none');
                });
            });
        });
    </script>
</div>
<div class="edit-content">
    <table>
        <thead><tr></tr></thead>
        <tbody></tbody>
    </table>
</div>

<script>
    //Post path and $_GET query string
    CRM.getdata= CRM.basepath+'php/db/admin_req.php';
    CRM.query= {
        ru: 'rool_user',
        ro: 'rool_order',
        ao: 'add_order',
        au: 'add_user',
    };

    //temporary data store
    CRM.data= 0;

    /**
     * Table edit function
     */
    cleartbl= function() {
        $('.edit-content table thead tr').empty();
        $('.edit-content table tbody').empty();
        $('.order-filter').css('display', 'none');
    }
    createtable= function() {
        $('.edit-content').append(
        '<table>' +
            '<thead><tr></tr></thead>' +
            '<tbody></tbody>' +
        '</table>');
    }
    addtitle= function(data){
        $('.edit-content table thead tr').append('<td>'+ data +'</td>');
    }
    addcell= function(rowid, data){
        $('.edit-content table tbody tr').eq(rowid).append('<td>'+ data +'</td>');
    }
    addrow= function(call) {
        $('.edit-content table tbody').append('<tr></tr>');
    }
    /**
     * Modal Dlg Operation
     * */
        modaldefault= function(title){
            $('#view-edit').find('.modal-body .edit-dlg').empty()
                .find('.modal-body .dlg-msg').empty();

            $('#view-edit').find('.modal-title').text(title);
        }
        modalfield= function(name,data){
            $('#view-edit').find('.modal-body .edit-dlg').append('<div class="left"><strong>'+name+'</strong></div><div class="right">'+data+'</div>');
        }

    /**
     * Conditional Request functions
     */
    rool_user= function($data) {
        if (!$('.edit-content > table').length) {$('.edit-content').empty();createtable();}
        cleartbl();
        addtitle('Login');
        addtitle('ФИО');
        addtitle('E-mail');
        addtitle('Телефон');
        addtitle('Юр. лицо');

        for (j=0; j< usr.length; j++) {
            addrow();
            addcell(j, usr[j]['user_login']);
            addcell(j, usr[j]['user_name']);
            addcell(j, usr[j]['user_email']);
            addcell(j, usr[j]['user_phone']);

            if (usr[j]['user_company'] && usr[j]['user_company'] != 0) {
                addcell(j, usr[j]['company_name']);

                $('.edit-content table tbody td').last().append('<div><button type="button" class="btn btn-info company-view">Подробнее</button></div>');
            }
            else
                addcell(j, '');
        }

        $('.edit-content table tbody tr').click(function(){
            id= $('.edit-content table tbody tr').index($(this));

            location.assign('/user-more?uid='+CRM.data[id]['user_id']);
        });
        $('.company-view').click(function(e){
            e.stopPropagation();
            e.preventDefault();


            tmp= $(this).parents('tr');
            i= $('.edit-content table tbody tr').index(tmp);
            console.log(i);

            modaldefault('Юр. лицо: подробнее');
            modalfield('Наименование организации', CRM.data[i]['company_name']);
            modalfield('Адрес организации', CRM.data[i]['company_address']);
            $('#view-edit').modal();
        });
    };
    rool_order= function($data) {
        if (!$('.edit-content > table').length) {$('.edit-content').empty();createtable();}
        cleartbl();
        $('.order-filter').css('display', 'block');
        addtitle('Название');
        addtitle('Услуга');
        addtitle('Тип заказа');
        addtitle('Начало работ');
        addtitle('Завершение работ');
        addtitle('Статус');
        addtitle('Клиент');
        //addtitle('Документы');

        for (j=0; j< usr.length; j++) {
            addrow();
            $('.edit-content tbody tr').last().data('time', usr[j]['order_service']);
            addcell(j, usr[j]['order_name']);
            addcell(j, usr[j]['list_service']);
            addcell(j, usr[j]['list_time']);
            addcell(j, usr[j]['order_start']);
            addcell(j, usr[j]['order_end']);
            addcell(j, usr[j]['order_status']);
            addcell(j, usr[j]['user_name']);
            //addcell(j, usr[j]['doc_name']);

        }

        $('.edit-content table tbody tr').click(function(){
            id= $('.edit-content table tbody tr').index($(this));

            location.assign('/order-more?oid='+CRM.data[id]['order_id']);
        });
    }
    add_order= function(data) {
        $('.edit-content').empty();
        $('.order-filter').css('display', 'none');
        $('.edit-content').append(
                '<div class="row"><strong>'+'Клиент'+'</strong></div><div class="row">' +
                    '<select><option value="1">admin</option><option value="2">client</option></select>' +
                    '</div>' +
                '<div class="row"><strong>'+'Название'+'</strong></div><div class="row">' +
                    '<input type="text" autocomplete placeholder="название" />' +
                    '</div>' +
                '<div class="row"><strong>'+'Услуга'+'</strong></div><div class="row">' +
                    '<select><option value="0">Разработка</option><option value="1">Дизайн</option><option value="2">SEO</option></select>' +
                    '</div>' +
                '<div class="row"><strong>'+'Тип'+'</strong></div><div class="row">' +
                    '<select><option value="0">Активный</option><option value="1">Выполненный</option><option value="2">Архивный</option></select>' +
                    '</div>' +
                '<div class="row"><strong>'+'Начало работ'+'</strong></div><div class="row">' +
                    '<input type="text" autocomplete placeholder="10-09-2010" />' +
                    '</div>' +
                '<div class="row"><strong>'+'Завершение работ'+'</strong></div><div class="row">' +
                    '<input type="text" autocomplete placeholder="20-10-2009" />' +
                    '</div>' +
                '<div class="row"><strong>'+'Статус'+'</strong></div><div class="row">' +
                    '<input type="text" autocomplete placeholder="Описание статуса проекта" />' +
                    '</div>' +
            '<div><input type="submit" value="Добавить"/></div>'
            );

        $('input[type="submit"]').click(function(){
            postvars= [];
            $('.edit-content .row').each(function(){
                if ($(this).find('input[type="text"]').length) {
                    el= $(this).find('input[type="text"]');
                    postvars.push(el.val());
                } else if ($(this).find('select').length) {
                    el= $(this).find('select');
                    postvars.push(el.val());
                }
            });
            console.log(postvars);
            do_post(CRM.query.ao, postvars);
        });
    }
    add_user= function(data) {
        $('.edit-content').empty();
        $('.order-filter').css('display', 'none');
        $('.edit-content').append(
            '<div class="row"><strong>'+'Login'+'</strong></div><div class="row">' +
                '<input type="text" autocomplete placeholder="login" />' +
                '</div>' +
                '<div class="row"><strong>'+'Пароль'+'</strong></div><div class="row">' +
                '<input type="password" autocomplete placeholder="пароль" />' +
                '</div>' +
                '<div class="row"><strong>'+'ФИО'+'</strong></div><div class="row">' +
                '<input type="text" autocomplete placeholder="фио" />' +
                '</div>' +
                '<div class="row"><strong>'+'Email'+'</strong></div><div class="row">' +
                '<input type="email" autocomplete placeholder="email" />' +
                '</div>' +
                '<div class="row"><strong>'+'Телефон'+'</strong></div><div class="row">' +
                '<input type="text" autocomplete placeholder="телефон" />' +
                '</div>' +
//                '<div class="row"><strong>'+'Юр. лицо?'+'</strong></div><div class="row">' +
//                '<select><option value="1">Да</option><option value="0">нет</option></select>' +
//                '</div>' +
//                '<div class="add-company">' +
//                    '<div class="row"><strong>'+'Статус'+'</strong></div><div class="row">' +
//                    '<input type="text" autocomplete placeholder="Описание статуса проекта" />' +
//                    '</div>' +
//                '</div>' +
                '<div><input type="submit" value="Добавить"/></div>'
        );

        $('input[type="submit"]').click(function(){
            postvars= [];
            $('.edit-content .row').each(function(){
                if ($(this).find('input').not('[type="submit"]').length) {
                    el= $(this).find('input').not('[type="submit"]');
                    postvars.push(el.val());
                } else if ($(this).find('select').length) {
                    el= $(this).find('select');
                    postvars.push(el.val());
                }
            });
            console.log(postvars);
            do_post(CRM.query.au, postvars);
        });
    }


    do_post= function(query, vars){

        $.post( CRM.getdata+'?'+query, ((typeof vars) != 'undefined')? {data: vars}: 'empty',
            function( data, status ) {
            if (status == 'success') {
                try {
                    usr= eval('(' + data + ')');
                    console.log(usr);
                }
                catch (e) {
                    console.log(e.message);
                    console.log(data);
                }
                CRM.data= usr;
                eval( '('+ query+'('+data+')' +')');

            } else {
                $( ".sys-msg" ).text('Произошла ошибка на сервере. Попробуйте ещё раз или свяжитесь с адмигистрацией.');
            }
        });
    };

$(document).ready(function(){
    do_post(CRM.query.ru);
});
</script>


<div id="view-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="view-edit" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="view-edit"></h3>
            </div>
            <div class="modal-body">
                <div class="dlg-msg"></div>
                <div class="edit-dlg">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Изменить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-danger">Удалить</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


