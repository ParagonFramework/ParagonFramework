<p class="lead"><?= $this->t('Products that need to be completed') ?></p>
<div id="content">
    <table id="table"></table>
    <div id="pager"></div>
</div>


<!--?= $this->partial('templates/products/table.php', $this); ?-->
<!-- pagination start -->
<!--?=
$this->paginationControl($this->content['paginator'], 'Sliding', 'includes/paging.php', array(
    'urlprefix'			 => $this->url(["action" => "index"]) . '?page=',
    'appendQueryString'	 => true
));
?-->