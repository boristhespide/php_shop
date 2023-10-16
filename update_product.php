<?php

// здесь будет получение одного товара

// установка заголовка страницы
namespace Alexa\PhpOopShop;
use PDO;

$page_title = "Обновление товара";

require_once "layout_header.php";
require_once "index.php";



?>

    <div class="right-button-margin">
        <a href="index.php" class="btn btn-default pull-right">Просмотр всех товаров</a>
    </div>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=$id"); ?>" method="post">
    <table class="table table-hover table-responsive table-bordered">

        <tr>
            <td>Название</td>
            <td><input type="text" name="name" value="<?php echo $product->name; ?>" class="form-control" /></td>
        <tr>
            <td>Цена</td>
            <td><input type="text" name="price" value="<?php echo $product->price; ?>" class="form-control" /></td>
        </tr>

        <tr>
            <td>Описание</td>
            <td><textarea name="description" class="form-control"><?php echo $product->description; ?></textarea></td>
        </tr>

        <tr>
            <td>Категория</td>
            <td>
                <?php
                $stmt = $category->read();

                // помещаем категории в выпадающий список
                echo "<select class='form-control' name='category_id'>";
                echo "<option selected disabled value=''>Выберите категорию</option>";
                while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $category_id = $row_category["id"];
                    $category_name = $row_category["name"];

                    // необходимо выбрать текущую категорию товара
                    if ($product->category_id == $category_id) {
                        echo "<option value='$category_id' selected>";
                    } else {
                        echo "<option value='$category_id'>";
                    }
                    echo "$category_name</option>";
                }
                echo "</select>";
                ?>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Обновить</button>
            </td>
        </tr>

    </table>
</form>

    </tr>
    <?php
$id = $_GET["id"] ?? die("ERROR: отсутствует ID.");

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);

$product->id = $id;

$product->readOne();

if ($_POST) {
    $product->name = $_POST["name"];
    $product->price = $_POST["price"];
    $product->description = $_POST["description"];
    $product->category_id = $_POST["category_id"];

    if ($product->update()) {
        echo "<div class='alert alert-success alert-dismissable'>";
        echo "Товар был обновлён.";
        echo "</div>";
    }
} else {
    echo "<div class='alert alert-danger alert-dismissable'>";
    echo "Невозможно обновить товар.";
    echo "</div>";

}

?>
<?php
require_once "layout_footer.php";