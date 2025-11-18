<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php 

require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );

if ( !is_user_logged_in() ) {
   die ('cорянчик, вы не авторизованы');
}		



$args = array(
	'posts_per_page' => '10000',
    'post_type' => 'any',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',

    // Using the date_query to filter posts from last month
    'date_query' => array(
        array(
            'after' => '1 month ago'
        )
    )
); 
					
$events_query = new WP_Query( $args );

if ( $events_query->have_posts() ) :while ( $events_query->have_posts() ) :
 $events_query->the_post();
 
 $email=get_field( "email" ); 
 if($email!='') {
 //echo $email.'<br>';	
	$mails[] = $email; 
 }
 
 endwhile;
 endif; 
 
 $result=array_unique($mails);
 
 
// print_r($mails);
 
 
  foreach($result as $mail)
  {
     echo "$mail <br />";
  }
 
 ?>
</body>
</html>
