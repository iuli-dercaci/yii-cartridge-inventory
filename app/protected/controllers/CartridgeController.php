<?php
class CartridgeController extends Controller
{
    public function actionIndex()
    {
        $this->title = 'Модели катриджей';
        $this->breadcrumbs = array($this->title);
        $this->render('index', compact('model'));
    }

    public function actionCreate()
    {
        $this->title = 'Добавление';
        $this->breadcrumbs = array(
            'Модели катриджей' => array('cartridge/index'),
            $this->title
        );
        $model = new Cartridge();
        if (Yii::app()->request->isPostRequest) {
            $model->attributes = Yii::app()->request->getPost(get_class($model));
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Новая модель картриджа была успешно добавлена');
                $this->redirect('/cartridge/index');
            } else {
                Yii::app()->user->setFlash('danger', 'Возникла проблема при добавлении новой модели картриджа');
            }
        }
        $this->render('create', compact('model'));
    }

    public function actionEdit()
    {
        $this->title = 'Редактирование';
        $this->breadcrumbs = array(
            'Модели катриджей' => array('cartridge/index'),
            $this->title
        );

        $model = null;
        if (Yii::app()->request->getPost('id') !== null) {
            $model = Cartridge::model()->findByPk(Yii::app()->request->getPost('id'));
        }
        if (Yii::app()->request->getPost(get_class(Cartridge::model())) !== null) {
            $data = Yii::app()->request->getPost(get_class(Cartridge::model()));
            $model = Cartridge::model()->findByPk($data['id']);
            $model->attributes = Yii::app()->request->getPost(get_class($model));
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Данные модели картриджа изменены успешно');
                $this->redirect('/cartridge/index');
            } else {
                Yii::app()->user->setFlash('danger', 'Возникла проблема при редактировании данных модели картриджа');
            }
        }
        if (empty($model)) {
            Yii::app()->user->setFlash('danger', 'Указанная модель картриджа не найдена');
            $this->redirect('/cartridge/index');
        }

        $this->render('edit', compact('model'));
    }

    public function actionDelete()
    {
        $cartridge = Cartridge::model()->findByPk(
            Yii::app()->request->getPost('id')
        );
        if ($cartridge && $cartridge->delete()) {
            Yii::app()->user->setFlash('success', 'Модель удалена успешно');
        } else {
            Yii::app()->user->setFlash('danger', 'Возникла проблема при удалении модели');
        }
        $this->redirect('/cartridge/index');
    }
}