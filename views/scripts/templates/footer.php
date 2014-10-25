        <nav id="footer" class="navbar navbar-default navbar-fixed-bottom" role="navigation">
            <div class="container">
                <p class="muted credit">
                    <a href="<?= ParagonFramework_Plugin::$GITHubURL ?>">Paragon Framework</a>&nbsp;(<a href="<?= ParagonFramework_Plugin::$GITCommit->Link ?>">#&nbsp;<?= ParagonFramework_Plugin::$GITCommit->Hash ?></a>)
                    <br/>
                    &copy; 2014 <a href="<?= ParagonFramework_Plugin::$GITHubOrgURL ?>">Project Group 1</a>, a proud member of the <a href="http://www.fh-hagenberg.at/" target="_blank">FH Hagenberg</a>
                </p>
            </div>
        </nav>
    </body>
    <?= $this->inlineScript() ?>
</html>