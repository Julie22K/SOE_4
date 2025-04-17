<?php
if (isset($_SESSION['message'])) {
    echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
}
unset($_SESSION['message']);
?>