<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>
        <? global $page, $paged;
        wp_title('|', true, 'right');
        bloginfo('name');
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && (is_home() || is_front_page()))
            echo " | {$site_description}";
        if ($paged >= 2 || $page >= 2)
            echo ' | ' . sprintf(__('Page %s', 'Solver'), max($paged, $page));
        ?>
    </title>

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
    window.vkAsyncInit = function () {
        VK.init({apiId: 127, onlyWidgets: true});
        VK.Widgets.Group("vk_groups", {
            redesign: 0,
            mode: 3,
            width: "300",
            height: "250",
            color1: 'FFFFFF',
            color2: '000000',
            color3: '198BFF'
        }, 96800481);
        // VK.Widgets.CommunityMessages("vk_community_messages", 96800481, {});
    };

    // Функция асинхронной загрузки
    (function (a, c, f) {
        function g() {
            var d, a = c.getElementsByTagName(f)[0], b = function (b, e) {
                c.getElementById(e) || (d = c.createElement(f), d.src = b, d.async = !0, e && (d.id = e), a.parentNode.insertBefore(d, a))
            };
            b("//vk.com/js/api/openapi.js");
        }

        a.addEventListener ? a.addEventListener("load", g, !1) : a.attachEvent && a.attachEvent("onload", g)
    })(window, document, "script");
</script>

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

