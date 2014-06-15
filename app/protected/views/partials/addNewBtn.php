<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 * Date: 09.06.14
 *
 * @var $data array
 */
?>
<div class="text-center">
    <?php echo CHtml::link(
        sprintf('<span class="glyphicon glyphicon-plus"></span> %s', $data['label']),
        array($data['url']),
        array('class' => 'btn btn-primary btn-sm')
    ); ?>
</div>
<hr/>