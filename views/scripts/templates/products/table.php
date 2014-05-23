<table class="table table-bordered">
    <thead>
        <tr>
            <th>SKU</th>
            <?php foreach($this->configProduct->getSelect() as $e) { ?>
            <th><?= $e; ?></th>
            <?php } ?>
            <th>Actions</th>
        </tr>
    </thead>
    <?php
        foreach ($this->paginator as $product) {
            ?>
            <tr>
                <td><?php echo $product->o_id ?></td>
                <?php foreach($this->configProduct->getSelect() as $e) { ?>
                <td><?= call_user_func(array($product, 'get' . $e)); ?></td>
                <?php } ?>
                <td>
                    <input type="button" value="Edit"/>
                    <input type="button" value="Delete"/>
                </td>
            </tr>
            <?php
        }
    ?>
</table>
