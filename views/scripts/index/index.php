<?php
echo $this->partial('templates/header.php', $this->content);

echo $this->partial('templates/navigationTop.php', null);
?>

<div class="container">
    <div class="page-header">
    </div>
    <p class="lead">Products that need to be completed.</p>
	<?php echo $this->partial('templates/products/table.php', $this->content) ?>
    <ul class="pagination pull-right">
        <li class="disabled"><a href="#">&laquo;</a></li>
        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">&raquo;</a></li>
    </ul>

</div>
<?php
echo $this->partial('templates/footer.php', null);
?>
