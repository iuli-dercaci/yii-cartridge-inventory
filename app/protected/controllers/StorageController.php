<?php

class StorageController extends Controller
{
    public function filters()
    {
        return array(
            'postOnly + edit, delete'
        );
    }

    public function actionIndex()
    {
        $this->title = 'Управление складскими помещениями';
        $this->breadcrumbs = array($this->title);
        $this->render('index');
    }

    public function actionCreate()
    {
        $this->title = 'Добавление';
        $this->breadcrumbs = array(
            'Управление складскими помещениями' => '/storage/index',
            $this->title
        );
        $model = new Storage();
        if (Yii::app()->request->isPostRequest) {
            $model->attributes = Yii::app()->request->GetPost(get_class($model));
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Новая складская площадь успешно добавлена');
                $this->redirect('/storage/index');
            }
            Yii::app()->user->setFlash('danger', 'Возникла проблема при добавлении складской площади');
        }
        $this->render('create', compact('model'));
    }

    public function actionEdit()
    {
        $this->title = 'Редактирование';
        $this->breadcrumbs = array(
            'Управление складскими помещениями' => '/storage/index',
            $this->title
        );
        $model = null;
        if (Yii::app()->request->getPost('id') !== null) {
            $model = Storage::model()->findByPk(Yii::app()->request->getPost('id'));
        }
        if (Yii::app()->request->getPost(get_class(Storage::model())) !== null) {
            $data = Yii::app()->request->getPost(get_class(Storage::model()));
            $model = Storage::model()->findByPk($data['id']);
            $model->attributes = Yii::app()->request->getPost(get_class($model));
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Данные складского помещения изменены успешно');
                $this->redirect('/storage/index');
            } else {
                Yii::app()->user->setFlash('danger', 'Возникла проблема при редактировании данных складского помещения');
            }
        }
        if (empty($model)) {
            Yii::app()->user->setFlash('danger', 'Указанная складская площадь не найдена');
            $this->redirect('/storage/index');
        }
        $this->render('edit', compact('model'));
    }

    public function actionDelete()
    {
        $storage = Storage::model()->findByPk(
            Yii::app()->request->getPost('id')
        );
        if ($storage && $storage->delete()) {
            Yii::app()->user->setFlash('success', 'Данные складской площади удалены успешно');
        } else {
            Yii::app()->user->setFlash('danger', 'Возникла проблема при удалении данных складской площади');
        }
        $this->redirect('/storage/index');
    }
}
