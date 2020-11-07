<?
/**
 * This class represents infoblock
 * 
 * @since 1.0.0
 * @package infoblock
 * @author Anton Karamnov
 * @copyright 2013 Anton Karamnov
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
class Infoblock
{
	/**
	 * ID record
	 *
	 * @since 1.0.0
	 * @var string
	 */
	public $id;
	
	/**
	 * Title record
	 * 
	 * @since 1.0.0
	 * @var string
	 */
	public $title;
	
	/**
	 * Content record
	 * 
	 * @since 1.0.0
	 * @var string
	 */
	public $content;
	
	/**
	 * Date record
	 * 
	 * @since 1.0.0
	 * @var string
	 */
	public $date;
	
	/**
	 * Date record
	 * 
	 * @since 1.0.0
	 * @var string
	 */
	public $status;
	
	
	/**
	 * Create Infoblock
	 * 
	 * @since 1.0.0
	 * @params integer $id Contains a ID of post
	 */
	function __construct($id)
	{
		$post=get_post($id,'ARRAY_A');
		if($post===null)
		{
			echo '<p><b>Инфоблок с таким индентификатором не найден</b></p>';
		}
		else
		{
			$this->id=$post['ID'];
			$this->title=$post['post_title'];
			$this->content=$post['post_content'];
			$this->date=$post['post_date'];
			$this->status=$post['post_status'];
		}
	}
	
	/**
	 * Applies the filter "the_content" for the variable $this->content
	 * and returns the foltered value of this variable
	 * 
	 * @since 1.0.0
	 * @return string
	 */
	function getContent()
	{
		return apply_filters('the_content',$this->content);
	}
	
	/**
	 * Returns boolean value of true else record is post_status publish
	 * 
	 * @since 1.0.0
	 * @return boolean
	 */ 
	function isPublished()
	{
		if($this->status=='publish')
			return true;
			
		return false;
	}
	
	/**
	 * Returns the url to thumbnail of image
	 * 
	 * @since 1.0.1
	 * @return string
	 */
	function getThumbUrl()
	{
		return self::getThumbUrlByPostId($this->id);
	}
	
	/**
	 * Return the url to thumbnail of image find by post id
	 * 
	 * @since 1.0.1
	 * @return string
	 * @param integer $post_id Post ID
	 */
	static function getThumbUrlByPostId($post_id)
	{
		return wp_get_attachment_url(get_post_thumbnail_id($post_id));
	}
	
	/**
	 * Returns the list of attachments of images
	 * 
	 * @since 1.0.0
	 * @return array || boolean
	 */
	function getAttachmentImg()
	{
		$post=get_children(array(
			'post_parent'=>$this->id,
			'post_type'=>'attachment',
			'post_mime_type'=>'image',
			'orderby'=>'menu_order',
			'order'=>'ASC',
			'numberposts' => -1, 
			'post_status'=>null,
		));
		
		if(count($post)>0)
		{
			$img=array();
			foreach($post as $val)
			{
				$img[]=array(
					'img'=>$val->guid,
					'thumb'=>wp_get_attachment_thumb_url($val->ID),
				);
			}
			
			return $img;
		}
		else 
			return false;
	}
	
	/**
	 * Return the list all posts by $slug
	 * 
	 * @since 1.0.1
	 * @return array
	 * @param string $slug Slug is attrubute database of table wp_terms
	 */
	static function getAllBySlug($slug,$status='publish')
	{
		$posts=get_posts(array(
			'post_type'=>'infoblock',
			'post_status'=>'publish',
			'numberposts'=>-1,
			'orderby'=>'menu_order',
			'order'=>'ASC',
			'tax_query'=>array(
				array(
					'taxonomy'=>'category_infoblock',
					'field'=>'slug',
					'terms'=>$slug,
				),
			),
		));
		
		return $posts;
	}
	
}
