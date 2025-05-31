<?php
function getNotes($mysqli) {
    $query = "SELECT id, first_name, first_name FROM contacts ORDER BY first_name, first_name";
    return $mysqli->query($query);
}

$mysqli = new mysqli("localhost", "root", "", "notebook");

if ($mysqli->connect_errno) {
    die("Ошибка подключения: $mysqli->connect_error");
}

if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    $result = $mysqli->query("SELECT * FROM contacts WHERE id = $edit_id");
    $note = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    $first_name = $mysqli->real_escape_string($_POST['first_name']);
    $last_name = $mysqli->real_escape_string($_POST['last_name']);
    $patronymic = $mysqli->real_escape_string($_POST['patronymic']);
    // $birthday = $_POST['birthday'];
    $birthday = $mysqli->real_escape_string($_POST['birthday']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $phone = $mysqli->real_escape_string($_POST['phone']);
    $address = $mysqli->real_escape_string($_POST['address']);
    $comment = $mysqli->real_escape_string($_POST['comment']);

    $updateQuery = "UPDATE contacts 
                    SET first_name = '$first_name', last_name = '$last_name', patronymic = '$patronymic', birthday = '$birthday', 
                    email = '$email', phone = '$phone', address = '$address', comment = '$comment' WHERE id = $edit_id";

    if ($mysqli -> query($updateQuery)) {
        header("Location: index.php?page=edit&edit_id=$edit_id");
        exit();
    } else {
        echo "<p style='color: red;'>Произошла ошибка</p>";
    }
}
?>

<div class="note-list">
    <ul>
        <?php
        $sql = "SELECT * FROM `contacts`";
        $result = $mysqli -> query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result -> fetch_assoc()) {
                $selectedClass = (isset($note) && $note['id'] == $row['id']) ? 'selected' : '';
                echo "<li class='$selectedClass'><a href='?page=edit&edit_id={$row['id']}'>{$row['first_name']} {$row['last_name']}</a></li>";
            }
        }
        ?>
    </ul>
</div>

<?php if (isset($note)): ?>
    <form action="edit.php?edit_id=<?php echo $note['id']; ?>" method="POST">
        <div class="form-group">
            <label for="first_name">Имя:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($note['first_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="last_name">Фамилия:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($note['last_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="patronymic">Отчество:</label>
            <input type="text" id="patronymic" name="patronymic" value="<?php echo htmlspecialchars($note['patronymic']); ?>">
        </div>
        <div class="form-group">
            <label for="birthday">Дата рождения:</label>
            <input type="date" id="birthday" name="birthday" value="<?php echo htmlspecialchars($note['birthday']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Электронная почта:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($note['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Телефон:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($note['phone']); ?>" required>
        </div>
        <div class="form-group">
            <label for="address">Адрес:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($note['address']); ?>" required>
        </div>
        <div class="form-group">
            <label for="comment">Комментарий:</label>
            <textarea id="comment" name="comment"><?php echo htmlspecialchars($note['comment']); ?></textarea>
        </div>
        <button type="submit">Сохранить изменения</button>
    </form>
<?php endif; ?>