<table class="table table-bordered table-condensed">
    <thead>
        <tr>
            <th>ID</th>
            <?php foreach($this->configReaderView->getSelect() as $e) { ?>
            <th><?= $e; ?></th>
            <?php } ?>
            <th>Status</th>
            <th>Last Modification Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <?php foreach ($this->paginator as $product) { ?>
        <tr>
            <td><?= $product->o_id ?></td>
            <?php foreach($this->configReaderView->getSelect() as $e) { ?>
            <td><?php var_dump(call_user_func(array($product, 'get' . $e))); ?></td>
            <?php } ?>
            <td><?= $product->status ?></td>
			<td><?= date("d.M.Y H:i:s", $product->getModificationDate()) ?></td>
            <td><?= $this->pgProductEditForm($product->o_id, $this->url(["action" => "edit" ])) ?></td>
        </tr>
        <?php } ?>
</table>
