<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'country') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'pdfFile')->fileInput() ?>
    <?= Html::submitButton('Download', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end() ?><br><br>

    <div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Name of file</th>
      <th scope="col">Country</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
<?
    foreach ($tasks as $user)
            { 
?>
    <tr>
      <td><?=$user->fileName?></td>
      <td><?=$user->country?></td>
      <td><a href="files-upload?task=<?=$user->fileName?>">Delete</a></td>
    </tr>
        <?}?>
  </tbody>
</table>

    </div>

    <br><a class="btn btn-success" href="<?=Url::to(['/table/tasks'])?>">Your Tasks</a>
