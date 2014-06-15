<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity th e user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;

    public function authenticate()
    {
        $record = User::model()->with('storage')->findByAttributes(array(
            'email'=>$this->username
        ));
        if ($record === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        elseif (!CPasswordHelper::verifyPassword($this->password,$record->password)) {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $record->id;
            $this->setState('title', CHtml::encode(trim($record->f_name . ' ' . $record->l_name)));
            $this->setState('role', $record->role);
            $this->setState('storage_id', $record->storage_id);
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }
}