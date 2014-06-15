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
        </li><li class="col-xs-5 text-muted text-small">
        <?php echo $data->description;?>
        </li><li class="col-xs-3">
        <?php
        echo CHtml::button('изменить', array(
            'class' => 'btn btn-primary btn-xs',
            'submit' => array('storage/edit'),
            'params' => array('id' => $data->id)
        ));
        ?>
        &nbsp;
        <?php
        echo CHtml::button('удалить', array(
            'class' => 'btn btn-danger btn-xs',
            'submit' => array('storage/delete'),
            'params' => array('id' => $data->id),
            'confirm' => 'Вы уверены, что хотите удалить этот склад? Соответствующие кратриджи также будут удалены из системы'
        ));
        ?>
        </li>
    </ul>
</li>
