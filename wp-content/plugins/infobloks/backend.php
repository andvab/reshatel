<?
/**
 * Defines functionality for backend site.
 * 
 * @since 1.0.1
 * @package infoblock
 * @author Anton Karamnov
 * @copyright 2013 Anton Karamnov
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class Infoblocks_Backend
{
	/**
	 * Added columns to backend...
	 * 
	 * @since 1.0.1
	 * @return array
	 */
	function addColumns($columns)
	{
		$columns['category_infoblock']='Категория';
	//	unset($columns['date']);
		return $columns;
	}
	
	/**
	 * Displaing column for category
	 * 
	 * @param string $column_name
	 * @param integer $post_ID
	 * @since 1.0.1
	 */
	function columnsContent($column_name, $post_ID)
	{
		if($column_name=='category_infoblock')
		{
			$terms=wp_get_post_terms($post_ID,'category_infoblock');
			$termname='';
			foreach($terms as $term)
				$termname.=$term->name.', ';
			$termname=trim($termname,', ');
			echo $termname;
		}
	}
	 
	/**
	 * List of Categories for filter
	 * 
	 * @since 1.0.1
	 */
	function categoryFilterList()
	{
		$screen=get_current_screen();
		global $wp_query;
		if($screen->post_type=='infoblock')
		{
			wp_dropdown_categories( array(
				'show_option_all'=>'Все категории',
				'taxonomy'=>'category_infoblock',
				'name' => 'category_infoblock',
				'orderby' => 'name',
				'selected' => ( isset( $wp_query->query['category_infoblock'] ) ? $wp_query->query['category_infoblock'] : '' ),
				'hierarchical' => false,
				'depth' => 3,
				'show_count' => false,
				'hide_empty' => true,
			));
		}		
	}
	
	/**
	 * Filtering infobloks
	 * 
	 * @param object $query
	 */
	function performFiltering($query)
	{
		$qv=&$query->query_vars;
		if(($qv['category_infoblock'])&&is_numeric($qv['category_infoblock'])) 
		{
			$term=get_term_by('id',$qv['category_infoblock'],'category_infoblock');
			$qv['category_infoblock']=$term->slug;
		}
	}
}

// Filters 
add_filter('manage_posts_columns',array('Infoblocks_Backend','addColumns'));
add_filter('parse_query',array('Infoblocks_Backend','performFiltering'));

// Actions
add_action('manage_posts_custom_column',array('Infoblocks_Backend','columnsContent'),10,2);
add_action('restrict_manage_posts',array('Infoblocks_Backend','categoryFilterList'));


