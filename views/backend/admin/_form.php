<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\bootstrap\Tabs;
use yii\jui\DatePicker;
use \common\models\Languages;

/* @var $this yii\web\View */
/* @var $model common\models\pages */
/* @var $form yii\bootstrap\ActiveForm */
$languages = Languages::find()->all();
mihaildev\elfinder\Assets::noConflict($this);
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $form->errorSummary($model); ?>

    <?php
    foreach($languages as $language) {
        $items[$language->name] = [
            'label' => $language->name,
            'active' => Yii::$app->language == $language->url,
            'content' =>
                    $form->field($model, 'title_'.$language->url)->textInput(['maxlength' => 512]).'<br>'.
                    $form->field($model, 'content_'.$language->url)->widget(CKEditor::className(), [
                        'editorOptions' =>  ElFinder::ckeditorOptions(['elfinder'], ['language' => Yii::$app->language])
                    ]),
            'options' => ['id' => 'tab_'.$language->url],
        ];
    }
    echo Tabs::widget(['items' => $items]);
    ?>

    <?php echo $form->field($model, 'alias')->textInput(['maxlength' => 255]) ?>

    <?php echo $form->field($model, 'status')->dropDownList( [1 => 'on', 0 => 'off']) ?>

    <?php echo $form->field($model, 'created_at')->widget(DatePicker::className(),[
            'name' => 'created_at',
            'language' => Yii::$app->language,
            'dateFormat' => 'dd.MM.yyyy',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true
            ]
        ]);
    ?>

    <?php echo Html::activeHiddenInput($model, 'updated_at', ['value' => time()]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
