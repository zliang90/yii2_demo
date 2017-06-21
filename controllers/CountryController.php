<?php
/**
 * Created by PhpStorm.
 * User: shark.zhang
 * Date: 2017/6/21 021
 * Time: 17:22
 */

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Country;

class CountryController extends Controller
{
    public function actionIndex()
    {
        $query = Country::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy("name")
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render("index", [
            'country' => $countries,
            'pagination' => $pagination,
        ]);
    }
}