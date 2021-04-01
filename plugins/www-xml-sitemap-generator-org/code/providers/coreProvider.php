<?php

namespace xmlSitemapGenerator;

	class mapItem
	{
		function __construct() {}
		public $location ;
		public $title ;
		public $description ;
		public $modified = null ;
		public $priority ;
		public $frequency ;
		public $images  = null;
	}

	class mediaItem
	{
		function __construct() {}
		public $location ;
		public $title ;
		public $caption ;
		public $description ;

	}

	interface iSitemapProvider
	{
 
		public function getSuppportedTypes(); // returns a list of the types supported by this provider
		public function setFormat($format); // sets the base file url for the sitemap
		public function getPageCount($type); // returns the number of sitemap pages for this type.
		public function getPage($type, $page); //
	}

	class sitemapProvider
	{
		
		// returns a list of  the core provider types
		static function getProviderList()
		{	
			return array(  "posts", "terms", "archive", "authors");
		}
		
		// creates an instance of the correct provider for the given type
		static function getInstance($type)
		{
			$file = $type . 'Provider.php';
			if (@include_once($file))
			{
				$class = '\\xmlSitemapGenerator\\' . $type . 'Provider';
				return new $class();				
			}
			else
			{
				echo 'XML Sitemap Generator Error. <br />Invalid Renderer type specified : ' . $type;
				exit;
			}
		}
	}

	class providerCore 
	{
		
	
		protected $urlsList = array();
		protected $blogPageSize ;
		protected $isExecuting = false;
		protected $siteName = "";
		protected $blogUrl = "";
		protected $instance;
		protected $sitemapDefaults;
		protected $tablemeta;
		protected $format = "";
		protected $globalSettings;
		
		public function __construct() { 
			global $wpdb;
			$this->blogPageSize = get_option('posts_per_page');
			$this->urlsList = array();	
			$this->siteName = get_option('blogname');
			$this->blogUrl = get_bloginfo( 'url' );
			$this->tablemeta = $wpdb->prefix . 'xsg_sitemap_meta';
			$this->sitemapDefaults =  get_option( "wpXSG_sitemapDefaults"   , new sitemapDefaults()  );
			$this->globalSettings =  core::getGlobalSettings();

		}
		
		public function setFormat($format)
		{
			$this->format = $format;
		}
		
		public static function renderTest($msg)
		{
			
	
		 	ob_start();
			header('Content-Type: text/html; charset=utf-8');
			
			echo var_dump($msg);

			echo  "\n";
			ob_end_flush();
			exit;
		}
		

		
		private function getAttribute($name, $html)
		{
			preg_match( '@' . $name . '="([^"]+)"@' , $html, $match );
			return array_pop($match);
		}


	// get image from post result
		protected function getImage( $result)
		{
			if ( !empty($result->imageUrl) )
			{
				$new = new mediaItem();
				$new->title = $result->imageTitle;
				$new->caption = $result->imageCaption;
				$new->location = $result->imageUrl;
				return $new;				
			}

		}

	// get images from html
		protected function getImages($content)
		{
			preg_match_all('/<img[^>]+>/i', $content, $matches );
			
			$images = array();
			foreach($matches[0] as $match) {
				$url = $this->getAttribute("src",$match);	
				// need to validate url is in this site. 
				//remove any resizing. -1024x682.
				
				
				$new = new mediaItem();
				$new->title = $this->getAttribute("title",$match);
				$new->caption = $this->getAttribute("alt",$match);
				$new->location =  $url;
				array_push($images, $new);		
							
			}
			return $images;

		}


 
		static function getDateField($name)
		{
			if ($name == "created")
			{ 
				return "post_date";
			}
			else
			{
				return "post_modified";
			}
		}
		
		function getPages($count, $pageSize)
		{
			return ceil($count / $pageSize);
		}
		
		function getBlogPageCount($results)
		{
			$totalPages = 0;
			foreach( $results as $result ) 
			{
				$pages = 1;
				$posts = $result->posts +1;
				if ($posts > $this->blogPageSize)
				{
					$pages =  ceil($posts / $this->blogPageSize);
				}
				$totalPages += $pages;
			}
			return $totalPages;
		}
		
		function isIncluded($url, $rules)
		{
			//todo
			
			return true;
			
		}
		function isExcluded($value)
		{
			if (isset($value)) 
			{
				if ($value==2) {return true;}
			}
			return false;
		}
		
		function getMetaValue($postValue,$tagValue,$default)
		{
			
			if (isset($postValue)) 
			{
				
				if ( $postValue != 1) { return $postValue; }
			}
			
			if (isset($tagValue)) 
			{
				if ( $tagValue != 1) {return $tagValue; }
			}
		
			return $default;

		}
		
		function addUrls($postCount, $mapItem)
		{
			$pages = 1;
	
			if ($postCount > $this->blogPageSize)
			{
				$pages =  ceil($postCount / $this->blogPageSize);
			}
			
			
			$mapItem->title = $mapItem->title;
			array_push($this->urlsList, $mapItem); // first page
			for ($x = 2; $x <= $pages; $x++) 
			{
				$new = clone $mapItem;
				$new->title = $new->title .  " | Page " . $x;
				$new->location = $this->getPageLink($mapItem->location,$x);	
				array_push($this->urlsList, $new);
			} 

		}	
		
		
		function getPageLink($url, $pagenum = 1, $escape = true ) {
			global $wp_rewrite;
		 
			$pagenum = (int) $pagenum;
		 
			$home_root = preg_quote( home_url(), '|' );
			$request = $url;

			
			$request = preg_replace('|^'. $home_root . '|i', '', $request);
			$request = preg_replace('|^/+|', '', $request);
		 
			
			if ( !$wp_rewrite->using_permalinks() || is_admin() ) {
				$base = trailingslashit( $this->$blogUrl );
			
				if ( $pagenum > 1 ) {
					$result = add_query_arg( 'paged', $pagenum, $base . $request );
				} else {
					$result = $base . $request;
				}
			} else {
				$qs_regex = '|\?.*?$|';
				preg_match( $qs_regex, $request, $qs_match );
		 
				if ( !empty( $qs_match[0] ) ) {
					$query_string = $qs_match[0];
					$request = preg_replace( $qs_regex, '', $request );
				} else {
					$query_string = '';
				}
		 
				$request = preg_replace( "|$wp_rewrite->pagination_base/\d+/?$|", '', $request);
				$request = preg_replace( '|^' . preg_quote( $wp_rewrite->index, '|' ) . '|i', '', $request);
				$request = ltrim($request, '/');
		 
				$base = trailingslashit( $this->blogUrl );
		 
				if ( $wp_rewrite->using_index_permalinks() && ( $pagenum > 1 || '' != $request ) )
					$base .= $wp_rewrite->index . '/';
		 
				if ( $pagenum > 1 ) {
					$request = ( ( !empty( $request ) ) ? trailingslashit( $request ) : $request ) . user_trailingslashit( $wp_rewrite->pagination_base . "/" . $pagenum, 'paged' );
				}
		 
				$result = $base . $request . $query_string;
			}
		 
			$result = apply_filters( 'get_pagenum_link', $result );
		 
			if ( $escape )
				return esc_url( $result );
			else
				return esc_url_raw( $result );
		}
		
	}
	

?>