<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\pages */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Pages',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
