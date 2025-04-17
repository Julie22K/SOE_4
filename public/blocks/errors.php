<?php
        if (isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error)
                echo '<div class="error row j-c-be a-items-baseline"><p> ' . $error . ' </p><ion-icon name="close-circle-outline" onclick="this.parentElement.style.display=\'none\'"></ion-icon></div>';
        }
        unset($_SESSION['errors']);
        ?>