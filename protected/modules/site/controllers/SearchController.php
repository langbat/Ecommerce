<?php

class SearchController extends SiteBaseController {
    const PAGE_SIZE = 8;
    public $membershop, $product, $categoryshop;
    public function init()
	{
		parent::init();
		//$this->breadcrumbs[ Yii::t('global', 'Shop Newsletters') ] = array('shop-newsletter/index');
		$this->pageTitle[] = Yii::t('global', 'Search');
	}
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionIndex()
	{
	   $this->layout = 'shop';
	   $this->render('index');
	}
    public function actionSearch()
	{
       $name='';
       $free_shipping = isset($_GET['free_shipping'])?$_GET['free_shipping']:'';
       $reduced = isset($_GET['reduced'])?$_GET['reduced']:'';
       $in_stock =isset($_GET['in_stock'])?$_GET['in_stock']:'';
       $cate = isset($_GET['producer'])?$_GET['producer']:'null';
       $categoryShop = strpos($cate, '_')!==false?(substr($cate, 1)):'';
       $category = $categoryShop==''?$cate:'';
       if($cate=='null')$categoryShop='null';
       $price = isset($_GET['price'])?$_GET['price']:'';
	   if(isset($_GET['q'])){
             Yii::app()->session['conditions[name]'] = $_GET['q'];
	   }
       if(isset(Yii::app()->session['conditions[name]'])){
            $name = Yii::app()->session['conditions[name]'];
       }
    	$product = Products::model()->getAllProductsLikeName($name,$free_shipping,$reduced,$in_stock,$category,$price);
        $productshop = ProductsShop::model()->getAllProductsLikeName($name,$free_shipping,$reduced,$in_stock,$categoryShop,$price);
    	$count_shipping_cost=0;
    	$count_discount_percent = 0;
    	$count_shipping_immediately = 0;
        
        $products =  Products::model()->getAllProductsByLikeName($name,$free_shipping,$reduced,$in_stock,$category,$price);
        $product_ids = Products::model()->getIdsOfProductsLikeName($name,$free_shipping,$reduced,$in_stock,$price);
        $products->pagination->pageSize=self::PAGE_SIZE;
        
        $productsShop =  ProductsShop::model()->getAllProductsShopByLikeName($name,$free_shipping,$reduced,$in_stock,$categoryShop,$price);
        $productshop_ids = ProductsShop::model()->getIdsOfProductsShopLikeName($name,$free_shipping,$reduced,$in_stock,$price);
        $productsShop->pagination->pageSize=self::PAGE_SIZE;
       foreach ($product as $pro){
        	($pro->shipping_cost==0)?$count_shipping_cost++:'';
        	($pro->discount_percent!=0)?$count_discount_percent++:'';
        	($pro->shipping_immediately==1)?$count_shipping_immediately++:'';
    	}
    	foreach ($productshop as $pro){
        	($pro->shipping_cost==0)?$count_shipping_cost++:'';
        	($pro->discount_percent!=0)?$count_discount_percent++:'';
        	($pro->shipping_immediately==1)?$count_shipping_immediately++:'';
    	}
        // category
        $cate = array(' '=>Yii::t("global","All Category"));
		$categories = Categories::getArrayCategoryByProduct($product_ids);
		$categoriesShop = CategoriesShop::getArrayCategoryByProduct($productshop_ids);
		$categorys = ($cate+$categories+$categoriesShop);
        //end category
        
        //list price
        $product = Products::model()->getAllProductsLikeName($name,$free_shipping,$reduced,$in_stock,$category,'');
        $productshop = ProductsShop::model()->getAllProductsLikeName($name,$free_shipping,$reduced,$in_stock,$categoryShop,'');
		$product_ids = Products::model()->getIdsOfProductsLikeName($name,$free_shipping,$reduced,$in_stock,'');
        $productshop_ids = ProductsShop::model()->getIdsOfProductsShopLikeName($name,$free_shipping,$reduced,$in_stock,'');
		$priceMax =array();
		$price =array();
		$priceshop =array();
		$list_price = array();
		$list_price["0-1"]='bis 1 € ('.Products::model()->countProductBetweenPrice($product_ids,$productshop_ids,0,1,$free_shipping,$reduced,$in_stock,$category,$categoryShop).')';
		foreach ($product as $pro){
            $price[] = $pro->price_purchase;
		}
		foreach ($productshop as $pro){
            $priceshop[] = $pro->price_purchase;
		}
    
		$priceMax[]=!empty($price)?max($price):'';
		$priceMax[]=!empty($priceshop)?max($priceshop):'';
		$priceMax =max($priceMax);
		$counter =1;
		$counters =1;
		$array_pr = array(1,2,5);
		while($counters<$priceMax){
            $temp = array();
    		foreach($array_pr as $item){
      		    if($counter>$priceMax){
        		      break;
                    }
        		if($item<10){
                    $counters = $item;
        		}else{
                    $counters= $counter*$item;
        		}
        		if($counters>$priceMax){
                    $counters= $counter*2;
        		}
        		if($counter!=$counters)
                    $list_price["$counter-$counters"]=$counter.' € - '.$counters.' € ('.Products::model()->countProductBetweenPrice($product_ids,$productshop_ids,$counter,$counters,$free_shipping,$reduced,$in_stock,$category,$categoryShop).')';
        		$counter =$counters;
        		$temp[]=$counter*10;
        		}
    		unset($array_pr);
    		$array_pr = $temp;
    		unset($temp);
		}                        
       $this->render('search',compact('products','product_ids','productsShop','productshop_ids','count_shipping_cost','count_discount_percent','count_shipping_immediately','free_shipping','reduced','in_stock','categorys','list_price')); 
	}
    public function actionDetail($condition)
	{
	   if($condition == ''){
	       $product = Products::model()->getProductAll();
           $productshop = ProductsShop::model()->getProductShopAll();
	   }else{
	       $productshop = ProductsShop::model()->getSearchProductShopByName($condition);
	       $product = Products::model()->getSearchProductByName($condition);
	   }
        
    $this->render('detail', array(
        'product'=>$product,
        'productshop'=>$productshop
    ));
	}
}
