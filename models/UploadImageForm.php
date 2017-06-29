<?php
/**
 * Created by PhpStorm.
 * User: zhangliang
 * Date: 17-6-24
 * Time: 下午12:04
 */

namespace app\models;

use yii\base\Model;

class UploadImageForm extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => ['jpg', 'png']],
        ];
    }

    /**
     * 图片上传
     * @return bool
     */
    public function upload()
    {
        if ($this->validate()) {
            $this->image->saveAs('../uploads/' . $this->image->baseName . '.' .
                $this->image->extension);
            return true;
        } else {
            return false;
        }
    }
}