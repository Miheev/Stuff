<?php
/**
 * Created by PhpStorm.
 * User: storm
 * Date: 6/13/14
 * Time: 3:28 PM
 */

$res= $link->query('select * from docs order by doc_date');

foreach ($res as $item) :?>
    <section>
        <h3><?php echo $item['doc_name']; ?></h3>
        <p>
            <a href="<?php echo $item['doc_path']; ?>">Скачать</a>
            <em>Дата загрузки: <?php echo $item['doc_date']; ?></em>
        </p>
    </section>
<?php    endforeach;
?>