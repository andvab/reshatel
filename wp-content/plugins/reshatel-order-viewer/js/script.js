(function ($) {
    let $description = $('.rv-order-desctiprion .rv-info-value');
    $description.selector = '.rv-order-desctiprion .rv-info-value';
    $description.readmore({
        speed: 350,
        collapsedHeight: 84,
        moreLink: '<a href="#">Показать полностью</a>',
        lessLink: '<a href="#">Скрыть</a>'
    });

    let fileMore = $('.rv-file__readmore');
    fileMore.selector = '.rv-file__readmore';
    if (fileMore) {
        fileMore.readmore({
            speed: 350,
            collapsedHeight: 400,
            moreLink: '<a style="text-align: center" href="#">Показать все файлы</a>',
            lessLink: '<a style="text-align: center" href="#">Скрыть</a>'
        });
    }

    $('.rv-feed').jscroll({
        loadingHtml: '<div style="display: block" id="spinningSquaresG"><div id="spinningSquaresG_1" class="spinningSquaresG"></div><div id="spinningSquaresG_2" class="spinningSquaresG"></div><div id="spinningSquaresG_3" class="spinningSquaresG"></div><div id="spinningSquaresG_4" class="spinningSquaresG"></div><div id="spinningSquaresG_5" class="spinningSquaresG"></div><div id="spinningSquaresG_6" class="spinningSquaresG"></div><div id="spinningSquaresG_7" class="spinningSquaresG"></div><div id="spinningSquaresG_8" class="spinningSquaresG"></div></div>',
        contentSelector: '.rv-item, .rv-load-more',
        nextSelector: '.rv-load-more'
    });

    $('#rv-section_id').on('change', filter);
    $('#rv-category_id').on('change', filter);
    $('#rv-type_id').on('change', filter);

    function filter(e) {
        window.location.href = $(this).val();
    }

    $('.rv-search__icon').click(function () {
        if ($(".rv-search").hasClass("active")) {
            $(".rv-search").submit();
        } else {
            $(".rv-search, .rv-search__input").addClass("active");
            $(".rv-header").css("margin-left", "-3999px");
            $(".rv-search__input").focus();
        }
    });

    $('.rv-search__input').on('blur', function () {
        setTimeout(function () {
            if ($('.rv-search').hasClass('active')) {
                $('.rv-search, .rv-search__input').removeClass('active');
                $('.rv-header').css('margin-left', '0');
            }
        }, 500);
    });

    $('.rv-search').on('submit', function () {
        window.location.href = '?search=' + $('.rv-search__input').val();
        return false;
    });

}(jQuery));
