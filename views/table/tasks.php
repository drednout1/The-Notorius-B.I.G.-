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
            echo '<table>';
            echo '<br>';
                foreach ($tasks as $user)
                { 
                    $counter = 0;
                    $counter1 = 0;
                    
                    echo '<tr>';
                    echo '<td>' . $user->fileName . '</td>';
                    echo '<td>' . $user->country . '</td>';
                    
                if ($done) 
                {
                    echo '<td><a href="done?file=' . $user->fileName . '">Download</a></td>';
                } 
                else {
                    echo '<td>In Work</td>';
                };
                    
                    echo '</tr>';
                };
            echo '</table>';
?>
        </div>
            <br>
            <a href="<?=Url::to(['/files/files-upload'])?>">Your List</a>
<?php 