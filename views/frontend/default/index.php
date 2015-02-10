<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Pages',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php \yii\widgets\Pjax::begin() ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => \yii\grid\CheckboxColumn::classname()
            ],

            'id',
            [
                'attribute' => 'title_'.Yii::$app->language,
                'format' => 'text',
                //'filter' => false
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($model){
                    if ($model->status === 1) {
                        $class = 'label-success';
                    } elseif ($model->status === 0) {
                        $class = 'label-danger';
                    }
                    $status = ( $model->status == 1 ) ? 'on' : 'off';
                    return '<span class="label ' . $class . '">' . $status . '</span>';
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', [
                    0 => 'off',
                    1 => 'on'
                ], ['class' => 'form-control', 'prompt' => Yii::t('backend', 'Status')])
            ],
            'created_at',
            'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end() ?>
</div>
