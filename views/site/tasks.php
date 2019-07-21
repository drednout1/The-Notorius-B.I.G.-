
    <div id="task">
        <form action="/tasks/save">
            New Task <input id='text' type="text" name="text" value="<?= $text ?>"><br><br>
            <button id="submit" type="submit">Confirm</button>
        </form><br>
    </div>    
        <div>
            <?
            foreach ($tasks as $user)
            {
                echo '<br>';
                echo $user->task;
                echo '<br>';
                    echo '<table>';

                    $counter = 0;
                    $counter1 = 0;
                    echo '<tr>';
                    echo '<td>' . $user->id . '</td>';
                    echo '<td><a href="delete?task=' . $user->task . '">X</a></td>';
                    echo '<td><a href="update?task=' . $user->task . '">Modify</a></td>';
                    echo '</tr>';
                    echo '</table>';
            };
        ?>
        </div><br>
        
    <a href="/auth/logout" name='logout'>Logout</a><br><br>