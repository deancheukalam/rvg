  <?php
/**
 * @package PermalinksCustomizer
 */

/**
 * Create PostTypes Permalinks page.
 *
 * Create PostTypes Permalinks HTML and display the page.
 *
 * @since 1.3.3
 */
class Permalinks_Customizer_PostType_Permalinks {

  /**
   * Call Post Permalinks Function.
   */
  function __construct() {
    $this->post_permalinks();
  }

  /**
   * Shows all the Permalinks created by using this Plugin with Pager
   * and Search Functionality of Posts/Pages.
   *
   * @since 1.3.3
   * @access private
   */
  private function post_permalinks() {
    global $wpdb;
    $filter_options   = '';
    $search_permalink = '';
    $html             = '';

    // Handle Bulk Operations
    if ( ( ( isset( $_POST['action'] ) && 'delete' == $_POST['action'] )
      || ( isset( $_POST['action2'] ) && 'delete' == $_POST['action2'] ) )
      && isset( $_POST['permalink'] ) && ! empty( $_POST['permalink'] ) ) {
      $post_ids =  implode( ',', $_POST['permalink'] );
      if ( preg_match( '/^\d+(?:,\d+)*$/', $post_ids ) ) {
        $wpdb->query( "DELETE FROM $wpdb->postmeta WHERE post_id IN ($post_ids) AND meta_key = 'permalink_customizer'" );
        $permalink = count( $_POST['permalink'] );
        printf( '<div id="message" class="updated notice notice-success is-dismissible"><p>' .
          _n( '%s Permalink is deleted.',
            '%s Permalinks are deleted.',
            $permalink,
            'permalinks-customizer'
          ) . '</p></div>', $permalink );
      } else {
        $error = '<div id="message" class="error">' .
                    '<p>' . __( 'There is some error to proceed your request. Please retry with your request or contact to the plugin author.', 'permalinks-customizer' ) . '</p>' .
                 '</div>';
      }
    }

    require_once(
      PERMALINKS_CUSTOMIZER_PATH . 'admin/class-permalinks-customizer-common-functions.php'
    );
    $common_functions = new Permalinks_Customizer_Common_Functions();

    $html .= '<div class="wrap">' .
                '<h1 class="wp-heading-inline">' . __( 'PostTypes Permalinks', 'permalinks-customizer' ) . '</h1>';

    $search_value     = '';
    $filter_permalink = '';
    if ( isset( $_GET['s'] ) && ! empty( $_GET['s'] ) ) {
      $search_value     = htmlspecialchars( ltrim( $_GET['s'], '/' ) );
      $filter_permalink = 'AND pm.meta_value LIKE "%' . $search_value . '%"';
      $search_permalink = '&s=' . $search_value . '';
      $html            .= '<span class="subtitle">Search results for "' . $search_value . '"</span>';
    }
    $page_limit = 'LIMIT 0, 20';
    if ( isset( $_GET['paged'] ) && is_numeric( $_GET['paged'] )
      && $_GET['paged'] > 1 ) {
      $pager      = 20 * ( $_GET['paged'] - 1 );
      $page_limit = 'LIMIT ' . $pager . ', 20';
    }
    $sorting_by     = 'ORDER By p.ID DESC';
    $order_by       = 'asc';
    $order_by_class = 'desc';
    if ( isset( $_GET['orderby'] ) && ( 'title' === $_GET['orderby']
      || 'permalink' === $_GET['orderby'] || 'type' === $_GET['orderby'] ) ) {
      if ( 'permalink' === $_GET['orderby'] ) {
        $set_orderby = 'pm.meta_value';
      } elseif ( 'type' === $_GET['orderby'] ) {
        $set_orderby = 'p.post_type';
      } else {
        $set_orderby = 'p.post_title';
      }
      $filter_options .= '<input type="hidden" name="orderby" value="' . $set_orderby . '" />';
      if ( isset( $_GET['order'] ) && $_GET['order'] == 'desc' ) {
        $sorting_by      = 'ORDER By ' . $set_orderby . ' DESC';
        $order_by        = 'asc';
        $order_by_class  = 'desc';
        $filter_options .= '<input type="hidden" name="order" value="desc" />';
      } else {
        $sorting_by      = 'ORDER By ' . $set_orderby;
        $order_by        = 'desc';
        $order_by_class  = 'asc';
        $filter_options .= '<input type="hidden" name="order" value="asc" />';
      }
    }
    $count_query = "SELECT COUNT(p.ID) AS total_permalinks FROM $wpdb->posts AS p " .
                    " LEFT JOIN $wpdb->postmeta AS pm ON (p.ID = pm.post_id) " .
                    " WHERE pm.meta_key = 'permalink_customizer' " .
                    " AND pm.meta_value != '' " . $filter_permalink . "";
    $count_posts = $wpdb->get_row( $count_query );

    $html .= '<form action="' . $_SERVER["REQUEST_URI"] . '" method="get">';
    $html .= '<p class="search-box">';
    $html .= '<input type="hidden" name="page" value="permalinks-customizer-post-permalinks" />';
    $html .= $filter_options;
    $html .= '<label class="screen-reader-text" for="permalinks-customizer-search-input">Search Permalinks Customizer:</label>';
    $html .= '<input type="search" id="permalinks-customizer-search-input" name="s" value="' . $search_value . '">';
    $html .= '<input type="submit" id="search-submit" class="button" value="Search Permalink"></p>';
    $html .= '</form>';
    $html .= '<form action="' . $_SERVER["REQUEST_URI"] . '" method="post">';
    $html .= '<div class="tablenav top">';
    $html .= '<div class="alignleft actions bulkactions">' .
                '<label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>' .
                '<select name="action" id="bulk-action-selector-top">' .
                  '<option value="-1">' . __( "Bulk Actions", "permalinks-customizer" ) . '</option>' .
                  '<option value="delete">' . __( "Delete Permalinks", "permalinks-customizer" ) . '</option>' .
                '</select>' .
                '<input type="submit" id="doaction" class="button action" value="Apply">' .
              '</div>';

    $posts           = 0;
    $pagination_html = '';
    if ( isset( $count_posts->total_permalinks )
      && $count_posts->total_permalinks > 0 ) {
      $html .= '<h2 class="screen-reader-text">Permalinks Customizer navigation</h2>';

      $query = "SELECT p.ID, p.post_title, p.post_type, pm.meta_value FROM $wpdb->posts AS p " .
                " LEFT JOIN $wpdb->postmeta AS pm ON (p.ID = pm.post_id) " .
                " WHERE pm.meta_key = 'permalink_customizer' " .
                " AND pm.meta_value != '' " .
                $filter_permalink . " " . $sorting_by . " " . $page_limit . "";
      $posts = $wpdb->get_results( $query );

      $total_pages = ceil( $count_posts->total_permalinks / 20 );
      if ( isset( $_GET['paged'] ) && is_numeric( $_GET['paged'] )
        && $_GET['paged'] > 0 ) {
        $pagination_html = $common_functions->get_pager(
          $count_posts->total_permalinks, $_GET['paged'], $total_pages
        );
        if ( $_GET['paged'] > $total_pages ) {
          $redirect_uri = explode( '&paged=' . $_GET['paged'] . '', $_SERVER['REQUEST_URI'] );
          header( 'Location: ' . $redirect_uri[0], 301 );
          exit();
        }
      } elseif ( ! isset( $_GET['paged'] ) ) {
        $pagination_html = $common_functions->get_pager(
          $count_posts->total_permalinks, 1, $total_pages
        );
      }

      $html .= $pagination_html;
    }
    $table_navigation = $common_functions->get_tablenav(
      $order_by_class, $order_by, $search_permalink, $_GET['page']
    );

    $html .= '</div>';
    $html .= '<table class="wp-list-table widefat fixed striped posts">' .
                '<thead>' . $table_navigation . '</thead>' .
                '<tbody>';
    if ( 0 != $posts && ! empty( $posts ) ) {
      foreach ( $posts as $post ) {
        $pview = home_url() . '/' . $post->meta_value;
        $html .= '<tr valign="top">';
        $html .= '<th scope="row" class="check-column"><input type="checkbox" name="permalink[]" value="' . $post->ID . '" /></th>';
        $html .= '<td><strong><a class="row-title" href="post.php?action=edit&post=' . $post->ID . '">' . $post->post_title . '</a></strong></td>';
        $html .= '<td>' . ucwords( $post->post_type ) . '</td>';
        $html .= '<td><a href="' . $pview . '" target="_blank" title="' . __( "Visit ". $post->post_title, "permalinks-customizer" ) . '">/' . urldecode( $post->meta_value ) . '</a></td></tr>';
      }
    } else {
      $html .= '<tr class="no-items"><td class="colspanchange" colspan="4">No permalinks found.</td></tr>';
    }
    $html .= '</tbody>' .
              '<tfoot>' . $table_navigation . '</tfoot>' .
              '</table>';

    $html .= '<div class="tablenav bottom">' .
                '<div class="alignleft actions bulkactions">' .
                  '<label for="bulk-action-selector-bottom" class="screen-reader-text">' . __( "Select bulk action", "permalinks-customizer" ) . '</label>' .
                  '<select name="action2" id="bulk-action-selector-bottom">' .
                    '<option value="-1">' . __( "Bulk Actions", "permalinks-customizer" ) . '</option>' .
                    '<option value="delete">' . __( "Delete Permalinks", "permalinks-customizer" ) . '</option>' .
                  '</select>' .
                  '<input type="submit" id="doaction2" class="button action" value="Apply">' .
                '</div>' .
                $pagination_html .
              '</div>';
    $html .= '</form></div>';
    echo $html;
  }
}
