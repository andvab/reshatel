<?
/**
 * Template Name: Узнать стоимость Landing
 *
 * @package WordPress
 * @subpackage Solver
 * @since Solver 1.0
 */
?>

<? wp_enqueue_script("jquery"); ?>
<? wp_head() ?>
<link rel="shortcut icon" type="image/png" href="<? bloginfo('template_directory') ?>/img/favicon.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
<title>Узнать стоимость работы</title>

<div class="container" style="landing-form">
    <div class="row">
        <!--<h1 class="article__title">Узнать стоимость</h1>-->
        <div class="form-get_price">
            <?= do_shortcode("[fc id='2' align='center'][/fc]"); ?>
        </div>
    </div>
</div>



<?php wp_footer() ?>

<!-- Yandex.Metrika counter-->
<script type="text/javascript">
(function (d, w, c) {
(w[c] = w[c] || []).push(function() {
try {
w.yaCounter20837425 = new Ya.Metrika({id:20837425,
webvisor:true,
clickmap:true,
trackLinks:true,
accurateTrackBounce:true});
} catch(e) { }
});

var n = d.getElementsByTagName("script")[0],
s = d.createElement("script"),
f = function () { n.parentNode.insertBefore(s, n); };
s.type = "text/javascript";
s.async = true;
s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

if (w.opera == "[object Opera]") {
d.addEventListener("DOMContentLoaded", f, false);
} else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>

<noscript><div><img src="//mc.yandex.ru/watch/20837425" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body>
</html>