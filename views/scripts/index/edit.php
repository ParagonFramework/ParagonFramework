<?php
// $this->obj is assigned in the controller/action
$id = $this->product->o_id;

$ofh = new ParagonFramework_ViewHelper($id);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Edit Product: <?= $this->product->name ?></h3>
    </div>
    <form method="POST" enctype="multipart/form-data" class="form-horizontal" role="form" action="<?= $this->url(['action' => 'update', 'id' => null]) ?>">
        <div class="panel-body">
            <?php include($this->pathToSnipplet); ?>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary"><?= $this->t('Save'); ?></button>
            <a href="<?= $this->url(['action' => 'index', 'id' => null]) ?>" class="btn btn-default"><?= $this->t('Back'); ?></a>
        </div>
        <input type="hidden" name="objectField[id]" id="objectField-id" value="<?= $id ?>"/>
    </form>
</div>