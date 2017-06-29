<?php
/**
 * Created by PhpStorm.
 * User: zhangliang
 * Date: 17-6-24
 * Time: 上午12:22
 */

namespace app\models;

use yii\base\Model;

class RegistrationForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $subscriptions;
    public $photos;

    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'subscriptions' => 'Subscriptions',
            'photos' => 'Photos',
        ];
    }

    public function rules()
    {
        return [
            [['username', 'password', 'email', 'photos'], 'required'],
            ['email', 'email'],
        ];
    }
}