<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10/25/14
 * Time: 1:38 PM
 */

class ParagonFramework_View_Helper_PgProductEditForm extends Zend_View_Helper_Abstract {
    public function PgProductEditForm($productID, $productURL) {
        return "
<form role='form' method='post' action='{$productURL}/id/$productID'>
    <button type='submit' class='btn btn-default button-xs'>Edit</button>
    <input type='hidden' name='o_id' value='{$productID}'/>
</form>
";
    }
}
