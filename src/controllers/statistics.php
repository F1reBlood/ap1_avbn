<?php
require_once('src/model.php');

function statistics()
{
    $comments_per_user = get_comments_per_user();
    $total_comments = get_comments_count();

    require('templates/statistics.php');
}
?>