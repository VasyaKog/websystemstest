<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Post;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'user_id',
            'title',
//            'photo',
//            'content:ntext',
            [
                'attribute' => 'status',
                'filter' => Post::getStatuses(),
                'value' => function ($model){
                    return $model->statusLabel;
                },
            ],
            'created_at',
//            'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
