<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>
   <? global $page, $paged;
	wp_title('|',true,'right');
	bloginfo('name');
	$site_description=get_bloginfo('description','display');
	if($site_description && ( is_home() || is_front_page()))
		echo " | {$site_description}";
	if ( $paged >= 2 || $page >= 2 )
		echo ' | '.sprintf(__('Page %s','Solver'), max($paged,$page));
	?>
  </title>
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <meta name="msvalidate.01" content="DAE7B74646E3C3044B7A944CBCC887ED" /> <?/*bing*/?>
  <? wp_head() ?>
    
  <link rel="shortcut icon" type="image/png" href="<? bloginfo('template_directory') ?>/img/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">

</head>
<body <?php body_class(); ?>>

<script>
    // Инициализация ВКонтакте
    window.vkAsyncInit = function () {
        VK.init({apiId: 127, onlyWidgets: true});
// Далее можно перечислять нужные виджеты ВКонтакте
        VK.Widgets.Group("vk_groups", {redesign: 0, mode: 3, width: "300", height: "250", color1: 'FFFFFF', color2: '000000', color3: '198BFF'}, 96800481);
        VK.Widgets.CommunityMessages("vk_community_messages", 96800481, {});
    };

    // Функция асинхронной загрузки
    (function(a, c, f) { function g() { var d, a = c.getElementsByTagName(f)[0], b = function(b, e) { c.getElementById(e) || (d = c.createElement(f), d.src = b, d.async = !0, e && (d.id = e), a.parentNode.insertBefore(d, a)) };
        b("//vk.com/js/api/openapi.js");
    }
        a.addEventListener ? a.addEventListener("load", g, !1) : a.attachEvent && a.attachEvent("onload", g)
    })(window, document, "script");
</script>

  <header id="site-header" class="container">  
    <div class="row">
      <div class="span8">
        <? $site_logo=new Infoblock(4); ?>
        <div class="site-logo">
            <? $site_logo_thumb=$site_logo->getThumbUrl(); if(!empty($site_logo_thumb)): ?>
	    <? if(!is_front_page() || is_paged()):?>
            <div class="site-logo__img">
	         <a href="/"><img src="<?=$site_logo_thumb?>" alt="Решатель - консультации, решение задач, контрольные"></a>
                 <span style="display: none;" class="popmake-class"></span>
	    <? else: ?>
            <div class="site-logo__img popmake-covid">
	         <img src="<?=$site_logo_thumb?>" alt="Решатель - консультации, решение задач, контрольные">
	    <? endif ?>
          </div>
          <? endif ?>
          <noindex>
          <div class="site-logo__text">
            <?= $site_logo->title ?>
          </div>
          <? if(!empty($site_logo->content)): ?>
          <div class="site-logo__slogan">
            <?= $site_logo->content ?>
          </div>
          <? endif ?>
          </noindex>
        </div>
      </div>
      <div class="span4">
		<? $phone=new Infoblock(9) ?>
        <div class="header-contact">
          <div class="header-contact__phone"><?= $phone->title ?></div>
          <div class="lk-main">
            <a class="lk-main__link" href="https://lk.reshatel.org" rel="nofollow" title="Перейти в личный кабинет клиента">Личный кабинет</a>
          </div>
          <div class="mobile-menu"></div>
        </div>
      </div>	
    </div>
  </header>	

  <div id="main-menu" class="container" style="margin-top: 5px; margin-bottom: 30px;">
    <div class="row">
      <nav class="span12">
        <? wp_nav_menu(array(
          'menu'=>'main-menu',
          'menu_class'=>'main-menu',
          'container'=>false,
          'walker'=>new Menu_Walker('main-menu'),        
        )); ?>							 		  
      </nav>		
    </div>	  
  </div>

