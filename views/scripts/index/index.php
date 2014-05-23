<?php
echo $this->partial('templates/header.php', $this->content);

echo $this->partial('templates/navigationTop.php', null);
?>

<div class="container">
    <div class="page-header">
    </div>
    <p class="lead">Products that need to be completed.</p>

	<?php
	echo $this->partial('templates/products/table.php', $this);
	?>
	<!-- pagination start -->
	<?=
	$this->paginationControl($this->paginator, 'Sliding', 'includes/paging.php', array(
<<<<<<< HEAD
            'urlprefix'             => '/plugin/ParagonFramework/index/index?page=',
            'appendQueryString'     => true
	));
	?>
=======
		'urlprefix'			 => '?page=',
		'appendQueryString'	 => true
	));
	?>
	<!-- pagination end -->
>>>>>>> c5c2f85128e0ddbe4eaefe90d319930e70bad266
</div>
<?php
echo $this->partial('templates/footer.php', null);
?>
