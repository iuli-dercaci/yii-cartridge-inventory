<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 * Date: 09.06.14
 *
 * @var $this StorageController
 * @var $model Storage
 * @var $form CActiveForm
 */

$form = $this->beginWidget('CActiveForm', array('id' => 'storage-create-form' ));
?>
    <div class="row">
        <div class="form-group col-xs-5 col-xs-offset-3<?php echo $model->hasErrors('name') ? ' has-error' : '' ;?>">
            <?php echo $form->labelEx($model,'name'); ?>
            <?php echo $form->textField(
                $model,
                'name',
                array('class' => 'form-control')
            ); ?>
            <?php if ($model->hasErrors('name')): ?>
                <?php echo $form->error($model,'name', array('class' => 'help-block')); ?>
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
            <?php if ($model->hasErrors('description')): ?>
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