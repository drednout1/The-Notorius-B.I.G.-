<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$form = ActiveForm::begin() ?>
    <p>Authorization</p>
    <?= $form->field($model, 'role')->dropDownList([
        '1' => 'Notorius',
        '2' => 'citizen'
    ])?>
    <?= $form->field($model, 'login') ?>
    <?= $form->field($model, 'pass')->passwordInput() ?>
    
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end();

    if($reg){
        ?><div class="alert alert-danger" role="alert">
    Ooops, take another try, or
    <a class="alert-link" href="<?=Url::to(['auth/register'])?>">Register</a>
  </div><?  
    };

    