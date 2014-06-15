<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 * Date: 09.06.14
 *
 * @var $this UserController
 */
?>
<?php $this->renderPartial('application.views.partials.addNewBtn', array(
    'data' => array(
        'url' => 'user/create',
        'label' => 'Добавить'
    )
));?>
<div class="row">
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => new CArrayDataProvider($users),
        'template' => '{pager}{items}',
        'itemView' => '_userItem',
        'itemsTagName' => 'ul',
        'itemsCssClass' => 'list-unstyled',
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
        'htmlOptions' => array(
            'id' => 'user_list'
        ),
    ));
    ?>
</div>