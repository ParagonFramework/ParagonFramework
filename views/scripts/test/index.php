    <div id="viewSwitchingDialog" class="viewSwitchingDialog" style="display: none;">
        <div class="test">
            <form role="form" method="post" action="<?= $this->url(["action" => "changerole"]) ?>">
                <input type="hidden" name="viewSwitchingDialog_Selected" id="viewSwitchingDialog_Selected"></input>
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

    <form action="input_button.htm">
        <p>
            <input type="button" class="btn btn-default" name="btnCancel" value="Generate deeplink" onclick="toggle_visibility('viewSwitchingDialog');">
        </p>
    </form>
