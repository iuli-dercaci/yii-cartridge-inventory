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
        $criteria = new CDbCriteria();
        $criteria->with = array('user', 'storage', 'cartridge');
        if (false != ($search = Yii::app()->request->getParam('search-field'))) {
            $search = trim(strip_tags($search));
            if (strlen($search)) {
                $criteria->addSearchCondition('cartridge.model', $search, true, 'OR');
                $criteria->addSearchCondition('cartridge.manufacturer', $search, true, 'OR');
                $criteria->addSearchCondition('cartridge.printer', $search, true, 'OR');
            }
        }
        if (!Yii::app()->user->checkAccess('level_3')){
            $criteria->compare('t.storage_id' , Yii::app()->user->storage_id);
        }

        $dataProvider = new CActiveDataProvider('CartridgeInventory', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->params['cartridgePerPage'],
            ),
        ));
        $this->render('index', compact('dataProvider'));
	}
}