<?php
function renderViewer(mysqli $mysqli, string $sort, int $current_page): string {
    $per_page = 10;
    $offset = ($current_page - 1) * $per_page;

    switch ($sort) {
        case 'byname':
            $order_by = 'first_name ASC';
            break;
        case 'bybirth':
            $order_by = 'birthday ASC';
            break;
        case 'default':
        default:
            $order_by = 'id ASC';
            break;
    }

    $sql = "SELECT * FROM `contacts` ORDER BY $order_by LIMIT $offset, $per_page";
    $result = $mysqli -> query($sql);

    if (!$result) {
        return "<p class='error'>Ошибка SQL-запроса: $mysqli->error</p>";
    }

    $total_res = $mysqli -> query("SELECT COUNT(*) FROM `contacts`");
    $total_rows = $total_res ? (int)$total_res -> fetch_row()[0] : 0;
    $total_pages = max(1, ceil($total_rows / $per_page));
    ?>

    <div class="submenu">
        <?php
        $sorts = [
            'default' => 'По умолчанию (по индексам)',
            'byname' => 'По фамилии',
            'bybirth' => 'По дате рождения'
        ];
        foreach ($sorts as $key => $label): ?>
            <a href="index.php?page=viewer&sort=<?= $key ?>&p=1"
               class="<?= $sort === $key ? 'active' : '' ?>"><?= $label ?></a>
        <?php endforeach; ?>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Отчество</th>
            <th>Дата рождения</th>
            <th>Email</th>
            <th>Телефон</th>
            <th>Адрес</th>
            <th>Комментарий</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= htmlspecialchars($row['first_name']); ?></td>
                <td><?= htmlspecialchars($row['last_name']); ?></td>
                <td><?= htmlspecialchars($row['patronymic']); ?></td>
                <td><?= htmlspecialchars($row['birthday']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= htmlspecialchars($row['phone']); ?></td>
                <td><?= htmlspecialchars($row['address']); ?></td>
                <td><?= htmlspecialchars($row['comment']); ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="index.php?page=viewer&sort=<?= $sort ?>&p=<?= $i ?>" class="<?= $i == $current_page ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor ?>
    </div>

    <?php
    return "";
}
?>