<?php $this->extend('/Admin/index');
    $this->start('admin_content');
 ?>
<table class="table table-bordered table-striped ">
    <caption>List of Users</caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Escalation</th>
        </tr>
    </thead>
    
<tbody>
<?php foreach ($users as $key => $user): ?>
    <tr>
    <?php foreach ($user['User'] as $key => $value) : ?>
        
            <td><?php echo $value ?></td>

    <?php endforeach; ?>
    </tr>
<?php endforeach; ?>
</tbody>
</table>
<?php $this->end(); ?>