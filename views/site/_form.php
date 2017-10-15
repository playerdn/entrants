<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntrantsRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entrants-record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'sex')->dropDownList(['m' => 'Male', 'f' => 'Female']) ?>

    <?= $form->field($model, 'group')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'secret')->textInput(['maxlength' => true, 'value' => '']) ?>

    <?= $form->field($model, 'grade')->textInput() ?>

    <?= $form->field($model, 'birth_year')->textInput() ?>

    <?= $form->field($model, 'is_local')->checkbox(['value'=> 1, 'uncheck'=>0]) ?>
  

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
