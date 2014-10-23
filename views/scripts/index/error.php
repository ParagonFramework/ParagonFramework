<?= $this->partial('templates/header.php', $this); ?>

<?= $this->partial('templates/navigationTop.php', $this); ?>

<div class="container">
     <pre>
         <?= $this->error_title;   ?><br />
         <?= $this->error_message; ?>
    </pre>
</div>

<?= $this->partial('templates/footer.php', null); ?>
