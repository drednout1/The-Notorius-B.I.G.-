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
      <td><a href="common?file=<?=$user->id?>">Take on work</a></td>
    </tr>
        <?}?>
  </tbody>
</table>

        <br><a class="btn btn-success" href="list">Your List</a>
<?php 