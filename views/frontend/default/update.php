<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\pages */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Pages',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="pages-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
