<?php

use Alexa\PhpOopShop\Category;
use Alexa\PhpOopShop\Database;
use Alexa\PhpOopShop\Product;

require_once __DIR__ . '/vendor/autoload.php';

$page_title = "Вывод товаров";

$page = $_GET["page"] ?? 1;

$records_per_page = 5;

// подсчитываем лимит запроса
$from_record_num = ($records_per_page * $page) - $records_per_page;

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);


// запрос товаров
$stmt = $product->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

require_once "layout_header.php";
?>

<div class="right-button-margin">
    <a href="create_product.php" class="btn btn-default pull-right">Добавить товар</a>
</div>

<?php

if ($num > 0) {

    echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
    echo "<th>Товар</th>";
    echo "<th>Цена</th>";
    echo "<th>Описание</th>";
    echo "<th>Категория</th>";
    echo "<th>Действия</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        echo "<tr>";
        echo "<td>{$name}</td>";
        echo "<td>{$price}</td>";
        echo "<td>{$description}</td>";
        echo "<td>";
        $category->id = $category_id;
        $category->readName();
        echo $category->name;
        echo "</td>";

        echo "<td>";
        echo "<a href='read_product.php?id=$id' class='btn btn-primary left-margin'>
    <span class='glyphicon glyphicon-list'></span> Просмотр
</a>

<a href='update_product.php?id=$id' class='btn btn-info left-margin'>
    <span class='glyphicon glyphicon-edit'></span> Редактировать
</a>

<a delete-id='$id' class='btn btn-danger delete-object'>
    <span class='glyphicon glyphicon-remove'></span> Удалить
</a>";
        echo "</td>";

        echo "</tr>";

    }

    echo "</table>";

    $page_url = "index.php?";
    $total_rows = $product->countAll();
    require_once "paging.php";
}

// сообщим пользователю, что товаров нет
else {
    echo "<div class='alert alert-info'>Товары не найдены.</div>";
}
?>



<?php require_once "layout_footer.php"; ?>
