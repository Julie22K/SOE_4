<?php

require 'C:\Users\Julie\source\SOE_4\config/connect.php';

$post_id = $_GET['id'];

$recipes = mysqli_query($soe, "SELECT * FROM `recipes` WHERE ID='$post_id'");
$recipes = mysqli_fetch_all($recipes);

$recipe = $recipes[0];

$video_url = $recipe[4];
$iframe = '<iframe width="100%" height="100%" src="' . $video_url . ')" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';

echo $video_url != "" ? $iframe : '<p>This recipe doesn`t have video.</p>';
