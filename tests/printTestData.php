<?php
function printTestData($data)
{
    // foreach ($data as $key => $array) {
    //     echo '<a href="#' . $key . '">' . $key . '</a><br>';
    // }

    foreach ($data as $key => $array) {
        echo '<div><h4 onclick="hideBlock(this)" id="' . $key . '">' . $key . '</h4>';
        if ($key == "SELECT") {
            foreach ($array as $key => $array2) {

                echo '<div class="block">';
                echo '<h5 class="caption">' . $key . '</h5>';
                echo '<div class="grid">';
                // print_r($array2);
                foreach ((array)$array2 as $key3 => $item3) {
                    if (gettype($item3) != "array") echo '<p>' . $key3 . ': ' . $item3 . '</p>';
                    else {
                        foreach ((array)$item3 as $key4 => $item4) {
                            echo '<p>' . $key4 . ': ' . $item4 . '</p>';
                        }
                    }
                }

                echo '</div>';
                echo '</div>';
            }
        } else {

            echo '<div class="block">';
            echo '<h5 class="caption">' . $key . '</h5>';
            echo '<div class="grid">';

            foreach ((array)$array as $key3 => $item3) {
                if (gettype($item3) != "array") echo '<p>' . $key3 . ': ' . $item3 . '</p>';
                else {
                    foreach ((array)$item3 as $key4 => $item4) {
                        echo '<p>' . $key4 . ': ' . $item4 . '</p>';
                    }
                }
            }

            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    }
}
?>