<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <?php foreach($this->configReaderView->getSelect() as $e) { ?>
            <th><?= $e; ?></th>
            <?php } ?>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <?php foreach ($this->paginator as $product) { ?>
        <tr>
            <td><?= $product->o_id ?></td>
            <?php foreach($this->configReaderView->getSelect() as $e) { ?>
            <td><?= call_user_func(array($product, 'get' . $e)); ?></td>
            <?php } ?>
            <td><?= $product->status ?></td>
            <td><?= $this->pgProductEditForm($product->o_id, $this->url(["action" => "edit" ])) ?></td>
        </tr>
        <?php } ?>
</table>
