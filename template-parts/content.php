<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Anh_Popperscores
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php 
		if (has_post_thumbnail() ) { ?>
			<figure>
			<!-- dont have to echo out with the_post_thumbnail -->
	<!-- 		<?php the_post_thumbnail(); ?>
			you have the option of using different sizes of featured img,
			this is good for customizing diff sizes for diff template, such as 
			displaying smaller featured img on the index pages  -->
			<?php the_post_thumbnail('anh-popperscores-small-thumb'); ;?>
			</figure>
		<?php } ?>

		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>


		<?php 
		if ( has_excerpt( $post -> ID) ) {
			echo '<div class="deck">';
			echo '<p>' . get_the_excerpt() . '</p>';
			echo '</div><1!-- .deck -->';
		}
		?>

		<div class="entry-meta">
			<?php anh_popperscores_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'anh-popperscores' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'anh-popperscores' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php anh_popperscores_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
