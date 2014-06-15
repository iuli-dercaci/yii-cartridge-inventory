<?php
/**
 * Created by PhpStorm.
 * User: Iuli
 * Date: 05.06.14
 * Time: 0:08
 */

class ErrorController extends Controller
{
    public function actionIndex()
    {
        $this->title = 'Ошибка';
        $this->breadcrumbs = array($this->title);
        if ($error = Yii::app()->errorHandler->error) {
            if(Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }

} 