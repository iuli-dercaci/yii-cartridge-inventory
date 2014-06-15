<?php
/**
 * Created by PhpStorm.
 * User: Iuli
 * Date: 01.06.14
 * Time: 11:39
 */

class AdministrationController extends Controller
{
    public function actionAuthSetup()
    {
        $this->title = 'Обновление прав доступа';
        $this->breadcrumbs = array($this->title);
        /**
         * @var $auth CDbAuthManager
         */
        $data = array();
        try {
            //empty database tables
            Yii::app()->db->createCommand('DELETE FROM "AuthAssignment"')->execute();
            Yii::app()->db->createCommand('DELETE FROM "AuthItem"')->execute();
            Yii::app()->db->createCommand('DELETE FROM "AuthItemChild"')->execute();

            $auth = Yii::app()->authManager;
            //operations
            $auth->createOperation('storage/index');
            $auth->createOperation('storage/create');
            $auth->createOperation('storage/edit');
            $auth->createOperation('storage/delete');
            $auth->createOperation('user/index');
            $auth->createOperation('user/create');
            $auth->createOperation('user/edit');
            $auth->createOperation('user/delete');
            $auth->createOperation('user/updatePassword');
            $auth->createOperation('administration/authSetup');

            //roles list
            $role = $auth->createRole('level_5', 'Спец. тех. отдела (заправщик)');
            $role = $auth->createRole('level_4', 'Спец. тех. отдела (склад)');
            $role->addChild('level_5');
            $role = $auth->createRole('level_3', 'Спец. сервис-центра (цех)');
            $role->addChild('level_4');
            $role = $auth->createRole('level_2', 'Спец. контакт-центра');
            $role->addChild('level_3');
            $role->addChild('storage/index');
            $role = $auth->createRole('level_1', 'Спец. сервис-центра (ЗУ2)');
            $role->addChild('level_2');
            $role->addChild('user/index');
            $role->addChild('user/create');
            $role->addChild('user/edit');
            $role->addChild('user/delete');
            $role->addChild('user/updatePassword');
            $role->addChild('storage/create');
            $role->addChild('storage/edit');
            $role->addChild('storage/delete');
            $role = $auth->createRole('admin', '***Aдминистратор***');
            $role->addChild('level_1');
            $role->addChild('administration/authSetup');

            //add existing users
            $users = CHtml::listData(User::model()->findAll(), 'role', 'id');
            foreach ($users as $role => $id) {
                $auth->assign($role, $id);
            }

            //result
            $mapping = array(
                0 => 'operation',
                1 => 'task',
                2 => 'role'
            );
            $items = array();
            foreach ($auth->getAuthItems() as $item) {
                $items[$mapping[$item->type]][] = array($item->name => $item->description);
            }
            foreach ($items as $itemType => $item) {
                $data[] = array(
                    'id' => array_search($itemType, $mapping),
                    $itemType => $item
                );
            }

            Yii::app()->user->setFlash('success', 'Список ролей и права доступа успешно созданы');

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $this->render('authSetup', compact('data'));
    }
} 