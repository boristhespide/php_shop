<?php
namespace Alexa\PhpOopShop;
require_once __DIR__.'/vendor/autoload.php';
use PDO;

$database = new Database();

$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);

$page_title = "Создание товара";

require_once "layout_header.php";
?>

<div class="right-button-margin">
    <a href="index.php" class="btn btn-default pull-right">Просмотр всех товаров</a>
</div>
<?php
    if ($_POST) {
        $product->name = $_POST["name"];
        $product->price = $_POST["price"];
        $product->description = $_POST["description"];
        $product->category_id = $_POST["category_id"];

        if ($product->create()) {
            echo '<div class="alert alert-success">Товар был успешно создан.</div>';
        } else {
            echo '<div class="alert alert-danger">Невозможно создать товар.</div>';
        }
    }
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">

    <table class="table table-hover table-responsive table-bordered">

        <tr>
            <td>Название</td>
            <td><input type="text" name="name" class="form-control" /></td>
        </tr>

        <tr>
            <td>Цена</td>
            <td><input type="text" name="price" class="form-control" /></td>
        </tr>

        <tr>
            <td>Описание</td>
            <td><textarea name="description" class="form-control"></textarea></td>
        </tr>

        <tr>
            <td>Категория</td>
            <td>
                <?php
                $stmt = $category->read();

                echo "<select class='form-control' name='category_id'>";
                echo "<option>Выбрать категорию...</option>";

                while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row_category);
                    echo "<option value='$id'>$name</option>";
                }
                echo "</select>";
                ?>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Создать</button>
            </td>
        </tr>

    </table>
</form>
<?php
require_once "layout_footer.php"; ?>