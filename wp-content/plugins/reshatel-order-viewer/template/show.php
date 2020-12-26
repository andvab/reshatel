<div class="rv-header"><?= $order->type ?> по <?= $order->cat_dat ?></div>

<div itemscope="" itemtype="http://schema.org/BreadcrumbList" class="rv-breadcrumbs">
    <span class="crumbs" itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
        <a itemprop="item" title="Решатель" href="/">
            <span itemprop="name">Решатель</span>
        </a>
        <meta itemprop="position" content="1">
    </span>
    <span> » </span>

    <span class="crumbs" itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
        <a itemprop="item" title="Выполненные работы" href="/orders/">
            <span itemprop="name">Лента выполненных заказов</span>
        </a>
        <meta itemprop="position" content="2">
    </span>
    <span> » </span>

    <span class="crumbs" itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
        <span itemprop="name"><?= $order->name ?></span>
        <meta itemprop="position" content="3">
    </span>
</div>

<div class="rv-order">

    <div class="rv-order__top">
        <h1 class="rv-order-name"><?= $order->name ?></h1>

        <div class="rv-order-main">
            <div class="rv-order-left">
                <div class="rv-row">
                    <div class="rv-info-label">
                        Тип работы:
                    </div>
                    <? if ($order->type_url): ?>
                        <a href="/<?= $order->type_url ?>/" class="rv-info-value">
                            <?= $order->type ?>
                        </a>
                    <? else: ?>
                        <div class="rv-info-value">
                            <?= $order->type ?>
                        </div>
                    <? endif; ?>

                </div>

                <div class="rv-row">
                    <div class="rv-info-label">
                        <?= $order->type_id != 12 ? 'Предмет' : 'Языки' ?>:
                    </div>
                    <div class="rv-info-value">
                        <?= $order->subject ?>
                    </div>
                </div>

                <? if (in_array($order->type_id, [3, 4, 5, 7, 9, 10, 11])): ?>

                    <div class="rv-row">
                        <div class="rv-info-label">
                            Кол-во <?= $order->type_id == 9 ? 'слайдов' : 'страниц' ?>:
                        </div>
                        <div class="rv-info-value">
                            от <?= $order->pages_start ?> до <?= $order->pages_end ?>
                        </div>
                    </div>

                    <? if ($order->type_id != 9): ?>

                        <div class="rv-row">
                            <div class="rv-info-label">
                                Уникальность:
                            </div>
                            <div class="rv-info-value">
                                <?= $order->unique_persent ?>% по <?= $order->tester ?>
                            </div>
                        </div>

                    <? endif; ?>

                <? endif; ?>

                <? if ($order->type_id == 6 || $order->type_id == 8): ?>

                    <div class="rv-row">
                        <div class="rv-info-label">
                            Длительность:
                        </div>
                        <div class="rv-info-value">
                            <?= $order->duration ?>
                        </div>
                    </div>

                    <div class="rv-row">
                        <div class="rv-info-label">
                            Кол-во заданий:
                        </div>
                        <div class="rv-info-value">
                            <?= $order->tests_count ?>
                        </div>
                    </div>

                    <? if ($order->type_id == 8): ?>

                        <div class="rv-row">
                            <div class="rv-info-label">
                                Кол-во попыток:
                            </div>
                            <div class="rv-info-value">
                                <?= $order->try_count ?>
                            </div>
                        </div>

                    <? endif; ?>

                <? endif; ?>

            </div>
            <div class="rv-order-right rv-order-desctiprion">
                <div class="rv-info-label">
                    Описание:
                </div>
                <div class="rv-info-value"><?= $order->comments ?></div>
            </div>

        </div>

    </div>

    <div class="rv-order__bottom">
        <div class="rv-order-main">

            <div class="rv-order-left">
                <div class="rv-row">
                    <div class="rv-info-label">
                        Дата заказа:
                    </div>
                    <div class="rv-info-value">
                        <?= mysql2date('j F Y', $order->date_created) ?>
                    </div>
                </div>

                <div class="rv-row">
                    <div class="rv-info-label">
                        Дата выполнения:
                    </div>
                    <div class="rv-info-value">
                        <?= mysql2date('j F Y', $order->date_finished) ?>
                    </div>
                </div>
            </div>
            <div class="rv-order-right">

                <div class="rv-row">
                    <div class="rv-info-label">
                        Номер заказа:
                    </div>
                    <div class="rv-info-value" id="order-number" data-value="<?= $order->id ?>">
                        <?= $order->id ?>
                    </div>
                </div>
                <div class="rv-info-label">
                    Стоимость:
                </div>
                <div class="rv-info-value">
                    <?= $order->price ?> <span class="rubl">&#8381;</span>
                </div>
            </div>
        </div>

    </div>

</div>


<? if ($filesUser): ?>
    <div class="rv-file">
        <div class="rv-file__header">Файлы для заказа</div>
        <div class="rv-file__readmore">
            <div class="rv-file__show">
                <? foreach ($filesUser as $file): ?>
                    <a href="<?= $file->url ?>" target="_blank" class="rv-file__link">
                        <?= $file->name ?><br>
                        <span class="rv-file__date"><?= mysql2date('j F Y G:i', $file->date_loaded) ?></span>
                    </a>
                <? endforeach; ?>
            </div>
        </div>
    </div>
<? endif; ?>

<a href="https://lk.reshatel.org/help/new/" target="_blank" class="rv-btn mc-lk-order">Узнать стоимость</a>
<div class="rv-hint">аналогичной или другой работы</div>

<div class="last-orders container">
    <noindex>
        <div class="rv-similar-title">Похожие заказы</div>
        <div class="lo-load"></div>
        <div class="owl-carousel owl-theme lo-container" data-type="<?= $order->type_id ?>" data-cat="<?= $order->category_id ?>"></div>
    </noindex>
</div>

<script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "<?= $order->name ?>",
        "image": "https://reshatel.org/wp-content/themes/solver/img/logo_markup.png",
        "description": "Заказ <?= $order->name ?>",
        "offers": {
            "@type": "Offer",
            "priceCurrency": "RUB",
            "price": "<?= $order->price?:190 ?>"
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "<?= round(5 - (int)$argv[1] / (int)pow(10, (int)strlen($argv[1])) * 0.7, 1) ?>",
            "bestRating": "5",
            "worstRating": "1",
            "ratingCount": "<?= ceil($order->price/100+1) ?>"
        }
    }
</script>