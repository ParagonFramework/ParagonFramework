<?php
echo $this->partial('templates/header.php', $this->content);

echo $this->partial('templates/navigationTop.php', null);
?>

<div class="container">
    <div class="page-header">
    </div>
    <p class="lead">Products that need to be completed.</p>

	<?php
	echo $this->partial('templates/products/table.php', $this->content);
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
