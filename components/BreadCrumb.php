<?php
/**
 * $excludeCrumbs : tempat buang menu. tiada session disini
 * Yii::$app->getRequest()->getQueryParam('id') : cek mana2 yg htr param id akan ada session kecuali yg ada menu /create
 * fail layouts/main.php : cara nak panggil component yg dibuat
 *          <?= app\components\BreadCrumb::widget([
                'newCrumb' => [
                    'name' => isset($this->crumbTitle)?$this->crumbTitle:$this->title, 
                    'url' => array($_SERVER['REQUEST_URI'])                   
                    ]
                ]);           
            ?>
 * Bahagian views/ : mesti ada title seperti dibawah @ boleh htr param
 *  $this->title = Yii::t('app', 'Customers');
    $this->params['breadcrumbs'][] = $this->title;

 */

namespace app\components;
use yii;
use yii\base\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class BreadCrumb extends Widget {

    public $crumbs = array();
    public $newCrumb = array();
    public $delimiter = ' / ';//&rarr;
    public $hideCrumbsOnHome = true;
    public $firstCrumbName = 'Home';//Menu mula2, x boh letak false
    public $firstCrumb = array('Home' => array('name' => 'Home', 'url' => array()));
    public $excludeCrumbs = array('Sign in','Sign up','My Yii Application');//kalau nak buang masukkan title
    public $crumbs2Show = 4;
    public $truncatedCrumb = array('Truncated' => array('name' => '&#8230;'));
    
    //public $tag = 'ul';
    //public $options = ['class' => 'breadcrumb'];
    public $encodeLabels = true;
    //public $itemTemplate = "<li>{link}</li>\n";
    /**
     * @var string the template used to render each active item in the breadcrumbs. The token `{link}`
     * will be replaced with the actual HTML link for each active item.
     */
    //public $activeItemTemplate = "<li class=\"active\">{link}</li>\n";
    public function run() {
        $headergrey="";$closeheadergrey="";
	// if home url is not supplied, use application base url
	if (count($this->firstCrumb['Home']['url'])==0)
	    $this->firstCrumb['Home']['url'] = Yii::$app->UrlManager->baseUrl."/";///DemoYii2/web/ Yii::$app->UrlManager->baseUrl.
        
	if ($this->firstCrumbName) $this->firstCrumb['Home']['name']=$this->firstCrumbName;
        
        // Breadcrumbs are a way back to to the homepage so dump
        // the crumbs if we find ourselves back on the homepage
        $homepageRoutes = array('/index.php',Yii::$app->request->baseUrl.'/site/index', '/');
        //$homepageRoutes = array('/index.php', '/'.Yii::app()->defaultController.'/list', '/');
	
        if ( in_array($this->newCrumb['url'][0], $homepageRoutes)) {
            unset ($_SESSION['crumbs']);
       
            // If desired, don't show the lone Home crumb on
            // the homepage
            if ($this->hideCrumbsOnHome) {
                return;
            }
        }
       
        // Place the homepgage anchor crumb in the first position
        $this->crumbs = $this->firstCrumb;        
        if(!Yii::$app->getRequest()->getQueryParam('id')){//cek ada htr param id dok..kalau x dok set default
            $pos = strpos($this->newCrumb['url'][0], "/create");
            if ($pos === false) {//x jumpa kekalkan session               
                if(isset($_SESSION['crumbs'])) unset($_SESSION['crumbs']);
            }
        }
     
        // Some pages, such as Sign In, Sign Up, we don't want in the list, so
        // let's exclude them
        if ( !in_array($this->newCrumb['name'], $this->excludeCrumbs)) {
            $headergrey="<ul class='breadcrumb'>";
            $closeheadergrey="</ul>";
            $newCrumbKey = $this->newCrumb['name'];
            if(isset($_SESSION)){
                if (!key_exists('crumbs', $_SESSION)) $_SESSION['crumbs'] = array();
            }
            // If we have an existing crumb list, check to see whether
            // the new crumb is already in the list. If so, dump all the
            // crumbs from that crumb position to the end of the list. The
            // purpose of this is to keep the list clean of duplicates.
            if ( sizeof($_SESSION['crumbs']) > 0 ) {
                if ( array_key_exists($newCrumbKey, $_SESSION['crumbs'])) {
                    $offset = $this->array_offset($_SESSION['crumbs'], $newCrumbKey);
                    $_SESSION['crumbs'] = array_slice( $_SESSION['crumbs'], 0, $offset, true);
                }
            }

	    // Handle UrlManager->urlSuffix case
	    //$this->newCrumb['url'][0] = rtrim($this->newCrumb['url'][0], Yii::$app->UrlManager->urlSuffix);            
            $this->newCrumb['url'][0] = str_replace(Yii::$app->UrlManager->baseUrl,'',$this->newCrumb['url'][0]);
            
            // Finally add the new crumb to the end of the list          
            ///Yii::$app->UrlManager->baseUrl   = DemoYii2/web
            ///$this->newCrumb['url'][0]        = DemoYii2/web/user/register
            //print"</pre>";
            $_SESSION['crumbs'][$newCrumbKey]=$this->newCrumb;
            
            
            // If we have more crumbs than we want to display, we'll evict the
            // oldest crumbs from the list. Plus we'll show a truncated crumb
            // so the user has a visual indicator that we are truncating.
            if (sizeof($_SESSION['crumbs']) > $this->crumbs2Show ) {
                array_shift($_SESSION['crumbs']) ;
                $this->crumbs = array_merge($this->crumbs, $this->truncatedCrumb);
            }
        }else{//buang breadcrumbs / home
            $this->crumbs=array();
            //unset($_SESSION['crumbs']);
        }
       
        // Ok, we've build the crumb list prefix with the Home crumb and possibly
        // the Truncated crumb. Now lets add the user's crumbs.
		if(isset($_SESSION['crumbs'])){
			if ( sizeof($_SESSION['crumbs']) > 0 ) {
				$this->crumbs = array_merge($this->crumbs, $_SESSION['crumbs']);
			}
		}


    $lastCrumb = array_pop($this->crumbs);    
    
    $show=$headergrey;
    foreach($this->crumbs as $crumb) {       
        if(isset($crumb['url']) && $lastCrumb!=$crumb) {      
            $linkme=Html::a($crumb['name'], $crumb['url']);           
        } else {
            $linkme=$crumb['name'];
        }        
        $show.=$linkme.$this->delimiter;
    }  
    echo $show.$lastCrumb['name'].$closeheadergrey;  
   
    }

    /**
     * Find the integer position of the offset key in the array
     * @param array $array
     * @param string $offset_key
     * @return int
     */
    public function array_offset($array, $offset_key) {
        $offset = 0;
        foreach($array as $key=>$val) {
            if($key == $offset_key)
                return $offset;
            $offset++;
        }
        return -1;
    }   
}
?>