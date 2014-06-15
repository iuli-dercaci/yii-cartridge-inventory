<?php
/**
 * Created by PhpStorm.
 * User: Iuli
 * Date: 04.06.14
 * Time: 19:16
 */

class AuthBehavior extends CBehavior
{
    public function events()
    {
        return array_merge(parent::events(), array(
            'onBeginRequest'=>'checkAccess',
        ));
    }

    public function checkAccess()
    {
        /**
         * @var $app Yii
         */
        $app = Yii::app();
        $resource = $app->urlManager->parseUrl($app->request);
        if (array_key_exists($resource, $app->authManager->getOperations())){
            if ($app->user->isGuest) {
                $app->user->setFlash(
                    'danger',
                    'Запрашиваемый ресурс доступен только для авторизированных пользователей'
                );
                $app->request->redirect(Yii::app()->user->loginUrl);
            }
            if (!$app->user->checkAccess($resource)) {
                throw new CHttpException(
                    403,
                    'Извините, у вас права доступа к данной странице'
                );
            }
        }
    }
}