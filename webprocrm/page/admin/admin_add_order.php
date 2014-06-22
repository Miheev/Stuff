<?php
/**
 * Created by PhpStorm.
 * User: storm //Granrodeo //Uverword //live tune feat hatsuane mico //Kiamura Eri
 * Date: 6/20/14
 * Time: 3:39 PM
 */

?>

<div class="sys-msg"></div>
<div class="edit-content">
    <div class="row"><strong>Клиент</strong></div>
    <div class="row">
        <select class="client">
            <option value="1">admin</option>
            <option value="2">client</option>
        </select>
    </div>
    <div class="row"><strong>Название</strong></div>
    <div class="row">
        <input type="text" autocomplete placeholder="название" />
    </div>
    <div class="row"><strong>Услуга</strong></div>
    <div class="row">
        <select>
            <option value="0">Разработка</option>
            <option value="1">Дизайн</option>
            <option value="2">SEO</option>
        </select>
    </div>
    <div class="row"><strong>Тип</strong></div>
    <div class="row">
        <select>
            <option value="0">Активный</option>
            <option value="1">Выполненный</option>
            <option value="2">Архивный</option>
        </select>
    </div>
    <div class="row"><strong>Начало работ</strong></div>
    <div class="row">
        <input type="text" autocomplete placeholder="10-09-2010" />
    </div>
    <div class="row"><strong>Завершение работ</strong></div>
    <div class="row">
        <input type="text" autocomplete placeholder="20-10-2009" />
    </div>
    <div class="row"><strong>Статус</strong></div>
    <div class="row">
        <input type="text" autocomplete placeholder="Описание статуса проекта" />
    </div>
    <div class="edit-docs">
        <h3>Файлы проекта</h3>
        <p>Прикрепляйте файлы прямо из облачного хранилища</p>
        <div class="doc-item">
            <div class="row"><strong>Название</strong></div>
            <div class="row">
                <input type="text" autocomplete placeholder="Название" />
            </div>
            <div class="row"><strong>Ссылка</strong></div>
            <div class="row">
                <input type="text" autocomplete placeholder="https://docs.google.com/spreadsheet/ccc?key=0AjI-mfRedMo3dE1rdDRmZFhBU1R3X0ZYcG1RS1VWQUE&usp=sharing" />
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-info add-doc">Новый файл</button>
    <br>
    <br>
    <br>
    <div><input type="submit" value="Добавить" /></div>
</div>

<script src="/js/admin-menu.js"></script>
<script>
    $(document).ready(function () {
        add_order();
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


