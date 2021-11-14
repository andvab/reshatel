<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">

    <? wp_head() ?>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#222222">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="theme-color" content="#0065cc">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">

</head>
<body <?php body_class(); ?>>

<script>
    setTimeout(function () {
        let vkSc = document.createElement("script");
        vkSc.src = 'https://vk.com/js/api/openapi.js';
        vkSc.async = true;
        document.getElementsByTagName('head')[0].appendChild(vkSc);
        vkSc.onload = function () {
            let loader = document.getElementById("vk_groups");
            if (loader) {
                loader.innerHTML='';
                VK.Widgets.Group("vk_groups", {
                    redesign: 0,
                    mode: 3,
                    width: "300",
                    height: "250",
                    color1: 'FFFFFF',
                    color2: '000000',
                    color3: '198BFF'
                }, 96800481);
            }
            loader = document.getElementById("vk_comments")
            if (!loader) return;
            loader.innerHTML='';
            <? if (is_single()): ?>
                VK.init({apiId: 3612780, onlyWidgets: true});
                VK.Widgets.Comments("vk_comments", {limit: 10, width: "620", attach: "*", autoPublish: 0, pageUrl: "<? echo get_permalink(); ?>"});
            <? else: ?>
                VK.init({apiId: 3543059, onlyWidgets: true});
                VK.Widgets.Comments("vk_comments", {
                    redesign: 0,
                    limit: 3,
                    mini: "1",
                    width: "100%",
                    attach: "*",
                    pageUrl: "http://reshatel.org/garantii/"
                });
            <? endif; ?>
        };
    }, 4000);
</script>
<noindex>
    <div class="legal-info">
        <div class="container">
            Внимание! Решатель не продает дипломы или любые другие документы. Также обратите внимание, что наши работы не предназначены для сдачи в учебном заведении! Услуги предоставляются исключительно в рамках законодательства РФ.
        </div>
    </div>
</noindex>
<header id="site-header" class="container">
    <div class="row">
        <div class="span4 header-left">
            <div class="site-logo">
                <? if (!is_front_page() || is_paged()): ?>
                    <a href="/" class="site-logo__img"></a>
                    <span style="display: none;" class="popmake-class"></span>
                <? else: ?>
                    <div class="site-logo__img"></div>
                <? endif ?>
                <? $site_logo = new Infoblock(4); ?>
                <noindex>
                    <div class="site-logo__text">
                        <?= $site_logo->title ?>
                    </div>
                    <? if (!empty($site_logo->content)): ?>
                        <div class="site-logo__slogan">
                            <?= $site_logo->content ?>
                        </div>
                    <? endif ?>
                </noindex>
            </div>
        </div>
        <div class="span4 header-middle">
            <? $phone = new Infoblock(9);
            $social = new Infoblock(8354) ?>
            <div class="header-contact">
                <div class="header-online">
                    <?= $social->title ?>
                </div>
                <div class="header-social">
                    <?= $social->content ?>
                </div>
            </div>
        </div>
        <div class="span4 header-right">
            <div class="header-lk">
                <div class="lk-main">
                    <div class="header-contact__phone"><?= $phone->title ?></div>
                    <a class="lk-main__link" href="https://lk.reshatel.org" rel="nofollow"
                       title="Перейти в личный кабинет клиента">Личный кабинет</a>
                </div>
                <div class="mobile-menu"></div>
            </div>
        </div>
    </div>
</header>

<div id="main-menu" class="container" style="margin-top: 5px; margin-bottom: 30px;">
    <div class="row">
        <div class="only-mobile header-social">
            <?= $social->content ?>
            <a href="tel:+78007075323" title="БЕСПЛАТНЫЙ ЗВОНОК НА НОМЕР 8800"
               class="header-social__item social__tel"></a>
        </div>
        <nav class="span12">
            <? wp_nav_menu(array(
                'menu' => 'main-menu',
                'menu_class' => 'main-menu',
                'container' => false,
                'walker' => new Menu_Walker('main-menu'),
            )); ?>
        </nav>
    </div>
</div>

