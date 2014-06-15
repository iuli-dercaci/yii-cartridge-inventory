<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 * Date: 09.06.14
 *
 * @var $data Storage
 */
?>
<li class="inner-rows">
    <ul class="list-inline item-list">
        <li class="col-xs-3 col-xs-offset-1">
            <?php echo $data->name; ?>
        </li>
        <li class="col-xs-3 text-muted text-small">
            <?php
            $roles = Yii::app()->authManager->getRoles($data->id);
            echo $roles ? reset($roles)->description : '';
            ?>
        </li>
        <li class="col-xs-5">
            <?php
            echo CHtml::button('смена пароля', array(
                'class' => 'btn btn-primary btn-xs',
                'submit' => array('user/updatePassword'),
                'params' => array('id' => $data->id)
            ));
            ?>
            &nbsp;
            <?php
            echo CHtml::button('редактировать', array(
                'class' => 'btn btn-primary btn-xs',
                'submit' => array('user/edit'),
                'params' => array('id' => $data->id)
            ));
            ?>
            &nbsp;
            <?php
            echo CHtml::button('удалить', array(
                'class' => 'btn btn-danger btn-xs',
                'submit' => array('user/delete'),
                'params' => array('id' => $data->id),
                'confirm' => 'Вы уверены, что хотите удалить этого пользователя'
            ));
            ?>
        </li>
    </ul>
</li>
