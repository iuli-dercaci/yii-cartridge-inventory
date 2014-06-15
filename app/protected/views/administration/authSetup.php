<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 * Date: 09.06.14
 *
 * @var $this AdminController
 * @var $data array
 */
?>
<div class="row">
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => new CArrayDataProvider($data),
        'template' => '{items}',
        'itemView' => '_authSetupItem',
        'itemsTagName' => 'dl',
        'htmlOptions' => array(
            'class' => 'dl-horizontal'
        )
    ));
    ?>
</div>