<?php

$this->headLink()
    ->appendStylesheet('http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/master/build/css/bootstrap-datetimepicker.min.css');

$this->inlineScript()
    ->appendFile('http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/master/src/js/bootstrap-datetimepicker.js');

?>
<div class="container">
    <div class="page-header">
        <p class="lead">Edit Product: <?= $this->product->name ?></p>

    </div>
    <div class="row">
        <div class="col-md-6 borderRight">
            <div class="border">
                <h3>General Information</h3>
                <p>SKU: <?= $this->product->o_id ?></p>
                <p>Main Category: <?= $this->product->category ?></p>
                <p>Source: _PLACEHOLDER_</p>
                <p>Make: _PLACEHOLDER_</p>
            </div>
            <h3>Description</h3>
            <textarea rows="5" cols="50">
                Enter your text here...
            </textarea>
        </div>
        <div class="col-md-6">
            <table class="table">
                <tr>
                    <td>Additional Category</td>
                    <td>
                        <select>
                            <option value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option value="vw">VW</option>
                            <option value="audi" selected>Audi</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="pull-right">
        <form role="form" id="loginform" method="post" action="index">
            <button type="submit" class="btn btn-default">Save</button>
        </form>
    </div>
</div>

