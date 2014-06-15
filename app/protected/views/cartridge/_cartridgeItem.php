<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 * Date: 09.06.14
 *
 * @var $data Cartridge
 */
?>
<li class="inner-rows">
    <ul class="list-inline item-list">
        <li class="col-xs-2 col-xs-offset-0">
        <?php echo $data->model; ?>
        </li><li class="col-xs-2 text-muted text-small">
        <?php echo $data->manufacturer;?>
        </li>
        <li class="col-xs-3 text-muted text-small">
        <?php echo $data->printer;?>
        </li>
        <li class="col-xs-2 text-muted text-small">
        <?php echo $data->description;?>
        </li>
        <li class="col-xs-3 text-right">
        <?php
        echo CHtml::button('изменить', array(
            'class' => 'btn btn-primary btn-xs',
            'submit' => array('cartridge/edit'),
            'params' => array('id' => $data->id)
        ));
        ?>
        &nbsp;
        <?php
        echo CHtml::button('удалить', array(
            'class' => 'btn btn-danger btn-xs',
            'submit' => array('cartridge/delete'),
            'params' => array('id' => $data->id),
            'confirm' => 'Вы уверены, что хотите удалить эту модель? Кратриджи этой модели автоматически будут удалены из системы'
        ));
        ?>
        </li>
    </ul>
</li>
