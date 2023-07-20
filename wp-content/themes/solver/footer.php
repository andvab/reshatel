<footer class="container footer">
    <div class="row">
        <div class="span4">
            <? wp_nav_menu(array(
                'menu' => 'main-menu-footer',
                'menu_class' => 'main-menu-footer',
                'container' => false,
                'walker' => new Menu_Walker('main-menu-footer'),
            )); ?>
            <div class="copyright">Решатель © 2013 – 2023</div>
        </div>

        <div class="span4">
            <div class="footer-title">Мы ВКонтакте</div>
            <noindex>
                <div id="vk_groups"><div class="lo-load"></div></div>
            </noindex>
        </div>

        <div class="span4">
            <? $phone = new Infoblock(9) ?>
            <div class="footer-contact">
                <a class="vkontakte" href="https://vk.com/reshatel_org"></a>
                <a class="phone-number" href="tel:+78007075323"></a>
                <a class="footer-contact__phone" href="tel:+78007075323">
                    <?= $phone->title ?>
                </a>
                <noindex>
                    <div class="footer-contact__free">ЗВОНОК БЕСПЛАТНЫЙ</div>
                </noindex>
            </div>
        </div>

    </div>
</footer>
<?php wp_footer() ?>


<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(20837425, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/20837425" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!-- GA -->
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-103974511-1', 'auto');
    ga('require', 'displayfeatures');
    ga('send', 'pageview');
    if (!document.referrer ||
        document.referrer.split('/')[2].indexOf(location.hostname) != 0)
        setTimeout(function () {
            ga('send', 'event', 'Новый посетитель', location.pathname);
        }, 15000);
</script>
<!-- /GA -->


</body>
</html>
