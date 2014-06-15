<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 * Date: 09.06.14
 *
 * @var $form CActiveForm
 * @var $model LoginForm
 */

if (Yii::app()->user->isGuest):
$form=$this->beginWidget('CActiveForm', array('id' => 'login-form' ));
?>
<div class="row">
    <div class="form-group col-xs-5 col-xs-offset-3<?php echo $model->hasErrors('email') ? ' has-error' : '' ;?>">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField(
            $model,
            'email',
            array('class' => 'form-control')
        ); ?>
        <?php if ($model->hasErrors('email')): ?>
            <?php echo $form->error($model, 'email', array('class' => 'help-block')); ?>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-5 col-xs-offset-3<?php echo $model->hasErrors('password') ? ' has-error' : '' ;?>">
        <?php echo $form->labelEx($model,'password', array('label' => 'Пароль')); ?>
        <?php echo $form->passwordField(
            $model,
            'password',
            array('class' => 'form-control')
        );
        ?>
        <?php if ($model->hasErrors('password')): ?>
        <?php echo $form->error(
            $model,
            'password',
            array('class' => 'help-block')
        );
        ?>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-5 col-xs-offset-3">
        <?php echo CHtml::submitButton(
            'Login',
            array('class' => 'btn btn-primary')
        );
        ?>
    </div>
</div>
<?php
$this->endWidget();
endif;
