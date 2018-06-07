<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate this class
if ( !class_exists( 'Pagination' ) ) :
	/**
	 * Helper class to paginate posts
	 */
	class Pagination {
		// Will show "first page" and "last page" links
		protected $show_last_links;
		// Does pagination needs to be centered?
		protected $centered;
		// Number of links near current page link
		protected $adjacents;
		// Number of posts per page
		protected $per_page;
		// Number of the current page
		protected $current_page;
		// Contains total amount of pages
		protected $total_pages;

		/**
		 * Pagination constructor.
		 *
		 * @param bool $show_last_links Whether navigation links needs to be showed or not
		 * @param bool $centered True is the pagination needs to be centered
		 */
		public function __construct ( $show_last_links = true, $centered = true ) {
			// Assign a total amount of pages
			global $wp_query;
			$this->total_pages = $wp_query->max_num_pages;

			// Get the current page, first page by default
			$this->current_page = get_query_var( 'paged', 0 );
			// Get the amount of posts per page, 10 posts by default
			$this->per_page = get_query_var( 'posts_per_page', 10 );
			// Show "first page" and "last page" links display to true or false
			$this->show_last_links = $show_last_links;
			// Set our adjacents to 3 links by default
			$this->adjacents = 3;
		}

		/**
		 * Class setter. If method does not exist, it will be created via magic method.
		 *
		 * @param string $name Name of the property
		 * @param mixed $value Value of the property
		 */
		public function __set ( $name, $value ) {
			// Check if method exists or not
			if ( method_exists( $this, $name ) ) {
				$this->$name( $value );
			} else {
				// Getter/Setter not defined so set as property of object
				$this->$name = $value;
			}
		}

		/**
		 * Class getter. Return the value of method/property or null otherwise.
		 *
		 * @param string $name Name of the property
		 *
		 * @return mixed Value of the property
		 */
		function __get ( $name ) {
			// Check if method exists or not
			if( method_exists( $this, $name ) ){
				return $this->$name();
			} elseif ( property_exists( $this, $name ) ){
				// Getter/Setter not defined so return property if it exists
				return $this->$name;
			}

			return null;
		}


		/**
		 * Show previous page link and link on the first page
		 */
		public function show_prev_navigation() {
			// Show the previous page link, if we're not on the first page
			if ( $this->current_page != 0 ) {
				// If "first page" link is enabled
				if ( $this->show_last_links ) : ?>
					<a class="first" href="<?php echo get_pagenum_link(1); ?>">
						<?php _e( '&laquo;&laquo; First', 'startuply' ); ?>
					</a>
				<?php endif; ?>

				<a class="prev" href="<?php echo get_pagenum_link($this->current_page - 1); ?>">
					<?php _e( '&laquo;&nbsp;', 'startuply' ); ?>
				</a>

			<?php }
		}

		/**
		 * Show next page link and link on the last page
		 */
		public function show_next_navigation() {
			// Show the next page link, if we're not of the last page
			if ( $this->current_page < $this->total_pages ) { ?>
				<a class="next" href="<?php echo get_pagenum_link( $this->current_page + 1 ); ?>">
					<?php _e( '&nbsp;&raquo;', 'startuply' ); ?>
				</a>

				<?php
				// If "last page" link is enabled
				if ( $this->show_last_links ) : ?>
					<a class="last" href="<?php echo get_pagenum_link( $this->total_pages ); ?>">
						<?php _e( 'Last &raquo;&raquo;', 'startuply' ); ?>
					</a>
				<?php endif;
			}
		}

		/**
		 * Turn the page number into link
		 *
		 * @param integer $page_number Number of the page
		 *
		 * @return string Resulted link
		 */
		protected function single_link( $page_number ) {
			// Is it a current page?
			$is_current_page = ( $this->current_page == $page_number );
			// Is it the first page?
			$is_first_page = ( $this->current_page == 0 && $page_number == 1 );

			// Check which class we need to set
			if ( $is_current_page || $is_first_page ) {
				// Set "active" class if it's current page
				return '<a class="active">' . $page_number . '</a>';
			} else {
				// Add the link to the array
				return '<a class="inactive" href="' . get_pagenum_link( $page_number ) . '">' . $page_number . '</a>';
			}
		}

		/**
		 * Show pagination links
		 *
		 * @see Inspired by http://www.strangerstudios.com/sandbox/pagination/diggstyle.php
		 */
		public function links() {
			// Initialize our links array
			$links = array();

			/*
             * Algorithm of digg-style pagination
             */

			// Need at least 10 pages to bother breaking it up
			if ( $this->total_pages < 4 + ( $this->adjacents * 2 ) ) {
				// Loop through the whole pages
				for ( $counter = 1; $counter < ( $this->total_pages + 1 ); $counter++ ) {
					$links[] = $this->single_link( $counter );
				}

				// If at least 9 pages, we can hide some
			} elseif ( $this->total_pages > 2 + ( $this->adjacents * 2 ) ) {
				/*
                 * Current page number < 7, close to beginning; only hide later pages
                 */
				if( $this->current_page < 1 + ( $this->adjacents * 2 ) ) {
					// Show links
					for ( $counter = 1; $counter < 4 + ( $this->adjacents * 2 ); $counter++ ) {
						$links[] = $this->single_link( $counter );
					}

					// Add ellipsis to the end
					$links[] = '<span class="dots">...</span>';

					/*
                     * In the middle; Hide some front and some back
                     */
				} elseif ( $this->total_pages - ( $this->adjacents * 2 ) > $this->current_page && $this->current_page > ( $this->adjacents * 2 ) ) {
					// Add ellipsis to the beginning
					$links[] = '<span class="dots">...</span>';

					// Show links
					for ( $counter = $this->current_page - $this->adjacents; $counter <= $this->current_page + $this->adjacents; $counter++ ) {
						$links[] = $this->single_link( $counter );
					}

					// Add ellipsis to the end
					$links[] = '<span class="dots">...</span>';

					/*
                     * Close to end; only hide early pages
                     */
				} else {
					// Add ellipsis to the beginning
					$links[] = '<span class="dots">...</span>';

					// Show links
					for ( $counter = $this->total_pages - ( 2 + ( $this->adjacents * 2 ) ); $counter <= $this->total_pages; $counter++ ) {
						$links[] = $this->single_link( $counter );
					}
				}
			}

			// Push the array into string
			echo implode( "\n", $links );
		}

		/**
		 * Show pagination links
		 */
		public function get_links() {
			// Set centering class
			$center = $this->centered ? 'aligncenter' : '';

			// If we have at least two pages
			if ( $this->total_pages > 1 ) { ?>
				<div class="pagination <?php echo $center; ?>">
					<?php
					$this->show_prev_navigation();
					$this->links();
					$this->show_next_navigation();
					?>
				</div>
			<?php }
		}
	}
endif;