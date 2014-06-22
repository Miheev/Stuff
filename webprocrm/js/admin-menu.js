/**
 * Created by storm on 6/22/14.
 */

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
    $('.edit-content table thead tr').append('<th>'+ data +'</th>');
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
    addtitle('Операции');

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

        $('.edit-content tbody tr').last().append('<td><button type="button" class="btn btn-danger delete">Удалить</button></td>');
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

    CRM.delid= 0;
    $('button.delete').click(function(e){
        e.stopPropagation();

        $('#del-alert').modal();
        CRM.delid= $('.edit-content table tbody tr').index($(this).parents('tr'));
        CRM.delid= usr[CRM.delid]['user_id'];
        console.log(CRM.delid);
    });
    $('button.delete-true').click(function(){
        $('#del-alert').modal('hide');
        $('button.delete').css('display', 'none');
        console.log(CRM.delid);
        $.post(CRM.getdata+'?delete=users&&id='+CRM.delid, function(data, status){
            console.log(status);
            if (status= 'success') {
                console.log(data);
                location.reload();
            }
        });
    });
};

add_order= function(data) {
    $.post( CRM.getdata+'?select=users',
        function( data, status ) {
            if (status == 'success') {
                try {
                    opt= eval('(' + data + ')');
                    console.log(opt);

                    $('.client').empty();
                    for(i=0; i<opt.length; i++) {
                        $('.client').append(
                            '<option value="'+ opt[i]['user_id'] +'">'+ opt[i]['user_name'] +'</option>'
                        );
                    }
                }
                catch (e) {
                    console.log(e.message);
                    console.log(data);
                }
            }
        });

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
        do_post(CRM.query.ao, postvars, true);
    });
    $('button.add-doc').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        $('.doc-item').clone().appendTo('.edit-docs');
    });
}
add_user= function(data) {
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
        do_post(CRM.query.au, postvars, true);
    });
    $('select.company').change(function(){
        if ($(this).val() == '0')
            $('.add-company').css('display', 'none');
        else
            $('.add-company').css('display', 'block');
    });
}


do_post= function(query, vars, reload){

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

                if (reload) location.reload();

            } else {
                $( ".sys-msg" ).text('Произошла ошибка на сервере. Попробуйте ещё раз или свяжитесь с адмигистрацией.');
            }
        });
};