<!DOCTYPE html>
<html lang="en">
<head>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>					      	 
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-alert.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-tooltip.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />	

    <!-- Le styles -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" rel="stylesheet">    
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/unicornMain.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/unicorn.css" class="skin-color" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.css"  rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .navbar-fixed-top {
		margin-left: -20px;
		margin-right: -20px;
		}
    </style>
    <style type="text/css">
  		body {
    		padding-top: 60px;
  		}
  		@media (max-width: 979px) {
    		body {
      			padding-top: 0;
    		}
  		}
</style>   

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->	    
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>				
</head>

<body>
<div id="navbar" class="navbar navbar-fixed-top navbar-inverse">
	<div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>          
          <?php echo '<span style="text-wrap:nowrap"><a class="brand" href="'.Yii::app()->request->baseUrl.'/index.php">'.Yii::app()->name; ?>
          <img style="width:10%;" src="<?php echo Yii::app()->request->baseUrl;?>/img/site_logo_circle.png"></a></span>          
            <?php if(!Yii::app()->user->isGuest)
            	{
                  echo '<div class="nav-collapse">
            		<ul class="nav pull-right">
            		<li><a href="'.Yii::app()->request->baseUrl.'/index.php/user/logout">Logout</a></li>
					</ul>';                  	
                 }
                 else 
                 	echo '<ul class="nav pull-right">
                 			<li><a href="'.Yii::app()->request->baseUrl.'/index.php/user/login">Sign In</a>
                 			</li>
                 			</ul>';
                  ?>                      
                
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
</div>
<?php echo $content; ?>



<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-39324074-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
