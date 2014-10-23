<?php
echo $this->partial('templates/header.php', $this->content);

echo $this->partial('templates/navigationTop.php', $this);
?>

<div class="container">
    <div class="page-header">
    </div>
    <!-- View switching dialog -->
    <div id="viewSwitchingDialog" style="display: none;">
        <div>
            <form role="form" id="viewSwitchingForm" method="post" action="/plugin/ParagonFramework/login/login">
                <h3>Choose your view</h3>
                <br/>
                <br/>
                <label>View:</label>
                <select>
                    <option value="view1">view1</option>
                    <option value="view2">view2</option>
                    <option value="view3">view3</option>
                    <option value="view4">view4</option>
                </select>
                <br/>
                <br/>
                <button type="submit" class="btn btn-default">Next</button>
                <input type="button" class="btn btn-default" name="btnCancel" value="Cancel" onclick="toggle_visibility('viewSwitchingDialog');">
            </form>
        </div>
    </div>
    <p class="lead">Products that need to be completed.</p>

	<?php
	echo $this->partial('templates/products/table.php', $this);
	?>
	<!-- pagination start -->
    <?=
	$this->paginationControl($this->content['paginator'], 'Sliding', 'includes/paging.php', array(
            'urlprefix'             => '/plugin/ParagonFramework/index/index?page=',
            'appendQueryString'     => true
	));
	?>
</div>
<?php
echo $this->partial('templates/footer.php', null);
?>
