<?php
/**
 * Created by PhpStorm.
 * User: storm //Granrodeo //Uverword //live tune feat hatsuane mico
 * Date: 6/20/14
 * Time: 3:39 PM
 */

?>

<div class="sys-msg"></div>
<div class="edit-content">
    <div class="row"><strong>Логин</strong></div>
    <div class="row">
        <input type="text" autocomplete placeholder="login" />
    </div>
    <div class="row"><strong>Пароль</strong></div>
    <div class="row">
        <input type="password" autocomplete placeholder="пароль" />
    </div>
    <div class="row"><strong>ФИО</strong></div>
    <div class="row">
        <input type="text" autocomplete placeholder="фио" />
    </div>
    <div class="row"><strong>E-mail</strong></div>
    <div class="row">
        <input type="email" autocomplete placeholder="email" />
    </div>
    <div class="row"><strong>Телефон</strong></div>
    <div class="row">
        <input type="text" autocomplete placeholder="телефон" />
    </div>
    <div class="row"><strong>Юр. лицо?</strong></div>
    <div class="row">
        <select class="company">
            <option value="1">Да</option>
            <option value="0">нет</option>
        </select>
    </div>
    <div class="add-company">
        <div class="row"><strong>Название</strong></div>
        <div class="row">
            <input type="text" autocomplete placeholder="название" />
        </div>
        <div class="row"><strong>Юридический Аддрес</strong></div>
        <div class="row">
            <input type="text" autocomplete placeholder="Адрес" />
        </div>
    </div>

    <div><input type="submit" value="Добавить" /></div>

</div>

<script src="/js/admin-menu.js"></script>
<script>
    $(document).ready(function () {
        add_user();
    });
</script>


<div id="view-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="view-edit" aria-hidden="true"
     style="display: none;">
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
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


