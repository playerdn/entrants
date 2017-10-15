<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EntrantsRecord */

$title = $model->isNewRecord ? 'Create' : 'Update';

$breadcrumLabel ='';
if($model->isNewRecord) {
    $this->title = 'Create Entrants Record';
    $breadcrumLabel = 'Create';
} else {
    $breadcrumLabel = $model->surname . " " .$model->name;
    $this->title = 'Update: ' . $breadcrumLabel;
    
}


$this->params['breadcrumbs'][] = ['label' => $breadcrumLabel, 
  'url' => ['view', 'id' => $model->id]];

?>
<div class="entrants-record-update">

    <h1><?= Html::encode($this->title) ?></h1>
        
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
