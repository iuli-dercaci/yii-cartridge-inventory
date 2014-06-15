<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 * Date: 09.06.14
 *
 * @var $this Controller
 * @var $app Yii
 */
?>
<?php
$app = Yii::app();
if (!$app->user->isGuest): ?>
<nav class="navbar navbar-default" role="navigation">
    <?php
    $this->widget('zii.widgets.CMenu', array(
        'htmlOptions' => array(
            'class' => 'nav navbar-nav'
        ),
        'encodeLabel' => false,
        'activateParents' => true,
        'items' => array(
            array(
                'label' => 'Главная',
                'url' => array('site/index')
            ),
            array(
                'label' => 'Складские&nbsp;площади',
                'url' => array('storage/index'),
                'visible' => $app->user->checkAccess('level_2')
            ),
            array(
                'label' => 'Картриджи',
                'url' => array('cartridge/index'),
            ),
            array(
                'label' => 'Администрирование <b class="caret"></b>',
                'url' => '#',
                'linkOptions' => array(
                    'class' => 'dropdown-toggle',
                    'data-toggle' => 'dropdown'
                ),
                'submenuOptions' => array(
                    'class' => 'dropdown-menu'
                ),
                'items' => array(
                    array(
                        'label' => 'Обновление прав',
                        'url' => array('/administration/authSetup'),
                        'visible' => $app->user->checkAccess('admin')
                    ),
                    array(
                        'label' => '',
                        'itemOptions' => array('class' => 'divider'),
                    ),
                    array(
                        'label' => 'Управление&nbsp;пользователями',
                        'url' => array('user/index'),
                    ),
                ),
                'visible' => $app->user->checkAccess('level_1')
            ),
        )
        ));
        ?>
        <?php if (!$app->user->isGuest): ?>

        <ul class="nav navbar-nav navbar-right">
            <li>
                <p class="text-muted text-right"><?php echo $app->user->title; ?></p>
            </li>
            <li>
                <?php
                echo CHtml::link(
                    '<span class="glyphicon glyphicon-log-out"></span>',
                    array('/logout'),
                    array('class' => '')
                );
                ?>
            </li>
        </ul>

    <?php endif; ?>
    <ul class="nav navbar-nav">
</nav>
<?php else: ?>
<hr />
<?php endif; ?>
