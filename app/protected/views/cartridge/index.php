<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 * Date: 09.06.14
 */
?>
<?php $this->renderPartial('application.views.partials.addNewBtn', array(
    'data' => array(
        'url' => 'cartridge/create',
        'label' => 'Добавить'
    )
));?>
<div class="row">
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => Cartridge::model()->search(),
        'template' => '{pager}{items}',
        'itemView' => '_cartridgeItem',
        'itemsTagName' => 'ul',
        'itemsCssClass' => 'list-unstyled',
        'htmlOptions' => array(
            'id' => 'storage_list'
        ),
        'pagerCssClass' => 'text-center',
        'pager' => array(
            'selectedPageCssClass' => 'active',
            'prevPageLabel' => '&laquo;',
            'nextPageLabel' => '&raquo;',
            'lastPageCssClass' => 'hidden',
            'firstPageCssClass' => 'hidden',
            'header' => '',
            'cssFile'=>false,
            'htmlOptions' => array('class' => 'pagination')
        ),
    ));
    ?>
</div>

