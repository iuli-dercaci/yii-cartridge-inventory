<?php
/**
 * @author Iuli Dercaci <iuli.dercaci@site-me.info>
 * Date: 10.06.14
 */

class InventoryController extends Controller
{

    public function actionRegister()
    {
        /**
         * @var $storage Storage
         * @var $cartridge Cartridge
         */
        $this->pageTitle = '';
        $model = new CartridgeInventory();
        $storages = array();
        foreach (Storage::model()->findAll() as $storage) {
            $storages[$storage->id] = $storage->name
                . (strlen($storage->description)
                    ? sprintf(' [%s]', trim($storage->description))
                    : '');
        }
        $cartridgeModels = array();
        foreach (Cartridge::model()->findAll() as $cartridge) {
            $cartridgeModels[$cartridge->id] = $cartridge->model
                . (strlen($cartridge->manufacturer)
                    ? sprintf(' [%s]', trim($cartridge->manufacturer))
                    : '')
                . (strlen($cartridge->printer)
                    ? sprintf(' [%s]', trim($cartridge->printer))
                    : '');
        }
        if (Yii::app()->request->isPostRequest) {
            $model->attributes = Yii::app()->request->GetPost(get_class($model));
            $model->last_modified_at = time();
            $model->last_modified_by = Yii::app()->user->id;
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Поступление картриджа оформлено успешно');
                $this->redirect('/site/index');
            }
            Yii::app()->user->setFlash('danger', 'Возникла проблема при оформлении поступления картриджа');
        }
        $this->render('register', compact('model', 'storages', 'cartridgeModels'));
    }

    public function actionEdit()
    {
        $this->title = 'Редактирование';
        $this->breadcrumbs = array(
            $this->title
        );

//        $roles = CHtml::listData(Yii::app()->authManager->getRoles(), 'name', 'description');
        $storages = array();
        foreach (Storage::model()->findAll() as $storage) {
            $storages[$storage->id] = $storage->name
                . (strlen($storage->description)
                    ? sprintf(' [%s]', trim($storage->description))
                    : '');
        }
        $cartridgeModels = array();
        foreach (Cartridge::model()->findAll() as $cartridge) {
            $cartridgeModels[$cartridge->id] = $cartridge->model
                . (strlen($cartridge->manufacturer)
                    ? sprintf(' [%s]', trim($cartridge->manufacturer))
                    : '')
                . (strlen($cartridge->printer)
                    ? sprintf(' [%s]', trim($cartridge->printer))
                    : '');
        }
        $model = null;
        if (Yii::app()->request->getPost('id') !== null) {
            $model = CartridgeInventory::model()->findByPk(Yii::app()->request->getPost('id'));
        }
        if (Yii::app()->request->getPost(get_class(CartridgeInventory::model())) !== null) {
            $data = Yii::app()->request->getPost(get_class(CartridgeInventory::model()));
            $model = CartridgeInventory::model()->findByPk($data['id']);
            $model->attributes = Yii::app()->request->getPost(get_class($model));

            /*if (Yii::app()->user->role != 'admin') {
                if ($model->role == 'admin') {
                    Yii::app()->user->setFlash('danger', 'У вас нет прав для редактирования данных администратора');
                    $this->redirect('/user/index');
                }
            }*/
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Данные изменены успешно');
                $this->redirect('/site/index');
            } else {
                Yii::app()->user->setFlash('danger', 'Возникла проблема при редактировании данных');
            }
        }
        if (empty($model)) {
            Yii::app()->user->setFlash('danger', 'Указанный пользователь не найден');
            $this->redirect('/site/index');
        }
        $this->render('edit', compact('model', 'roles', 'storages', 'cartridgeModels'));
    }

    public function actionDelete()
    {
        $cartridge = CartridgeInventory::model()->findByPk(
            Yii::app()->request->getPost('id')
        );
        if ($cartridge && $cartridge->delete()) {
            Yii::app()->user->setFlash('success', 'Запись успешно удалена');
        } else {
            Yii::app()->user->setFlash('danger', 'Возникла проблема при удалении записи');
        }
        $this->redirect('/site/index');
    }

} 