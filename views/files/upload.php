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
<?php 

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $form->field($model, 'country') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'pdfFile')->fileInput() ?>

    <?= Html::submitButton('Download', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end() ?>

    <div>
<?php 
        echo '<table>';
        echo '<br>';
            foreach ($tasks as $user)
            { 
                $counter = 0;
                $counter1 = 0;
                
                echo '<tr>';
                echo '<td>' . $user->fileName . '</td>';
                echo '<td>' . $user->country . '</td>';
                echo '<td><a href="files-upload?task=' . $user->fileName . '">Delete</a></td>';
                echo '</tr>';
            };
        echo '</table>';
?>
    </div>

    <br>
            <a href="<?=Url::to(['/table/tasks'])?>">Your Tasks</a>
