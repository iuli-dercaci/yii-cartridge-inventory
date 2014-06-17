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
    <?php $this->renderPartial('application.views.partials.addNewBtn', array(
        'data' => array(
            'url' => 'inventory/register',
            'label' => 'Добавить позицию'
        )
    ));?>
    <form>
    <?php echo CHtml::textField('search', '', array()) ?>
    <?php echo CHtml::submitButton('Искать', array('name' => null)) ?>
    </form>
    <?php $this->renderPartial('_grid', compact('dataProvider')); ?>
</div>
