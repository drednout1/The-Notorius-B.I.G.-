<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
    <style>
        table {
            width: 100%; 
            border-spacing: 7px 11px; 
        }
        td {
            padding: 5px; 
            border: 1px solid #000000; 
        }
    </style>   


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
    foreach ($tasks as $list)
            { 
?>
    <tr>
      <td><?=$list->fileName?></td>
      <td><?=$list->country?></td>
      <td><a href="download?file=<?=$list->fileName?>">Download</a></td>
    </tr>
        <?}?>
  </tbody>
</table>

    <br><a class="btn btn-success" href="common">Back</a><br><br>
<?php 

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'pdfFile')->fileInput() ?><br>

    <?= Html::submitButton('Download', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end();

    if($error){
?><br>
    <div class="alert alert-danger" role="alert">
    Download the same name file
</div><?
    };



