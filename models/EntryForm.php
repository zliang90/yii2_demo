<?php
/**
 * Created by PhpStorm.
 * User: shark.zhang
 * Date: 2017/6/21 021
 * Time: 8:39
 */

namespace app\models;

use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $email;

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],
        ];
    }
}
