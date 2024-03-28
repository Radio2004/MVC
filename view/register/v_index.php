<?php

use Core\Language;

?>
<form method="post" class="form-register">
    <div>
        <input class="register-input" type="text" name="register_name" id="register-name" placeholder="<?=Language::__('User Name')?>">
    </div>
    <div>
        <input class="register-input" type="password" name="register_password" id="register-pass" placeholder="<?=Language::__('Password')?>">
    </div>
    <div>
        <input  class="register-input" type="email" name="register_email" id="register-email" placeholder="<?=Language::__('Email')?>">
    </div>
    <div>
        <input class="register-input" type="submit" name="register_submit" id="register-submit" value="<?=Language::__('Submit')?>">
    </div>
</form>
