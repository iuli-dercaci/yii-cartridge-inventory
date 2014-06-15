<?php
/**
 * Created by PhpStorm.
 * User: Iuli
 * Date: 01.06.14
 * Time: 12:17
 */

class AuthController extends Controller
{
    public function actionLogin()
    {
        $this->title = 'Авторизация';
        $model = new LoginForm();
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $model->attributes = Yii::app()->getRequest()->getPost(get_class($model));
            if ($model->validate()) {
                Yii::app()->request->redirect(Yii::app()->user->returnUrl);
            }
        }
        $this->render('login', compact('model'));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect('/login');
    }
} 