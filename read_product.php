<?php
namespace Alexa\PhpOopShop;
use PDO;

$id = $_GET["id"] ?? die("ERROR: отсутствует ID.");

require_once "src/Database.php";  // почему-то через неймспейс этот класс тут не подключается
$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);

$product->id = $id;

$product->readOne();

$page_title = "Страница товара (чтение одного товара)";

require_once "layout_header.php";
?>
    <!-- ссылка на все товары -->
    <div class="right-button-margin">
        <a href="index.php" class="btn btn-primary pull-right">
            <span class="glyphicon glyphicon-list"></span> Просмотр всех товаров
        </a>
    </div>
    <table class="table table-hover table-responsive table-bordered">
        <tr>
            <td>Название</td>
            <td><?php echo $product->name; ?></td>
        </tr>
        <tr>
            <td>Цена</td>
            <td><?php echo $product->price; ?></td>
        </tr>
        <tr>
            <td>Описание</td>
            <td><?php echo $product->description; ?></td>
        </tr>
        <tr>
            <td>Категория</td>
            <td>
                <?php echo// выводим название категории
                $category->id = $product->category_id;
                $category->readName();

                echo $category->name;
                ?>
            </td>
        </tr>
    </table>

<?php // подвал
require_once "layout_footer.php";
