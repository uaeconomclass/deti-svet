<?php /* Template Name: Diplom */ 


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php astra_primary_class(); ?>>


		<?php astra_primary_content_top(); ?>

		<?php astra_content_page_loop(); ?>

		<?php astra_primary_content_bottom(); ?>
		


	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<!----------------------------------->

	
<div class="wrapper">	
<div class="inwrapper">	

				<table>		

					<tr>
						<td class="nprikaza">№ приказа</td><td>участник</td><td class="mesto" >место</td><td>название конкурса</td><td>номинация</td><td>город</td>
					</tr>				
					<?php			
						$events_query = new WP_Query( array('post_type' => get_post_types(), 'posts_per_page' => '5000', 'meta_query' => array( array( 'key' => 'payed', 'success' => session_id()) )) );
						if ( $events_query->have_posts() ) :while ( $events_query->have_posts() ) :
						$events_query->the_post();
						$idd=get_the_ID();
						$post_type = get_post_type( $idd);	
						
		
					?>
					


					<tr>
						<td><?php echo get_the_title() ?></td>
						<td><?php the_field( "name" ); ?></td>
						<td>
						<? if($post_type!='publication')	{ the_field( "mestoLabel" );}?>
						</td>
						<td>
						<? if($post_type=='publication')	{ echo 'Публикация';}?> <?php the_field( "nazvanie_konkursa" ); ?>
						<? if($post_type=='onlinetest'&&get_field( 'nazvanie_konkursa' )=='')	{ echo 'тест "Знания по ИКТ"';} ?>
						
						</td>
						<td>  <?php the_field( "nominaciya" ); ?></td>
						<td><?php the_field( "place" ); ?></td>
					</tr>
				
				<?php endwhile; ?>
				


			<?php endif; ?>		
				
				</table>		
	
	
	
	
	
</div>	
</div>	
		

<!----------------------------------->

<?php get_footer(); ?>
