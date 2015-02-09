<?php

namespace fonclub\pages\models;
use yii\db\ActiveRecord;


class PagesLang extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%pages_items}}';
    }

    public function pages()
    {
        return $this->hasOne('fonclub\pages\models\Pages', ['id' => 'page_id']);
    }
}