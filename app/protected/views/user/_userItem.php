<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 * Date: 09.06.14
 *
 * @var $user User
 */
$user = $data->name;
?>
<li class="inner-rows">
    <ul class="list-inline item-list">
        <li class="col-xs-3">
            <?php echo $user->l_name; ?> <?php echo $user->f_name; ?>
        </li>
        <li class="col-xs-3 text-muted text-small">
            <?php
            $roles = Yii::app()->authManager->getRoles($data->name->id);
            echo $roles ? reset($roles)->description : '';
            ?>
        </li>
        <li class="col-xs-2 text-muted text-small">
            <?php echo $user->email; ?>
        </li>
        <li class="col-xs-4">
            <?php
            echo CHtml::button('смена пароля', array(
                'class' => 'btn btn-primary btn-xs',
                'submit' => array('user/updatePassword'),
                'params' => array('id' => $user->id)
            ));
            ?>
            &nbsp;
            <?php
            echo CHtml::button('редактировать', array(
                'class' => 'btn btn-primary btn-xs',
                'submit' => array('user/edit'),
                'params' => array('id' => $user->id)
            ));
            ?>
            &nbsp;
            <?php
            echo CHtml::button('удалить', array(
                'class' => 'btn btn-danger btn-xs',
                'submit' => array('user/delete'),
                'params' => array('id' => $user->id),
                'confirm' => 'Вы уверены, что хотите удалить этого пользователя'
            ));
            ?>
        </li>
    </ul>
</li>
