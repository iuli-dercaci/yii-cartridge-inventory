<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 * Date: 10.06.14
 * @var $this InventoryController
 * @var $model CartridgeInventory
 * @var $form CActiveForm
 * @var $storages array
 * @var $cartridgeModels array
 */

$form = $this->beginWidget('CActiveForm', array('id' => 'cartridge-register-form' ));
?>
    <div class="row">
        <div class="form-group col-xs-5 col-xs-offset-3<?php echo $model->hasErrors('storage_id') ? ' has-error' : '' ;?>">
            <?php echo $form->labelEx($model,'storage_id'); ?>
            <?php echo $form->dropDownList(
                $model,
                'storage_id',
                $storages,
                array(
                    'class' => 'form-control',
                    'empty' => ''
                )
            ); ?>
            <?php if ($model->hasErrors('storage_id')): ?>
                <?php echo $form->error($model, 'storage_id', array('class' => 'help-block')); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-5 col-xs-offset-3<?php echo $model->hasErrors('cartridge_id') ? ' has-error' : '' ;?>">
            <?php echo $form->labelEx($model,'cartridge_id'); ?>
            <?php echo $form->dropDownList(
                $model,
                'cartridge_id',
                $cartridgeModels,
                array(
                    'class' => 'form-control',
                    'empty' => ''
                )
            ); ?>
            <?php if ($model->hasErrors('cartridge_id')): ?>
                <?php echo $form->error($model, 'cartridge_id', array('class' => 'help-block')); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-5 col-xs-offset-3<?php echo $model->hasErrors('quantity') ? ' has-error' : '' ;?>">
            <?php echo $form->labelEx($model,'quantity'); ?>
            <?php echo $form->textField(
                $model,
                'quantity',
                array('class' => 'form-control')
            ); ?>
            <?php if ($model->hasErrors('quantity')): ?>
                <?php echo $form->error($model,'quantity', array('class' => 'help-block')); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-5 col-xs-offset-3">
            <?php echo CHtml::submitButton('Добавить', array('class' => 'btn btn-primary')); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>