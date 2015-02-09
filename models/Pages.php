<?php

namespace fonclub\pages\models;

use Yii;
use common\components\behaviors\multilingual\MultilingualBehavior;
use common\components\behaviors\multilingual\MultilingualQuery;

/**
 * This is the model class for table "{{%pages}}".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'required'],
            [['status', 'created_at'], 'integer'],
            [['alias'], 'string', 'max' => 255]
        ];
    }

    public function behaviors()
    {
        return [
            'ml' => [
                'class' => MultilingualBehavior::className(),
                'languages' => [
                    'ru' => 'Русский',
                    'en' => 'English',
                ],
                'langClassName' => \fonclub\pages\models\PagesLang::className(),
                'langForeignKey' => 'page_id',
                'tableName' => "{{%pages_items}}",
                'attributes' => ['title', 'content'],
                'rules' => [
                    [['title', 'content'], 'required'],
                    [['title'], 'string', 'max' => 255],
                ]
            ],
            'alias' => [
                'class' => 'common\components\behaviors\Alias',
                'ensureUnique' => true,
                'translit' => true,
                'replacement' => '-',
                'lowercase' => true,
                'immutable' => true,
                'attribute' => 'title_ru'
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'alias' => Yii::t('backend', 'Alias'),
            'status' => Yii::t('backend', 'Status'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At')
        ];
    }


    public function checkIsArray( $name )
    {
        if (!is_array($this->$name)) {
            $this->addError($name, $name . ' is not array!');
        }
    }

    public static function find()
    {
        $q = new MultilingualQuery(get_called_class());
        $q->multilingual();
        return $q;
    }

    public function getItems()
    {
        return $this->hasOne(PagesLang::className(), ['page_id' => 'id']);
    }

}
