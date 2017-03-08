<?php
/*
**Template Name: Page Of Posts
*/

get_header(); ?>
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
      </header><!-- .entry-header -->
       <?php 
        /* The loop: the_post retrieves the content
         * of the new Page you created to list the posts,
         * e.g., an intro describing the posts shown listed on this Page..
         */
        /*
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();

              // Display content of page
              get_template_part( 'content', 'page' ); 
              wp_reset_postdata();
  
            endwhile;
        endif;
        */

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = array(
            // Change these category SLUGS to suit your use.
            // 'category_name' => 'music, videos', 
            'category_name' => '', 
            'paged' => $paged
        );

        $list_of_posts = new WP_Query( $args );
        ?>
        <?php if ( $list_of_posts->have_posts() ) : ?>
      <?php /* The loop */ ?>
      <?php while ( $list_of_posts->have_posts() ) : $list_of_posts->the_post(); ?>
        <?php // Display content of posts ?>
        <?php get_template_part( 'content', get_post_format() ); ?>
      <?php endwhile; ?>

       <?php the_posts_navigation(); ?>
    <?php else : ?>
      <?php get_template_part( 'content', 'none' ); ?>
    <?php endif; ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php get_footer(); ?>