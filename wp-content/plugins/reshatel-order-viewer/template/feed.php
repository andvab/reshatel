<form action="#" class="rv-search">
    <input type="text" class="rv-search__input" placeholder="Что будем искать..?" value="<?= $search ?>">
    <i class="rv-search__icon dashicons dashicons-search" aria-hidden="true" title="Поиск по ленте заказов"></i>
</form>

<div class="rv-feed">

    <form class="rv-filter" action="#">
        <select class="rv-select" name="section" id="rv-section_id">
            <option value="<?= "?type=$selectedType" ?>">Все разделы</option>
            <? foreach ($sections as $section): ?>
                <option value="<?= "?section=$section->id&type=$selectedType" ?>" <?= $section->id == $selectedSection ? 'selected' : '' ?>><?= $section->name ?></option>
            <? endforeach; ?>
        </select>
        <select class="rv-select" name="category" id="rv-category_id" <?= $categories ? '' : 'disabled' ?>>
            <option value="<?= "?section=$selectedSection&type=$selectedType" ?>">Все предметы</option>
            <? if ($categories): ?>
                <? foreach ($categories as $category): ?>
                    <option value="<?= "?section=$selectedSection&category=$category->id&type=$selectedType" ?>" <?= $category->id == $selectedCategory ? 'selected' : '' ?>><?= $category->name ?></option>
                <? endforeach; ?>
            <? endif; ?>
        </select>
        <select class="rv-select" name="type" id="rv-type_id">
            <option value="<?= "?section=$selectedSection&type=$selectedCategory" ?>">Все типы заказов</option>
            <? foreach ($types as $type): ?>
                <option value="<?= "?section=$selectedSection&category=$selectedCategory&type=$type->id" ?>" <?= $type->id == $selectedType ? 'selected' : '' ?>><?= $type->name ?></option>
            <? endforeach; ?>
        </select>
    </form>

    <? if ($orders): ?>
        <? foreach ($orders as $order): ?> 
            <a href="<?= $order->path ?>/" class="rv-item">
                <div class="rv-item__col">
                    <span class="rv-item__label">Тип работы:</span>
                    <span class="rv-item__value"><?= $order->type ?></span>
                </div>
                <div class="rv-item__col">
                    <span class="rv-item__label">Предмет:</span>
                    <span class="rv-item__value"><?= $order->subject ?></span>
                </div>
                <div class="rv-item__col">
                    <?= $order->name ?>
                </div>
                <div class="rv-item__col">
                    <span class="rv-item__label">Дата выполнения:</span>
                    <span class="rv-item__value"><?= mysql2date('j F Y', $order->date_finished) ?></span>
                </div>
                <div class="rv-item__col">
                    <span class="rv-item__label">Стоимость:</span>
                    <span class="rv-item__value"><?= $order->price ?>  <span class="rubl">&#8381;</span></span>
                </div>
            </a>
        <? endforeach; ?>

        <a style="display: none" class="rv-load-more" href="?<?=
        http_build_query([
            'r' => $page + 1,
            'section' => $selectedSection,
            'category' => $selectedCategory,
            'type' => $selectedType,
            'search' => $search])
        ?>">
        </a>

    <? elseif ($page == 1): ?>
        <p class="rv-not-found">К сожалению, на данный момент у нас нет заказов, соответствующих выбранным критериям</p>
    <? endif; ?>

    <? //sleep(1)       ?>

</div>