<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\forms\search\CommentApiSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="comment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'subject_name') ?>
        </div>

        <div class="col-6">
            <?= $form->field($model, 'subject_id') ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'username') ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'created_at') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
