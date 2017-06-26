<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\EntryForm;
use app\models\MyUser;
use app\models\RegistrationForm;
use app\models\UploadImageForm;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\web\UploadedFile;
use app\models\ContactForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays say test page.
     * @param string $message
     * @return string
     */
    public function actionSay($message = 'Hello')
    {
        return $this->render('say', [
            'message' => $message
        ]);
    }

    /**
     * Display entry
     * @return string
     */
    public function actionEntry()
    {
        $model = new EntryForm;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->render("entry-confirm", ["model" => $model]);
        }
        return $this->render("entry", ["model" => $model]);
    }

    /**
     * 小部件测试
     * @return string
     */
    public function actionTestWidget()
    {
        return $this->render("testWidget");
    }

    /**
     * 响应一个json类型的字符串
     * @return Response
     */
    public function actionTest()
    {
//        第一种方法：
        /*Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
        return [
            'id' => 1,
            'name' => 'Hippo',
            'age' => 28,
            'country' => 'China',
            'city' => 'BeiJing'
        ];*/

//        第二种方法：
        return $this->asJson([
            'id' => 1,
            'name' => 'Hippo',
            'age' => 28,
            'country' => 'China',
            'city' => 'BeiJing'
        ]);
    }

    /**
     * 维护页面
     */

    public function actionMaintenance()
    {
        echo '<h1>系统正在维护中...</h1>';
    }

    public function actionRegistration()
    {
        $mRegistration = new RegistrationForm;

        return $this->render('registration', ['model' => $mRegistration]);
    }

    public function actionShowFlash()
    {
        $session = Yii::$app->session;

        // set a flash meaage name as "greeting"
        $session->setFlash('greeting', 'Hello World!');

        return $this->render("showflash");
    }

    /**
     * 图片上传
     * @return string
     */
    public function actionUploadImage()
    {
        $model = new UploadImageForm;

        if (Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstance($model, 'image');

            if ($model->upload()) {
                // file is uploaded Successfully
                echo "File successfully uploaded";

            }
        }
        return $this->render("upload", ['model' => $model]);
    }

    public function actionDataProvider()
    {
        // ActiveDataProvider
/*        $query = MyUser::find();
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);
        // returns an array of users objects
        $users = $provider->getModels();
        var_dump($users);*/


        $count = Yii::$app->db->createCommand('SELECT COUNT(1) FROM user')->queryScalar();

        $provider = new SqlDataProvider([
            'sql' => 'SELECT * FROM user',
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 5,
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
        return $this->asJson($users);
    }

    public function actionId() {
        return Yii::$app->id;
    }

    /**
     * 简单随机字符串生成
     * @param int $length
     * @return string
     */
    public function actionRandString($length=8) {
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = len($str) - 1;

        $result = '';

        for( $i=0; i < $length; $i++) {
            $result += $str[rand(0,$max)];
        }

        return $result;
    }

}
