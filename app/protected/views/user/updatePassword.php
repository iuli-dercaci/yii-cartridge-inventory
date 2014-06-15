<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 * Date: 09.06.14
 *
 * @var $this UserController
 * @var $form CActiveForm
 * @var $model User
 * @var $users array
 */

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-update-password-form',
    'method' => $model === false ? 'get' : 'post'
));
echo $form->hiddenField($model, 'id');
?>
<div class="row">
    <div class="form-group col-xs-5 col-xs-offset-3<?php echo $model->hasErrors('password') ? ' has-error' : '' ;?>">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField(
            $model,
            'password',
            array(
                'class' => 'form-control',
                'autocomplete' => 'off'
            )
        ); ?>
        <?php if ($model->hasErrors('password')): ?>
            <p class="has-error"><?php echo $form->error($model,'password'); ?></p>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-5 col-xs-offset-3<?php echo $model->hasErrors('repeat') ? ' has-error' : '' ;?>">
        <?php echo $form->labelEx($model,'repeat', array('label' => 'Повтор пароля')); ?>
        <?php echo $form->passwordField(
            $model,
            'repeat',
            array(
                'class' => 'form-control',
                'autocomplete' => 'off',
                'value' => ''
            )
        ); ?>
        <?php if ($model->hasErrors('repeat')): ?>
            <?php echo $form->error($model,'repeat', array('class' => 'help-block')); ?>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-5 col-xs-offset-3">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-primary')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>