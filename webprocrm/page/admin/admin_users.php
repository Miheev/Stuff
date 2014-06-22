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
    <table>
        <thead><tr></tr></thead>
        <tbody></tbody>
    </table>
</div>

<script src="/js/admin-menu.js"></script>
<script>
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


<div id="del-alert" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="del-alert-title" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="del-alert-title">Вы уверены, что хотите продолжить?</h3>
            </div>
            <div class="modal-body">
                <div class="dlg-msg"></div>
                <div class="edit-dlg">
                    <p>Если вы продолжите, этот пользователь и все его данные будут безвозвратно удалены!</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger delete-true">Удалить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>