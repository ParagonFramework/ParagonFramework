<div class="container">
    <!-- View switching dialog -->
    <div id="viewSwitchingDialog" class="viewSwitchingDialog" style="display: none;">
        <form role="form" method="post" action="<?= $this->url(["action" => "changerole"]) ?>">
            <input type="hidden" name="viewSwitchingDialog_Selected" id="viewSwitchingDialog_Selected"></input>
            <h3>Choose your view</h3>
            <br/>
            <div class="form-group" style="display: inline-block;">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                        <span name="viewSwitchingDialog_Label" id="viewSwitchingDialog_Label"></span>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" name="viewSwitchingDialog_Dropdown" id="viewSwitchingDialog_Dropdown">
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default">Next</button>
                <input type="button" class="btn btn-default" name="btnCancel" value="Cancel" onclick="toggle_visibility('viewSwitchingDialog');">
            </div>
        </form>
    </div>

    <div class="lead">Products that need to be completed.</div>

	<?= $this->partial('templates/products/table.php', $this); ?>
	<!-- pagination start -->
	<?=
	$this->paginationControl($this->content['paginator'], 'Sliding', 'includes/paging.php', array(
		'urlprefix'			 => $this->url(["action" => "index"]) . '?page=',
		'appendQueryString'	 => true
	));
	?>
</div>
