<?
/**
 * Install & uninstall plugin API
 * 
 * @since 1.0.1
 * @package infoblock
 * @author Anton Karamnov
 * @copyright 2013 Anton Karamnov
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
 
/**
 *  Register content type infoblock
 */
add_action('init','register_content_type_infoblock');
function register_content_type_infoblock()
{
	register_post_type('infoblock',array(
		'labels'=>array(
			'name'=>'Инфоблоки',
			'singular_name'=>'Инфоблок',
			'add_new' => 'Добавить новый',
			'add_new_item' => 'Добавить новый инфоблок',
			'edit' => 'Редактировать',
			'edit_item' => 'Редактировать инфоблок',
			'new_item' => 'Добавить новый инфоблок',
			'view' => 'Просмотр',
			'view_item' => 'Просмотр инфоблока',
		),
		'show_ui'=>true,
		'_builtin'=>false,
		'_edit_link'=>'post.php?post=%d',
		'capability_type' => 'post',
		'hierarchical'=>false,
		'supports'=>array('title','editor','thumbnail','page-attributes'),
	));
}
/**
 * Register taxonomy for infoblok
 */
add_action('init','register_taxonomy_type_infoblock',0);
function register_taxonomy_type_infoblock()
{
	register_taxonomy(
		'category_infoblock',
		'infoblock',
		array(
			'hierarchical'=>true,
			'label'=>'Категории',
			'query_var'=>true,
			'rewrite'=>false,
		)
	);
}
