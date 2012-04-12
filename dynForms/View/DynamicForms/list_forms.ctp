<table class="table table-bordered table-striped">
    <caption>List of available forms</caption>
    <thead>
        <tr>
            <th>_id</th>
            <th>Description</th>
            <th>Created</th>
            <th>Link</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($forms as $key => $value): ?>
        <tr>
                <td><?php echo $value["DynamicForm"]["_id"]; ?></td>
                <td><?php echo $value["DynamicForm"]["description"]; ?></td>
                <td><?php echo date('h:i:s d-M-Y ', $value["DynamicForm"]["created"]->sec); ?></td>
                <td>
                    <a href="<?php echo Router::url(array(
                        "controller"=>"dynamicForms",
                        "action"=>"getForm",
                        $value["DynamicForm"]["_id"]
                    )); ?>" target="_blank" class="btn btn-success">
                    <i class=" icon-share"></i> View
                    </a>
                </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
