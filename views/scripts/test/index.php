    <div id="viewSwitchingDialog" class="viewSwitchingDialog" style="display: none;">
        <div class="test">
            <form role="form" method="post" action="<?= $this->url(["action" => "changerole"]) ?>">
                <input type="hidden" name="viewSwitchingDialog_Selected" id="viewSwitchingDialog_Selected" />
                <h3>Deeplink Generation</h3>
                <br/>
                <br/>
                    <textarea cols="20" rows="4" name="textfeld"></textarea>
                <br/>
                <br/>
                <input type="button" class="btn btn-default" name="btnCancel" value="Cancel" onclick="toggle_visibility('viewSwitchingDialog');">
            </form>
        </div>
    </div>
    <div>
        <form action="input_button.htm">
            <p>Username:<br><input name="Username" type="text" size="30" maxlength="30" value=""></p>
            <p>Password:<br><input name="Password" type="text" size="30" maxlength="40" value=""></p>
            <p>Product group:<br><input name="Product group" type="text" size="30" maxlength="30" value=""></p>
            <p>Id:<br><input name="Id" type="text" size="30" maxlength="40" value=""></p>
            <p><input type="button" class="btn btn-default" name="btnCancel" value="Generate deeplink" onclick="toggle_visibility('viewSwitchingDialog');"></p>
        </form>
    </div>