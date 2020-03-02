function wha_pagination_nav() {

    if( is_singular() )
        return;
    
    global $wp_query;
    
    /** Stops execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
    
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max = intval( $wp_query->max_num_pages );
    
    /** Adds current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
    
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
    
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
    
    echo '<div class="nav-links"><ul class="pagination">' . "\n";
    
    /** Previous Post Link Function */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link('&#8249;','') );
    
    /** Links to the first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
        $canonical = 1 == $paged ? ' rel="canonical"' : '';
        $pre = $paged > 1  ? ' rel="prev"' : '';
        $next = $paged < 1 ? ' rel="next"' : '';
        if( !empty($canonical) )
            printf( '<li%s><a %s href="%s" class="page-numbers">%s</a></li>' . "\n", $class, $canonical, esc_url( get_pagenum_link( 1 ) ), '1' );
        if( !empty($pre) )
            printf( '<li%s><a %s href="%s" class="page-numbers">%s</a></li>' . "\n", $class, $pre, esc_url( get_pagenum_link( 1 ) ), '1' );
        if( !empty($next))
            printf( '<li%s><a %s href="%s" class="page-numbers">%s</a></li>' . "\n", $class, $next, esc_url( get_pagenum_link( 1 ) ), '1' );
        // printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
        
        if ( ! in_array( 2, $links ) )
        echo '<li><span class="dots page-numbers">…</span></li>';
    } 
    
    /** Links to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        $canonical = $paged == $link ? ' rel="canonical"' : '';
        $pre = $paged > $link ? ' rel="prev"' : '';
        $next = $paged < $link ? ' rel="next"' : '';
        if( !empty($canonical) )
            printf( '<li%s><a %s href="%s" class="page-numbers">%s</a></li>' . "\n", $class, $canonical, esc_url( get_pagenum_link( $link ) ), $link );
        if( !empty($pre) )
            printf( '<li%s><a %s href="%s" class="page-numbers">%s</a></li>' . "\n", $class, $pre, esc_url( get_pagenum_link( $link ) ), $link );
        if( !empty($next))
            printf( '<li%s><a %s href="%s" class="page-numbers">%s</a></li>' . "\n", $class, $next, esc_url( get_pagenum_link( $link ) ), $link );
    }
    
    /** Links to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li><span class="dots page-numbers">…</span></li>' . "\n";
    
        $class = $paged == $max ? ' class="active"' : '';
        $canonical = $paged == $max ? ' rel="canonical"' : '';
        $pre = $paged > $max  ? ' rel="prev"' : '';
        $next = $paged < $max ? ' rel="next"' : '';
        // printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
        if( !empty($canonical) )
            printf( '<li%s><a %s href="%s" class="page-numbers">%s</a></li>' . "\n", $class, $canonical, esc_url( get_pagenum_link( $max ) ), $max );
        if( !empty($pre) )
            printf( '<li%s><a %s href="%s" class="page-numbers">%s</a></li>' . "\n", $class, $pre, esc_url( get_pagenum_link( $max ) ), $max );
        if( !empty($next))
            printf( '<li%s><a %s href="%s" class="page-numbers">%s</a></li>' . "\n", $class, $next, esc_url( get_pagenum_link( $max ) ), $max );
    }
    
    /** Next Post Link function */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link('&#8250;','') );
    
    echo '</ul></div>' . "\n";
}
