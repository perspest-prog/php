<?php

$mysqli = new mysqli("localhost", "root", "", "notebook");

if ($mysqli->connect_errno) {
    die("Ошибка подключения: $mysqli->connect_error");
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $result = $mysqli -> query("SELECT id, first_name, last_name FROM contacts WHERE id = $delete_id");

    if ($result && $note = $result -> fetch_assoc()) {
        $mysqli->query("DELETE FROM contacts WHERE id = $delete_id");

        echo "<div class='message success'>Запись с фамилией {$note['last_name']} {$note['last_name']} удалена</div>";
    } else {
        echo "<div class='message error'>Произошла ошибка</div>";
    }
}
?>



<div class="note-list">
    <ul>
        <?php
        $sql = "SELECT * FROM `contacts`";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $selectedClass = (isset($note) && $note['id'] == $row['id']) ? 'selected' : '';
                echo "<li class='note-item $selectedClass'>
                        <a href='?page=delete&delete_id={$row['id']}'>
                            <span class='first_name'>{$row['first_name']}</span>
                            <span class='last_name'>{$row['last_name']}</span> 
                        </a>
                    </li>";
            }
        }
        ?>
    </ul>
</div>