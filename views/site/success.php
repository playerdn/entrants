<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\EntrantsRecord */

$this->title = $model->name;

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrants-record-view">

    <h1>Thanks! All data was successfully saved!</h1>

    
    <p>You can edit it or view full entrant's list</p>
    <?php
        echo Html::a("View list &raquo;", 
            Url::to(['index']),
            [
                'class' => 'btn btn-default',
                
            ]);
            echo "\n";
            
            echo Html::a("Edit my record &raquo;", 
            Url::to(['update', 'id' => $model->id]),
            [
                'class' => 'btn btn-default',
                
            ]);
            echo "\n";
    ?>
  

</div>
