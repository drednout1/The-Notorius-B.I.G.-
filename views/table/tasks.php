<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

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
    foreach ($tasks as $task)
            { 
?>
    <tr>
      <td><?=$task->fileName?></td>
      <td><?=$task->country?></td>
<?
if ($done) 
    {
        echo '<td><a href="done?file=' . $task->fileName . '">Download</a></td>';
    }
    else {
        echo '<td>In Work</td>';
    };
?>
    </tr>
<?}?>
  </tbody>
</table>

        <br><a class="btn btn-success" href="<?=Url::to(['/files/files-upload'])?>">Return</a>
<?php 