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

                    echo '<td><a href="/web/table/common?file=' . $user->id . '">Take on work</a></td>';
                    echo '</tr>';
                };
            echo '</table>';

        
?>
        </div>
            <br>
                <a href="/web/table/list">Your List</a>
<?php 