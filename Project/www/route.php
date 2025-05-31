<?php

return [
    // Article routes
    '~^$~' => [app\Controllers\ArticleController::class, 'index'],          // Список статей
    '~^article/create$~' => [app\Controllers\ArticleController::class, 'create'],    // Форма создания
    '~^article/store$~' => [app\Controllers\ArticleController::class, 'store'],     // Сохранение новой
    '~^article/(\d+)$~' => [app\Controllers\ArticleController::class, 'show'],      // Просмотр статьи
    '~article/(\d+)/edit~' => [app\Controllers\ArticleController::class, 'edit'],    // Форма редактирования
    '~article/(\d+)/update~' => [app\Controllers\ArticleController::class, 'update'], // Обновление
    '~^article/(\d+)/delete$~' => [app\Controllers\ArticleController::class, 'delete'], // Удаление

    // Comment routes
    '~^comment/store$~' => [app\Controllers\CommentController::class, 'store'],      // Создание комментария
    '~^comment/(\d+)/edit$~' => [app\Controllers\CommentController::class, 'edit'],   // Редактирование
    '~^comment/(\d+)/update$~' => [app\Controllers\CommentController::class, 'update'], // Обновление
    '~^comment/(\d+)/delete$~' => [app\Controllers\CommentController::class, 'delete'], // Удаление

    // Main routes
    // '~^$~' => [app\Controllers\MainController::class, 'main'],           // Главная страница (отключено)
    '~^hello/(.+)$~' => [app\Controllers\MainController::class, 'sayHello'], // Приветствие
];