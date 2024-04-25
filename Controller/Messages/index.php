<?php
$title = __('Chat List');
$messages = getMessages($connect);

$successText = false;
if (isset($_SESSION['is_message_added']) && $_SESSION['is_message_added']) {
    $successText = true;
    unset($_SESSION['is_message_added']);
}

include('view/base/v_header.php');
include('view/base/v_content.php');
include('view/messages/v_index.php');
include('view/base/v_footer.php');




