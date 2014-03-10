<?php
/*
Template Name: Portfolio
*/
?>

<?php get_template_part('templates/page', 'header'); ?>
<?php get_template_part('templates/content', 'page'); ?>

<?php
$args = array(
    'post_type' => 'll-portfolio'
);
$ll_portfolio_items = new WP_Query( $args );

if( $ll_portfolio_items->have_posts() ) : ?>

<div class='items'>
   <?php while($ll_portfolio_items->have_posts()) : $ll_portfolio_items->the_post() ?>
      <div class='item'>
         <?php the_post_thumbnail(); ?>
      </div>
   <?php endwhile ?>
</div>

<?php endif;

