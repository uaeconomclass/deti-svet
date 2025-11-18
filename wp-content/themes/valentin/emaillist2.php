<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php 

require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

if ( !is_user_logged_in() ) {
   die ('сorянчик, вы не авторизованы');
}

global $wpdb;

// Виконання SQL-запиту для отримання унікальних email
$results = $wpdb->get_col("
    SELECT DISTINCT pm.meta_value 
    FROM {$wpdb->prefix}postmeta pm
    INNER JOIN {$wpdb->prefix}posts p ON pm.post_id = p.ID
    WHERE pm.meta_key = 'email'
    AND p.post_type IN ('zayavka', 'free__request')
    AND p.post_status = 'publish'
");

// Виведення унікальних email
foreach ($results as $email) {
    echo esc_html($email) . '<br>';
}

?>
</body>
</html>
