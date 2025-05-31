<?php
function addNote($mysqli) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = $_POST['first_name'] ?? '';
        $last_name = $_POST['last_name'] ?? '';
        $patronymic = $_POST['patronymic'] ?? '';
        $birthday = $_POST['birthday'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $address = $_POST['address'] ?? '';
        $comment = $_POST['comment'] ?? '';

        if ($first_name && $last_name && $birthday && $email && $phone && $address) {
            $stmt = $mysqli -> prepare("INSERT INTO `contacts` (first_name, last_name, patronymic, birthday, email, phone, address, comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            
            if ($stmt === false) {
                return [
                        'message' => "Ошибка при подготовке запроса: $mysqli->error", 
                        'color' => 'red'
                    ];
            }

            $stmt -> bind_param("ssssssss", $first_name, $last_name, $patronymic, $birthday, $email, $phone, $address, $comment);

            if ($stmt -> execute()) {
                $stmt -> close();
                return ['message' => "Запись добавлена", 'color' => 'green'];
            } 
            else {
                $stmt->close();
                return ['message' => "Ошибка: запись не добавлена", 'color' => 'red'];
            }
            
        } 
        else {
            return ['message' => "Ошибка: все обязательные поля должны быть заполнены", 'color' => 'red'];
        }
    }
    return null;
}

$result = addNote($mysqli);
?>

<div class="form-container">

    <form action="index.php?page=add" method="POST">
        <div class="form-group">
            <label for="first_name">Имя:</label>
            <input type="text" id="first_name" name="first_name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Фамилия:</label>
            <input type="text" id="last_name" name="last_name" required>
        </div>
        <div class="form-group">
            <label for="patronymic">Отчество:</label>
            <input type="text" id="patronymic" name="patronymic">
        </div>
        <div class="form-group">
            <label for="birthday">Дата рождения:</label>
            <input type="date" id="birthday" name="birthday" required>
        </div>
        <div class="form-group">
            <label for="email">Электронная почта:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Телефон:</label>
            <input type="text" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="address">Адрес:</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="comment">Комментарий:</label>
            <textarea id="comment" name="comment"></textarea>
        </div>
        <button type="submit">Добавить запись</button>
    </form>

    <?php if ($result): ?>
        <p style="color: <?= $result['color']; ?>"><?= $result['message']; ?></p>
    <?php endif; ?>
</div>