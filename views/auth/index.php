<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$form = ActiveForm::begin() ?>
    <p>Authorization</p>
    <?= $form->field($model, 'user_id')->dropDownList([
        '0' => 'Notorius B.I.G.',
        '1' => 'citizen'
    ])?>
    <?= $form->field($model, 'login') ?>
    <?= $form->field($model, 'pass')->passwordInput() ?>
    
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end();

echo '<pre>';
print_r($users);

    if($reg){
        echo 'Ooops, take another try, or '
        ?><a href="<?=Url::to(['auth/register'])?>" name='reg'>Register</a><br><?; 
    };

    