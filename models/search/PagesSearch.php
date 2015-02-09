<?php

namespace fonclub\pages\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\pages;

/**
 * PagesSearch represents the model behind the search form about `common\models\pages`.
 */
class PagesSearch extends pages
{
    public $title;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = pages::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $titleField = 'title_'.Yii::$app->language;
        $dataProvider->sort->attributes[$titleField] = [
            'asc' => ['title' => SORT_ASC],
            'desc' => ['title' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);


        $query->joinWith(['items']);
        $query->andFilterWhere(['like', 'title', $this->{$titleField}]);
        $query->andFilterWhere(['like', 'locale', Yii::$app->language]);

        return $dataProvider;
    }
}
