<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
//use yii\bootstrap\Nav;
use kartik\nav\NavX;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use mdm\admin\components\MenuHelper;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
	<link rel="shortcut icon" href="<?php echo Yii::$app->getHomeUrl(); ?>favicon.ico" type="image/x-icon" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'MySchool',
		//'brandLabel' => Html::img($asset->baseUrl . 'logo.png',['height'=>'50']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
	// hardcode menu
	/*
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Backup', 'url' => ['/backup/index']],
            ['label' => 'Server', 'url' => ['/server/index']],
            ['label' => 'Kategori', 'url' => ['/ref-kategori/index']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
	*/
	// menu di control oleh rbac (role base access control)
	if (Yii::$app->user->isGuest) {                
		$menuItems[] = ['label' => 'Daftar Masuk', 'url' => ['/user/security/login']];                	
		//$menuItems[] = ['label' => 'Daftar Pengguna', 'url' => ['/user/registration/register']];            
	}else{                
		$menuItems=MenuHelper::getAssignedMenu(Yii::$app->user->id);//overwrite menuItems               
		//if(!Yii::$app->user->can("guest")) 
		$identity=Yii::$app->user->identity->username;                
		//else 
		//$identity=$pemohon->findPemohon(Yii::$app->user->id,"nama");              
		$menuItems[] = [                               
			'label' => 'Log Keluar (' . ucwords(strtolower($identity)) . ')',                                      
			'url' => ['/site/logout'],                   
			'linkOptions' => ['data-method' => 'post'],                
		];
	}
	echo NavX::widget([               
		'options' => [
			'class' => 'navbar-nav navbar-right',
			'id'=>'navbar-id',
            'style'=>'font-size: 14px;',
            'data-tag'=>'menu',
			],
		'items' => $menuItems, 
		'activateParents' => true,
		'encodeLabels' => false		  
	]);

	
    NavBar::end();
    ?>

    <div class="container">
        <?php /*echo Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])*/ ?>
		<?= app\components\BreadCrumb::widget([
                'newCrumb' => [
                    'name' => isset($this->crumbTitle)?$this->crumbTitle:$this->title, 
                    'url' => array($_SERVER['REQUEST_URI'])                   
                    ]
                ]);           
        ?>
		<?php
		foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
			echo '<div class="alert alert-' . $key . ' alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message . '</div>';
		}
		?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; 2017 <a href="http://www.mysoftcare.com" target="_blank">Mysoftcare Solution Sdn. Bhd.</a></p>

        <p class="pull-right">Version 1.0</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
