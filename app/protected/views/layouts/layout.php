<?php
/**
 * @var $this Controller
 * @var $content string
 */
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php printf('%s: %s', Yii::app()->name,  $this->title); ?></title>
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <script src="<?php echo Yii::app()->getBaseUrl(); ?>/css/bootstrap-3.1.1/js/bootstrap.min.js"></script>
    <script src="<?php echo Yii::app()->getBaseUrl(); ?>/js/common.js"></script>
    <link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(); ?>/css/bootstrap-3.1.1/css/bootstrap.min.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(); ?>/css/style.css" type="text/css" media="screen" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <header>
        <div class="container">
            <div class="row navigation">
                <h1 class="logo text-muted">
                    <?php
                    echo CHtml::link(
                        CHtml::image(Yii::app()->baseUrl . '/images/logo.png', Yii::app()->name),
                        Yii::app()->homeUrl
                    );
                    ?>
                    Учет картриджей
                </h1>
                <?php $this->renderPartial('application.views.partials.mainNavigation'); ?>
                <?php
                $breadcrumbsOptions = isset($this->breadcrumbsOptions) ? $this->breadcrumbsOptions : array(
                    'homeLink' => CHtml::link('Главная', array('site/index')),
                    'separator'=>' / ',
                    'links' => isset($this->breadcrumbs) ? $this->breadcrumbs : array(),
                    'htmlOptions' => array('class' => 'breadcrumb')
                );
                $this->widget('zii.widgets.CBreadcrumbs', $breadcrumbsOptions);
                ?>
            </div>
        </div>
    </header>
    <main class="container">

        <?php $this->renderPartial('application.views.partials.flash');?>
        <?php echo $content; ?>
    </main>
    <footer id="footer">
        <div class="container">
            <p class="text-muted text-right copyright">&copy by Yulya</p>
        </div>
    </footer>
</body>
</html>