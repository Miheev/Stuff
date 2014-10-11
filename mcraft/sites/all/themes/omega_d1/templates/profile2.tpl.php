<?php

/**
 * @file
 * Default theme implementation for profiles.
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $title: The (sanitized) profile type label.
 * - $url: The URL to view the current profile.
 * - $page: TRUE if this is the main view page $url points too.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity-profile
 *   - profile-{TYPE}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 */
?>

<?php
$it_page= true;
if (arg(1) != $user->uid) {
    $it_user= user_load(arg(1));
    $it_page= false;
    $imgid= $it_user->picture->fid;
} else {
    $it_user= &$user;
    $imgid= $it_user->picture;
}

$res= db_query("SELECT uri FROM {file_managed} WHERE fid = :fid", array(':fid' => $imgid))->fetchField();
$user_img= theme_image_style(array('path'=>$res, 'width'=>0, 'height'=>0, 'style_name'=>'square_thumbnail', 'title'=>'Аватарка на форуме'));
?>

<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>>
        <a href="<?php print $url; ?>"><?php print $title; ?></a>
    </h2>
  <?php endif; ?>

  <div class="content"<?php print $content_attributes; ?>>
      <h2 class="user-login">Пользователь: <?php echo $it_user->name; ?></h2>
      <div class="left">
          <?php print $user_img; ?>
          <?php if ($it_page) :?>
              <div class="user-img-edit">
                  <a href="/user/<?php echo $it_user->uid; ?>/edit#edit-picture">Редактировать</a>
              </div>
          <?php endif; ?>
      </div>
      <div class="right">
    <?php
      foreach($content as $item) {
          if ($item['#field_name'] != 'field_skin')
              print render($item);
          else continue;
      }
    ?>
          <h3 class="field-label">Дата регистрации</h3>
          <div class="field field--created field--type-text field--label-above">
              <?php print format_date($it_user->created, 'short');?>
          </div>
          <h3 class="field-label">Последнее посещение</h3>
          <div class="field field--access field--type-text field--label-above">
              <?php print format_date($it_user->access, 'short');?>
          </div>
      </div>
      <h2 class="user-login">Мой скрин в игре</h2>
    <div class="other">
        <?php
            print render($content['field_skin']);
        ?>
        <div class="description">
            <p>Скин - внешний вид Вашего персонажа в игре Minecraft. Именно таким, каким Вы видите персонажа слева, Вас будут видеть другие игроки.</p>
            <p>Вы можите сменить свой скин на другой, и всё, что Вам для этого нужно, это нажать кнопочку ниже.</p>
            <p>Изображение должно быть с разрешением 64х32 формата png</p>
            <?php if ($it_page) :?>
                <div class="profile-img-edit">
                    <a href="/profile-main/<?php echo $it_user->uid; ?>/edit#edit-profile-main-field-skin">+ Загрузить скин</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
  </div>
</div>