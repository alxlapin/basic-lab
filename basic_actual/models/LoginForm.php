<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model {

    public $userlogin;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    public function rules() {
        return [
            [['userlogin', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'userlogin' => 'Логин',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня'
        ];
    }

    public function validatePassword() {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', 'Неверное имя пользователя или пароль.');
            }
        }
    }

    public function login() {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        } else {
            return false;
        }
    }

    public function getUser() {
        if ($this->_user === false) {
            $this->_user = User::findByUserlogin($this->userlogin);
        }

        return $this->_user;
    }

}