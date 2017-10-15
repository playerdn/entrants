<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\EntrantsRecord;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EntrantsSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $cookie_id string */

$this->title = 'Entrants Records';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrants-record-index">

    <h1><?= Html::encode($this->title) ?></h1>
       
    <p>
        <?php
            $ownModel = EntrantsRecord::findOne(['cookie_id' => $cookie_id]);
            if($ownModel){
                echo Html::a('Edit My Record', 
                    ['update', 'id'=>$ownModel->id], ['class' => 'btn btn-warning   ']);
            } else {
                echo Html::a('Create Entrants Record', 
                    ['create'], ['class' => 'btn btn-success']);
            }
        ?>
    </p>
    
    <div id ="searchBlock">
        <table>
            <tr>
                <td>
                    <?= Html::beginForm(Url::toRoute('index'), 'get',['autocomplete'=>'off']); ?>
                    
                    <div class="input-group">
                        <?= Html::input('text', 'str','', [
                          'id' => 'searchPermission',
                          'class'=> 'form-control',
                          'placeholder' => 'Search...'
                        ]) ?>
                        <div class="input-group-btn">
                            <?= Html::button('<i class="glyphicon glyphicon-ok"></i>', [
                              'type' => 'submit',
                              'class' => 'btn btn-primary'
                            ]) ?>
                        </div>
                    </div>
                    <?= Html::endForm()?>
                </td>
            </tr>
        </table>
    </div>
    
    <?php 
        if($searchModel->str != '') {
            echo '<div style="height: 50px;">';
            echo '<strong style="bottom: 20px;"> Search results for: ' . $searchModel->str . '</strong>';
            echo '</div>';
        }
    ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterRowOptions' => [
            'style' => 'display: none;'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'surname',
             'group',
            // 'email:email',
             'grade',
            // 'birth_year',
            // 'is_local',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
