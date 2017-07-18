<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\data\SqlDataProvider;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }

    public function actionSay($message = 'hello world') {
        echo $message . "\n";
    }

    public function actionGetUsers($size = 10){
        $count = Yii::$app->db->createCommand('SELECT COUNT(1) FROM country')->queryScalar();

        $provider = new SqlDataProvider([
            'sql' => 'SELECT * FROM country',
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => $size > 0 ? $size : 10,
            ],
            'sort' => [
                'attributes' => [
                    'id',
                    'name',
                    'email',
                ],
            ],
        ]);

        // returns json string of data rows
        $users = $provider->getModels();

        echo json_encode($users);
    }

}
