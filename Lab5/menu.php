<?php
function getMainMenu() {
    $page = $_GET['page'] ?? 'view';
    
    $menu_items = [
        'viewer' => 'Просмотр',
        'add' => 'Добавление записи',
        'edit' => 'Редактирование записи',
        'delete' => 'Удаление записи',
    ];

    $menu_output = '<div class="menu">';
    foreach ($menu_items as $key => $label) {
        $active_class = ($page === $key) ? 'active' : '';
        $menu_output .= "<a href=\"index.php?page=$key\" class=\"$active_class\">$label</a>";
    }
    $menu_output .= '</div>';

    return $menu_output;
}