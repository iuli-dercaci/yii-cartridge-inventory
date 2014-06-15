<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 * Date: 09.06.14
 *
 * @var $this CartridgeController
 * @var $model Cartridge
 * @var $form CActiveForm
 */

$form = $this->beginWidget('CActiveForm', array('id' => 'cartridge-register-form' ));
?>
    <div class="row">
        <div class="form-group col-xs-5 col-xs-offset-3<?php echo $model->hasErrors('model') ? ' has-error' : '' ;?>">
            <?php echo $form->labelEx($model,'model'); ?>
            <?php echo $form->textField(
                $model,
                'model',
                array('class' => 'form-control')
            ); ?>
            <?php if ($model->hasErrors('model')): ?>
                <?php echo $form->error($model,'model', array('class' => 'help-block')); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-5 col-xs-offset-3<?php echo $model->hasErrors('manufacturer') ? ' has-error' : '' ;?>">
            <?php echo $form->labelEx($model,'manufacturer'); ?>
            <?php echo $form->textField(
                $model,
                'manufacturer',
                array('class' => 'form-control')
            ); ?>
            <?php if ($model->hasErrors('manufacturer')): ?>
                <?php echo $form->error($model,'manufacturer', array('class' => 'help-block')); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-5 col-xs-offset-3<?php echo $model->hasErrors('printer') ? ' has-error' : '' ;?>">
            <?php echo $form->labelEx($model,'printer'); ?>
            <?php echo $form->textField(
                $model,
                'printer',
                array('class' => 'form-control')
            ); ?>
            <?php if ($model->hasErrors('printer')): ?>
                <?php echo $form->error($model,'printer', array('class' => 'help-block')); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-5 col-xs-offset-3<?php echo $model->hasErrors('description') ? ' has-error' : '' ;?>">
            <?php echo $form->labelEx($model,'description'); ?>
            <?php echo $form->textField(
                $model,
                'description',
                array('class' => 'form-control')
            ); ?>
            <?php if ($model->hasErrors('printer')): ?>
                <?php echo $form->error($model,'description', array('class' => 'help-block')); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-5 col-xs-offset-3">
            <?php echo CHtml::submitButton('Добавить', array('class' => 'btn btn-primary')); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>