<?php
echo $this->partial('templates/header.php', null);

echo $this->partial('templates/navigationTop.php', null);
?>

<div class="container">
    <div class="page-header">
    </div>
    <p class="lead">Products that need to be completed.</p>
    <table class="table table-bordered">
		<?php
		echo $this->partialLoop("templates/products/row.php", $this->products);
		?>
	</table>
</div>
<?php
echo $this->partial('templates/footer.php', null);
?>
