<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php';

$post_type = $_REQUEST['post_type'] ?? '';

if (in_array($post_type, get_post_types())) {

    // === Створюємо пост ===
    $id = wp_insert_post([
        'post_title'  => 'random',
        'post_type'   => $post_type,
        'post_status' => 'publish',
    ]);

    if ($id) {

        // === Формуємо красивий ID ===
        $id_with_zeroes = sprintf('%08d', $id);
        $id_with_zeroes_and_hyphen = substr($id_with_zeroes, 0, 3) . '-' . substr($id_with_zeroes, 3, 5);

        // === Оновлюємо заголовок ===
        wp_update_post([
            'ID'         => $id,
            'post_title' => $id_with_zeroes_and_hyphen,
        ]);

        // === Зберігаємо всі поля ===
        foreach ($_POST as $key => $value) {
            if (function_exists('get_field_object') && get_field_object($key, $id)) {
                update_field($key, $value, $id);
            } else {
                update_post_meta($id, $key, $value);
            }
        }

        // === Переносимо файл ===
        $themeDir  = get_stylesheet_directory(); // повний шлях до теми
        $uploadDir = $themeDir . '/includes/uploads/';
        $finalDir  = $themeDir . '/includes/final/';
        $finalUrl  = get_stylesheet_directory_uri() . '/includes/final/';

        if (!is_dir($finalDir)) mkdir($finalDir, 0755, true);

        if (!empty($_POST['uploaded_file'])) {
            $uploadedFile = basename($_POST['uploaded_file']);
            $sourcePath = $uploadDir . $uploadedFile;

            if (file_exists($sourcePath)) {
                $extension = pathinfo($uploadedFile, PATHINFO_EXTENSION);
                $newFileName = $id_with_zeroes_and_hyphen . '.' . $extension;
                $finalPath = $finalDir . $newFileName;

                // Переміщаємо та видаляємо старий
                if (@rename($sourcePath, $finalPath)) {
                    // ✅ успішно переміщено
                } else {
                    // fallback: копіюємо й видаляємо
                    if (@copy($sourcePath, $finalPath)) {
                        @unlink($sourcePath);
                    } else {
                        error_log("❌ Не вдалося перемістити файл: $uploadedFile");
                    }
                }

                // === Оновлюємо метаполя ===
                update_post_meta($id, 'uploaded_file', $newFileName);
                update_post_meta($id, 'uploaded_file_url', $finalUrl . $newFileName);
            } else {
                error_log("❌ Файл не знайдено: $sourcePath");
            }
        }

        // === Повертаємо ID диплома ===
        echo $id_with_zeroes_and_hyphen;
    }
}
