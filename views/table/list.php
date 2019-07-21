<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
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
        echo '<table>';
        echo '<br>';
            foreach ($tasks as $list)
            { 
                $counter = 0;
                $counter1 = 0;
                
                echo '<tr>';
                echo '<td>' . $list->fileName . '</td>';
                echo '<td>' . $list->country . '</td>';
                echo '<td><a href="/web/table/download?file=' . $list->fileName . '">Download</a></td>';
                echo '</tr>';
            };
        echo '</table>';

        
?>
    </div>
        <br>
            <a href="/web/table/common">Back</a>
<?php 

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'pdfFile')->fileInput() ?>

    <?= Html::submitButton('Download', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end() ?>