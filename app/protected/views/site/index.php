<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 * Date: 09.06.14
 *
 * @var $this SiteController
 * @var $dataProvider CDataProvider
 */
?>
<div class="row">
    <?php $this->renderPartial('application.views.partials.addNewBtn', array(
        'data' => array(
            'url' => 'inventory/register',
            'label' => 'Добавить позицию'
        )
    ));?>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $dataProvider,
        'template' => '{items}{pager}',
        'summaryText' => '{start} - {end} из {count}',
        'htmlOptions' => array(
            'class' => ''
        ),
        'emptyText' => 'Записей не найдено',
        'itemsCssClass' => 'table table-bordered table-hover item-list',
        'enableSorting' => false,
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
        'columns' => array(
            array(
                'name' => 'Модель',
                'headerHtmlOptions' => array(
                    'class' => 'col-xs-2',
                ),
                'value' => function($data){
                    return CHtml::encode($data->cartridge->model);
                }
            ),
            array(
                'name' => 'Принтер',
                'headerHtmlOptions' => array(
                    'class' => 'col-xs-3',
                ),
                'value' => function($data){
                    return CHtml::encode($data->cartridge->printer);
                }
            ),
            array(
                'name' => 'Месторасположение',
                'value' => function($data){
                    $name = CHtml::encode($data->storage->name);
                    $descr = CHtml::encode($data->storage->description);
                    $name .= strlen($descr) ? sprintf(' <span class="text-muted text-small">%s</span>', $descr) : '';
                    return $name;
                },
                'headerHtmlOptions' => array(
                    'class' => 'col-xs-3',
                ),
                'type' => 'raw'
            ),
            array(
                'name' => 'quantity',
                'headerHtmlOptions' => array(
                    'class' => 'col-xs-1',
                ),
            ),
            array(
                'name' => '',
                'value' => function($data){
                    return CHtml::link(
                        sprintf('<span class="glyphicon glyphicon-cog"></span> %s', 'изменить'),
                        '',
                        array(
                            'submit' => '/inventory/edit',
                            'params' => array('id' => $data->id),
                            'class' => 'btn btn-primary btn-sm'
                        )
                    );
                },
                'headerHtmlOptions' => array(
                    'class' => 'col-xs-1',
                ),
                'type' => 'raw'
            )
        ),
    ));
    ?>
</div>
