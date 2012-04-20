<?php $this->extend('/Admin/index'); 
    $this->start('admin_content');
?>
    <table class ="table table-bordered">
        <caption>List of Departments</caption>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>_id</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departments as $key => $value): ?>
            <tr>
                <td><?php echo $value['Department']['name'] ?></td>
                <td><?php echo $value['Department']['description'] ?></td>
                <td><?php echo $value['Department']['_id'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php $this->end(); ?>