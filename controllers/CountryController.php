<?php
/**
 * Created by PhpStorm.
 * User: shark.zhang
 * Date: 2017/6/21 021
 * Time: 17:22
 */

namespace app\controllers;

use yii\data\Sort;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Country;

class CountryController extends Controller
{
    /**
     * 国家列表页
     */
    public function actionIndex()
    {
        $attr = ['code', 'name', 'population'];

        // declare sort object
        $sort = new Sort([
                'attributes' => $attr,
            ]
        );

        // 获取db实例
        $query = Country::find();

        // 初始化分页
        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => $query->count(),
        ]);

        // 数据查询
        $countries = $query->orderBy($sort->orders)
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render("index", [
            'countries' => $countries,
            'pagination' => $pagination,
            'sort' => $sort,
        ]);
    }
}