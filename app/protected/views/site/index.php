<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 * Date: 09.06.14
 *
 * @var $this SiteController
 * @var $dataProvider CDataProvider
 * @var $form CActiveForm
 */
?>
<div class="row">
    <form class="col-xs-6">
        <?php echo CHtml::link(
            sprintf('<span class="glyphicon glyphicon-plus"></span> %s', 'Добавить позицию'),
            array('inventory/register'),
            array('class' => 'btn btn-primary')
        ); ?>
    </form>
    <form class="col-xs-6" role="form">
        <div class="form-group">
            <ul class="list-inline pull-right">
                <li><?php
                    echo CHtml::textField('search-field', null, array(
                        'class' => 'form-control pull-right',
                        'placeholder' => 'Поиск'
                    ))
                    ?></li><li><?php
                    echo CHtml::submitButton('Искать', array(
                        'name' => null,
                        'class' => 'btn btn-default pull-right'
                    ))
                    ?></li>
            </ul>
        </div>

    </form>
    <?php $this->renderPartial('_grid', compact('dataProvider')); ?>
</div>
