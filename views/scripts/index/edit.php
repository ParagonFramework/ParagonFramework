<?php
echo $this->partial('templates/header.php', $this->content);
echo $this->partial('templates/navigationTop.php', null);

echo $this->partial('templates/products/detail.php', $this);

echo $this->partial('templates/footer.php', null);
