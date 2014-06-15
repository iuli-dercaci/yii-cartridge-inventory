<?php

class SiteController extends Controller
{
    public $breadcrumbsOptions;

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index'),
                'users'=>array('@'),
            ),
            array('deny',
                'actions'=>array('index'),
                'users'=>array('*'),
            ),
        );
    }

	public function actionIndex()
	{
        $this->title = 'Главная';
        $this->breadcrumbsOptions = array(
            'homeLink' => false,
            'separator'=>' / ',
            'links' => array($this->title),
            'htmlOptions' => array('class' => 'breadcrumb')
        );
        $this->breadcrumbs = array('');
        $user = null;
        $criteria = array(
            'with' => array('user', 'storage', 'cartridge'),
        );
        if (!Yii::app()->user->checkAccess('level_3')){
            $criteria['condition'] = 't.storage_id = :storage_id';
            $criteria['params'] = array(':storage_id' => Yii::app()->user->storage_id);
        }
        var_dump($user);
        $dataProvider = new CActiveDataProvider('CartridgeInventory', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->params['cartridgePerPage'],
            ),
        ));

		$this->render('index', compact('dataProvider'));
	}
}