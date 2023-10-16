<?php

echo "<ul class='pagination'>";

if ($page > 1) {
    echo "<li><a href=" . $page_url . "title='Переход к первой странице'";
    echo "Первая";
    echo "</a></li>";
}

$total_pages = ceil($total_rows / $records_per_page);

$range = 2;

$initial_num = $page - $range;
$condition_limit_num = ($page + $range) + 1;

for ($i = $initial_num; $i < $condition_limit_num; $i++) {
    if (($i > 0) && ($i <= $total_pages)) {
        if ($i == $page) {
            // текущая страница
            echo "<li class='active'><a href='#'> $i <span class='sr-only'>(current)</span></a></li>";
        } else {
            // НЕ текущая страница
            echo "<li><a href='{$page_url}page=$i'>$i</a></li>";
        }
    }
}
if ($page < $total_pages) {
    echo "<li><a href='" . $page_url . "page=" . $total_pages . "' title='Переход к последней странице'>";
    echo "Последняя";
    echo "</a></li>";
}

echo "</ul>";