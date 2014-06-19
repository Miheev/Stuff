<?
/*
Template Name: Extra
*/

get_header();
?>
<div class="wrap wrap_page-content">
		<div class="wrap__inner">
        	<div class="Guestbook-index" id="Guestbook-index">
            	<div class="messages">
                <? $comments = get_comments( array( 'number' => 500, 'order' => 'DESC', 'status' => 'approve',  'post_id' => '', 'parent' => 0 ) ); ?>
                <? foreach ($comments as $c): 
				?>
                    <div class="message">
                        <div class="question">
                            <div class="image"><img src="../f/avatars/6494.jpg" /></div>
                            <div class="date"><?=$c->comment_date?></div>
                            <div class="name"><?=$c->comment_author?></div>
                            <div class="text typo"><?=$c->comment_content?></div>
                            <div class="cl"></div>
                        </div>
                        <? $a = get_comments( array( 'number' => 1, 'order' => 'DESC', 'status' => 'approve',  'post_id' => '', 'parent' => $c->comment_ID ) );  if ($a[0]->comment_ID): ?>
                        <div class="answer">
                            <div class="image"><img src="../f/avatars/6498.jpg" /></div>
                            <div class="label-answer">answer:</div>
                            <div class="date"><?=$a[0]->comment_date?></div>
                            <div class="name name_wr"><span></span></div> 
                            <div class="text typo"><?=$a[0]->comment_content?></div>
                            <div class="cl"></div>
                        </div>
                        <? endif; ?>
                    </div>
				<? endforeach; ?>
                
				</div>
                <div class="forms">
                    <div class="title typo--upc typo--brand_color">Написать сообщение</div>

<?
$args = array(
  'id_form'           => 'commentform',
  'id_submit'         => 'submit',
  'title_reply'       => __( '' ),
  'cancel_reply_link' => __( 'Отменить' ),
  'label_submit'      => __( 'Отправить' ),
 
  'comment_field' =>  '<div class="field must question">
			<div class="label">Вопрос</div>
			<div class="edit"><textarea name="comment" id="comment" aria-required="true"></textarea></div>
			<div class="cl"></div>
			<div class="err"></div>
		</div>',
 
  'comment_notes_before' => '',
 
  'comment_notes_after' => '',
 
  'fields' => apply_filters( 'comment_form_default_fields', array(
 
    'author' => 
	  '<div class="field must user_q_name">
			<div class="label">Имя</div>
			<div class="edit"><input type="text" name="author"  id="author" aria-required="true" class="max"/></div>
			<div class="cl"></div>
			<div class="err"></div>
		</div>', 
 
    'url' =>
      '<div class="field must user_q_phone">
			<div class="label">Телефон</div>
			<div class="label-caption">виден только администрации</div>
			<div class="edit"><input type="text" id="url" name="url" class="max"/></div>
			<div class="cl"></div>
			<div class="err"></div>
		</div>',
 
    'email' =>
      '<div class="field must user_q_email">
			<div class="label">Email</div>
			<div class="label-caption">виден только администрации</div>
			<div class="edit"><input type="text" id="email" name="email" aria-required="true" class="max"/></div>
			<div class="cl"></div>
			<div class="err"></div>
		</div>'
    )
  ),
); ?>

                <div class="form" name="gbfrm">
                <? comment_form($args, $post_id); ?>
                </div>
            </div>
        </div>
     </div>
</div>
<br style="clear:both" />
<br />
<?php get_footer(); ?>
