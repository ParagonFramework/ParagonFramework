<ul class="pagination">
	<!-- First page link -->
	<li class="<?= (!isset($this->previous)) ? 'disabled' : ''; ?>"><a href="<?= $this->urlprefix . $this->first; ?>">Start</a></li>
	<!-- Previous page link -->
	<li class="<?= (!isset($this->previous)) ? 'disabled' : ''; ?>"><a href="<?= $this->urlprefix . $this->previous; ?>">Previous</a></li>

	<!-- Numbered page links -->
	<?php foreach ($this->pagesInRange as $page): ?>
		<li class="<?= ($page == $this->current) ? 'active' : ''; ?>"><a href="<?= $this->urlprefix . $page; ?>"><?= $page; ?></a></li>
	<?php endforeach; ?>

	<!-- Next page link -->
	<li class="<?= (!isset($this->next)) ? 'disabled' : ''; ?>"><a href="<?= $this->urlprefix . $this->next; ?>">Next</a></li>
	<!-- Last page link -->
	<li class="<?= (!isset($this->next)) ? 'disabled' : ''; ?>"><a href="<?= $this->urlprefix . $this->last; ?>">End</a></li>
</ul>