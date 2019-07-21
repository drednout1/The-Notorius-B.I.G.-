<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

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
                echo '<td><a href="/web/files/files-upload?task=' . $user->fileName . '">X</a></td>';
                // echo '<td><a href="update?task=' . $user->id . '">Modify</a></td>';
                echo '</tr>';
            };
        echo '</table>';
?>
    </div>
