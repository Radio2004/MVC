<?php

use Core\Language;

?>
<form method="post" class="form-login">
    <div>
        <input class="login-input" type="text" name="login_name" id="login-name" placeholder="<?=Language::__('User Name')?>">
    </div>
    <div>
        <input class="login-input" type="password" name="login_password" id="login-pass" placeholder="<?=Language::__('Password')?>">
    </div>
    <div>
        <input class="login-input" type="submit" name="login_submit" id="login-submit" value="<?=Language::__('Submit')?>">
    </div>
</form>
