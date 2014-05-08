<?php

echo $this->partial('templates/header.php', null);

echo $this->partial('templates/navigationTop.php', null);
?>
<table>
<?php
echo $this->partialLoop("templates/products/row.php", $this->products);
?>
</table>
<?php
echo $this->partial('templates/footer.php', null);
?>
