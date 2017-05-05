<?php
/**
 * Created by PhpStorm.
 * User: Alx
 * Date: 03.02.2016
 * Time: 18:07
 */

namespace app\models;

use yii\base\Model;

class EntryForm extends Model {

    public $name;
    public $email;

    public function rules() {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email']
        ];
    }
}