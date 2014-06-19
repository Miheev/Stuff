<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
?>

<div id="node-<?php print $node->nid; ?>" class="node<?php print ' cnode-type-'.$node->type; if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">

    <div class="content clear-block">
        <div>
            <div class="row-head simple cf">
                <div class="hleft"><h3><?php echo $field_work[0]['view']; ?></h3></div>
                <div class="hright"><hr/></div>
            </div>
        </div>
        <div class="left">
                <?php print $field_foto_rendered; ?>
                <a href="<?php print $field_link[0]['value']; ?>" class="p-site">Личный сайт</a>
        </div>
        <div class="right">
            <h2 class="head">
                <?php $tmp= explode(' ', $title, 2); ?>
                <span><?php print $tmp[0]; ?></span>
                <span><?php print $tmp[1]; ?></span>
            </h2>
            <?php
                print $field_tfull_rendered;
            ?>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){

            htext= $('#block-views-faq_request-block_1 h2').text().trim();
            $('#block-views-faq_request-block_1 h2').remove();
            $('#block-views-faq_request-block_1').prepend(
                '<div>' +
                    '<div class="row-head simple cf">' +
                    '<div class="hleft"><h2>'+ 'Задать вопрос' +'</h2></div>' +
                    '<div class="hright"><hr/></div>' +
                    '</div>' +
                '</div>'
            );

            f_out= $('.cnode-type-our_team h2.head span').eq(0).text().trim();
            io_out= $('.cnode-type-our_team h2.head span').eq(1).text().trim().split(' ');
            $('#edit-submitted-tema').val(
                $('#edit-submitted-tema').val() +' для '+ f_out +' '+ io_out[0].charAt(0) +'. '+ io_out[1].charAt(0) +'. '
            );
        });
    </script>

</div>
