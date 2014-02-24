<?php
/**
 * Custom rules manager class
 *
 * Override to load the routes from the DB rather then a file
 *
 */
class CustomUrlManager extends CUrlManager {
    /**
     * Build the rules from the DB
     */
    protected function processRules() {

		$active_lang = implode('|', array_keys( Yii::app()->params['languages'] ));
		$domain = Yii::app()->params['current_domain'];
		
		// if( ($urlrules = Yii::app()->cache->get('customurlrules')) === false )
		// {
			$_more = array();
			
			$dbCommand = Yii::app()->db->createCommand("SELECT alias, language FROM {{custompages}}")->query();
			$urlRules = $dbCommand->readAll();
			foreach($urlRules as $rule)
			{
				$_more[ "/<alias:({$rule['alias']})>" ] = array('site/custompages/index');
			}
			
			
			$dbCommand = Yii::app()->db->createCommand("SELECT id, seoname FROM {{members}}")->query();
			$urlUsers = $dbCommand->readAll();
			foreach($urlUsers as $uu)
			{
				$_more[ "/user/<id:({$uu['id']})>-<alias:({$uu['seoname']})>" ] = array('site/users/viewprofile');
			}

			$this->rules = array(

				//-----------------------ADMIN--------------
				"/admin" => 'admin/index/index',
				"/admin/<_c:([a-zA-z0-9-]+)>" => 'admin/<_c>/index',
				"/admin/<_c:([a-zA-z0-9-]+)>/<_a:([a-zA-z0-9-]+)>" => 'admin/<_c>/<_a>',
				"/admin/<_c:([a-zA-z0-9-]+)>/<_a:([a-zA-z0-9-]+)>//*" => 'admin/<_c>/<_a>/',
				//-----------------------ADMIN--------------

                //gii
                "/gii" => array('gii'),
                "/gii/<_c:([a-zA-z0-9-_]+)>" => array('gii/<_c>/'),
                "/gii/<_c:([a-zA-z0-9-_]+)>/<_a:([a-zA-z0-9-_]+)>/*" => array('gii/<_c>/<_a>/'),

				"/products/category/<alias:.*?>" => 'site/products/category/',
                "/products/active/<type:(lowprice|cent|all)>/" => 'site/products/active/',
                "/products/ended/<type:(lowprice|cent|all)>/" => 'site/products/ended/',
                "/products/upcoming/<type:(lowprice|cent|all)>/" => 'site/products/upcoming/',
                "/products/label/<id:([a-zA-z0-9-_]+)?>" => 'site/products/label/',
                "/messagesShop/index/<shop_id:([a-zA-z0-9-_]+)?>" => 'site/messagesShop/index/',
                
                "/register/" => 'site/profile/create/',
                "/Anmeldung/" => 'site/profile/create/',
                
                "/search/detail/<condition:([a-zA-z0-9-_]+)?>" => 'site/search/detail',
                "/shop/search/<shop_id:([a-zA-z0-9-_]+)?>/<condition:([a-zA-z0-9-_]+)?>" => 'site/shop/search/',
                "/search.html/" => 'site/search/search',
                "/orders/customer/<shop_id:([a-zA-z0-9-_]+)>" => 'site/orders/customer/',
                "/admin/orders/vi_customer/<id:([a-zA-z0-9-_]+)>" => 'site/admin/orders/vi_customer/',
                "/shopRatings/detail/<shop_id:([a-zA-z0-9-_]+)>" => 'site/shopRatings/detail/',
                "/shopManager/detail/<shop_id:([a-zA-z0-9-_]+)>" => 'site/shopManager/detail/',
                "/custompages/detail/<alias:.*?>" => 'site/custompages/detail',
                "/shopNewsletter/sendNewletter/<shop_id:([a-zA-z0-9-_]+)>" => 'site/shopNewsletter/sendNewletter/',
                "/shopNewsletter/join/<shop_id:([a-zA-z0-9-_]+)>" => 'site/shopNewsletter/join/',
                "/blogshop/blog/<shop_id:([a-zA-z0-9-_]+)>/<blog_id:([a-zA-z0-9-_]+)>" => 'site/blogshop/blog/',
                "/blogshop/detail/<shop_id:([a-zA-z0-9-_]+)>" => 'site/blogshop/detail/',
                "/shop/sort/<shop_id:([a-zA-z0-9-_]+)>/<sort_id:([a-zA-z0-9-_]+)>" => 'site/shop/sort/',
                "/shop/contact/<shop_id:([a-zA-z0-9-_]+)>" => 'site/shop/contact/',
                "/shop/star/<shop_id:([a-zA-z0-9-_]+)>/<star:([a-zA-z0-9-_]+)>" => 'site/shop/star/',
                "/shop/findproduct/<shop_id:([a-zA-z0-9-_]+)>/<price:([a-zA-z0-9-_]+)>" => 'site/shop/findproduct/',
                "/shop/category/<shop_id:([a-zA-z0-9-_]+)>/<category_id:([a-zA-z0-9-_]+)>" => 'site/shop/category/',
                "/productsshop/detail/<shop_id:([a-zA-z0-9-_]+)>/<id:([a-zA-z0-9-_]+)>" => 'site/productsShop/detail/',
                "/productsshop/addComment" => 'site/productsShop/addComment',
                "/products/detail/<id:([a-zA-z0-9-_]+)>" => 'site/products/detail/',
                "/tags/detail/<slug:([a-zA-z0-9-_]+)>" => 'site/tags/detail/',
                 "/shop/detail/<shop_id:([a-zA-z0-9-_]+)>" => 'site/shop/detail/',
                
                "/votes/voting/<type:(lowprice|cent|all)>/" => 'site/votes/voting/',

				"/<_a:(register|login|logout|verify)>" => 'site/users/<_a>',
				"/admin-login" => 'site/users/admin',
				"/forgot-password" => 'site/users/lostpassword',
				"/change-password" => 'site/users/changepass',
				"/contact-us" => 'site/contactus/index',
				"/messages" => 'site/usermessages/index',
				"/<_a:(viewmessage|sendmessage)>" => 'site/usermessages/<_a>',
				// "/invoices" => 'site/transactions/index',
				// "/buy-a-plan" => 'site/transactions/buyplan',
				// "/<_a:(earning|cashout)>" => 'site/transactions/<_a>',
				// "/<id:(\d+)>-<ualias:(.*?)>/blog/<alias:(.*)>" => array('site/blog/viewpost'),
				// Blogs
				"/blog/category/<alias:(.*)>" => 'site/blog/viewcategory',
				"/blog/view/<alias:(.*)>" => 'site/blog/viewpost',

				"/" => 'site/index/index',
				"/<_c:([a-zA-z0-9-]+)>" => 'site/<_c>/index',
				"/<_c:([a-zA-z0-9-]+)>/<_a:([a-zA-z0-9-]+)>" => 'site/<_c>/<_a>',
				"/<_c:([a-zA-z0-9-]+)>/<_a:([a-zA-z0-9-]+)>//*" => 'site/<_c>/<_a>/',
                
                
               
			);

			$urlrules = array_merge( $_more, $this->rules );
			//Yii::app()->cache->set('customurlrules', $urlrules);
		// }
		
		$this->rules = $urlrules;
		
        // Run parent
        parent::processRules();

    }

	/**
	 * Clear the url manager cache
	 */
	public function clearCache()
	{
		Yii::app()->cache->delete('customurlrules');
	}

    /**
     *
     * @see CUrlManager 
     *
     * Constructs a URL.
     * @param string the controller and the action (e.g. article/read)
     * @param array list of GET parameters (name=>value). Both the name and value will be URL-encoded.
     * If the name is '#', the corresponding value will be treated as an anchor
     * and will be appended at the end of the URL. This anchor feature has been available since version 1.0.1.
     * @param string the token separating name-value pairs in the URL. Defaults to '&'.
     * @return string the constructed URL
     */
    public function createUrl($route,$params=array(),$ampersand='&')
    {
        // We added this by default to all links to show
        // Content based on language - Add only when not excplicity set
		/*if( !isset($params['lang']) )
		{
			$params['lang'] = Yii::app()->language;
		}
		
		if( ( isset($params['lang']) && $params['lang'] === false ) )
		{
			unset($params['lang']);
		}*/
		if( isset($params['lang']) )
		{
			unset($params['lang']);
		}
        // Use parent to finish url construction
        return parent::createUrl($route, $params, $ampersand);
    }
}
