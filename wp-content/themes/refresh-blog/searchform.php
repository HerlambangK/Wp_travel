
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" method="get" class="search-form">
	<label>
		 <span class="screen-reader-text"><?php printf( esc_html__( 'Search for: %s', 'refresh-blog' ), get_search_query() ); ?></span>
		<input class="search-field" type="search" name="s" placeholder="<?php esc_attr_e( 'Search...', 'refresh-blog' ); ?>" value="<?php echo get_search_query(); ?>" >
	</label>
	<button type="submit" class="search-submit">
		<svg viewBox="0 0 56.966 56.966" class="icon-search">
			<path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23
			s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92
			c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17s-17-7.626-17-17S14.61,6,23.984,6z"></path>
		</svg>
	</button>
</form>
