<?php
/**
 * Created by PhpStorm.
 * User: Iuli
 * Date: 23.05.14
 * Time: 23:08
 */

class UserController extends Controller
{
    public function filters()
    {
        return array(
            'postOnly + edit, delete, updatePassword'
        );
    }
    public function actionIndex()
    {
        $this->title = 'Управление пользователями';
        $this->breadcrumbs = array($this->title);
        $data = User::model()->getFullNameList(Yii::app()->user->role == 'admin');
        $users = array();
        foreach ($data as $id => $name) {
            $users[] = (object)array(
                'id' => $id,
                'name' => $name
            );
        }
        $this->render('index', compact('users'));
    }

    public function actionCreate()
    {
        $this->title = 'Добавление';
        $this->breadcrumbs = array(
            'Управление пользователями' => '/user/index',
            $this->title
        );
        $roles = CHtml::listData(Yii::app()->authManager->getRoles(), 'name', 'description');
        if (Yii::app()->user->role != 'admin' && array_key_exists('admin', $roles)) {
            unset($roles['admin']);
        }
        $workPlace = array();
        foreach(Storage::model()->findAll() as $storage) {
            $item = $storage->name;
            $item .= strlen($storage->description) ? sprintf(' [%s]', $storage->description) : '';
            $workPlace[$storage->id] = $item;
        }
        $model = new User;
        if (Yii::app()->request->isPostRequest) {
            $model->attributes = Yii::app()->request->getPost(get_class($model));
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Пользователь добавлен успешно');
                $this->redirect('/user/index');
            } else {
                Yii::app()->user->setFlash('danger', 'Возникла проблема при добавлении пользователя');
            }
        }
        $this->render('create', compact('model', 'roles', 'workPlace'));
    }

    public function actionEdit()
    {
        $this->title = 'Редактирование';
        $this->breadcrumbs = array(
            'Управление пользователями' => '/user/index',
            $this->title
        );

        $roles = CHtml::listData(Yii::app()->authManager->getRoles(), 'name', 'description');
        $workPlace = array();
        foreach(Storage::model()->findAll() as $storage) {
            $item = $storage->name;
            $item .= strlen($storage->description) ? sprintf(' [%s]', $storage->description) : '';
            $workPlace[$storage->id] = $item;
        }
        $model = null;
        if (Yii::app()->request->getPost('id') !== null) {
            $model = User::model()->findByPk(Yii::app()->request->getPost('id'));
        }
        if (Yii::app()->request->getPost(get_class(User::model())) !== null) {
            $data = Yii::app()->request->getPost(get_class(User::model()));
            $model = User::model()->findByPk($data['id']);
            $attributes = Yii::app()->request->getPost(get_class(User::model()));
            $model->attributes = $attributes;
            if (Yii::app()->user->role != 'admin') {
                if ($model->role == 'admin') {
                    Yii::app()->user->setFlash('danger', 'У вас нет прав для редактирования данных администратора');
                    $this->redirect('/user/index');
                }
                if (array_key_exists('admin', $roles)) {
                    unset($roles['admin']);
                }
            }
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Данные пользователя изменены успешно');
                $this->redirect('/user/index');
            } else {
                Yii::app()->user->setFlash('danger', 'Возникла проблема при редактировании данных пользователя');
            }
        }
        if (empty($model)) {
            Yii::app()->user->setFlash('danger', 'Указанный пользователь не найден');
            $this->redirect('/user/index');
        }
        $this->render('edit', compact('model', 'roles', 'workPlace'));
    }

    public function actionDelete()
    {
        $user = User::model()->findByPk(
            Yii::app()->request->getPost('id')
        );
        if ($user && $user->delete()) {
            Yii::app()->user->setFlash('success', 'Данные пользователя успешно удалены');
        } else {
            Yii::app()->user->setFlash('danger', 'Возникла проблема при удалении пользователя');
        }
        $this->redirect('/user/index');
    }

    public function actionUpdatePassword()
    {
        $this->title = 'Смена пароля';
        $this->breadcrumbs = array(
            'Управление пользователями' => '/user/index',
            $this->title
        );
        $model = null;
        if (Yii::app()->request->getPost('id') !== null) {
            $model = User::model()->findByPk(Yii::app()->request->getPost('id'));
            $model->password = '';
            $model->repeat = '';
        }
        if (Yii::app()->request->getPost(get_class(User::model())) !== null) {
            $data = Yii::app()->request->getPost(get_class(User::model()));
            $model = User::model()->findByPk($data['id']);
            $model->scenario = 'update_password';
            $model->attributes = Yii::app()->request->getPost(get_class($model));
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Данные пользователя изменены успешно');
                $this->redirect('/user/index');
            } else {
                Yii::app()->user->setFlash('danger', 'Возникла проблема при редактировании данных пользователя');
            }
        }

        $this->render('updatePassword', compact('model'));
    }
} 