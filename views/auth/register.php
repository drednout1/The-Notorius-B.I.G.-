<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$form = ActiveForm::begin() ?>
    <p>Registration</p>
    <?= $form->field($model, 'role')->dropDownList([
        '1' => 'Notorius',
        '2' => 'citizen'
    ])?>
    <?= $form->field($model, 'login') ?>
    <?= $form->field($model, 'pass')->passwordInput() ?>
    <?= $form->field($model, 'email') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Register', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end();

if($log){
    ?><div class="alert alert-info" role="alert">
    You are already register, please
    <a class="btn btn-primary btn-sm" href="<?=Url::to(['auth/index'])?>">Login</a>
  </div><?
};

if($reg){
    ?><div class="alert alert-success" role="alert">
    You are register, please 
    <a class="btn btn-primary btn-sm" href="<?=Url::to(['auth/index'])?>">Login</a>
  </div><?
     
};
    