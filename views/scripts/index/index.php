<?= $this->partial('templates/header.php', $this); ?>

<?= $this->partial('templates/navigationTop.php', $this); ?>

<div class="container">
    <div class="page-header">
    </div>
    <!-- View switching dialog -->
    <div id="viewSwitchingDialog" style="display: none;">
        <div>
            <form role="form" id="viewSwitchingForm" method="post" action="<?= $this->url(["action" => "changerole" ]) ?>">
                <h3>Choose your view</h3>
                <br/>
                <br/>
                <label>View:</label>
                <select name="configReaderView">
                    <?php foreach($this->configReaderViews as $view) { ?>
                        <option><?= $view ?></option>
                    <?php } ?>
                </select>
                <br/>
                <br/>
                <button type="submit" class="btn btn-default">Next</button>
                <input type="button" class="btn btn-default" name="btnCancel" value="Cancel" onclick="toggle_visibility('viewSwitchingDialog');">
            </form>
        </div>
    </div>
    <p class="lead">Products that need to be completed.</p>

	<?= $this->partial('templates/products/table.php', $this); ?>
	<!-- pagination start -->
    <?=
	$this->paginationControl($this->content['paginator'], 'Sliding', 'includes/paging.php', array(
            'urlprefix'             => $this->url(["action" => "index" ]) . '?page=',
            'appendQueryString'     => true
	));
	?>
</div>

<?= $this->partial('templates/footer.php', null); ?>
