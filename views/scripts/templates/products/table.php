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
    <?php
        foreach ($this->paginator as $product) {
            ?>
            <tr>
                <td><?php echo $product->o_id ?></td>
                <?php foreach($this->configReaderView->getSelect() as $e) { ?>
                <td><?= call_user_func(array($product, 'get' . $e)); ?></td>
                <?php } ?>
                <td><?= $product->status ?></td>
                <td>
                    <form role="form" id="loginform" method="post" action="edit">
                        <button type="submit" class="btn btn-default">Edit</button>
                        <input type="hidden" name="o_id" value="<?= $product->o_id ?>"/>
                    </form>
                </td>
            </tr>
            <?php
        }
    ?>
</table>
