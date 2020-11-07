'use strict';
jQuery(function ($) {

    $(".tel").mask("+7(999)999-99-99");

    $('.online-help').on('click', function () {
        yaCounter20837425.reachGoal('online-help');
        ga('send', 'event', 'form', 'online-help');
        fbq('trackCustom', 'Online');
    });
    $('.tasks').on('click', function () {
        yaCounter20837425.reachGoal('tasks');
        ga('send', 'event', 'form', 'tasks');
        fbq('trackCustom', 'Zadachi');
    });
    $('.kontrolnaya').on('click', function () {
        yaCounter20837425.reachGoal('kontrolnaya');
        ga('send', 'event', 'form', 'kontrolnaya');
        fbq('trackCustom', 'Kontrolnaya');
    });
    $('.kursovaya').on('click', function () {
        yaCounter20837425.reachGoal('kursovaya');
        ga('send', 'event', 'form', 'kursovaya');
        fbq('trackCustom', 'Kursovaya');
    });
    $('.referat').on('click', function () {
        yaCounter20837425.reachGoal('referat');
        ga('send', 'event', 'form', 'referat');
        fbq('trackCustom', 'Referat');
    });
    $('.diplom').on('click', function () {
        yaCounter20837425.reachGoal('diplom');
        ga('send', 'event', 'form', 'diplom');
        fbq('trackCustom', 'Diplom');
    });
    $('.practice').on('click', function () {
        yaCounter20837425.reachGoal('practice');
        ga('send', 'event', 'form', 'practice');
        fbq('trackCustom', 'Practice');
    });
    $('.essay').on('click', function () {
        yaCounter20837425.reachGoal('essay');
        ga('send', 'event', 'form', 'essay');
        fbq('trackCustom', 'Essay');
    });
    $('.presentation').on('click', function () {
        yaCounter20837425.reachGoal('presentation');
        ga('send', 'event', 'form', 'presentation');
        fbq('trackCustom', 'Presentation');
    });
    $('.mc-article').on('click', function () {
        yaCounter20837425.reachGoal('article');
        ga('send', 'event', 'form', 'article');
        fbq('trackCustom', 'Article');
    });
    $('.mc-lk-order').on('click', function () {
        yaCounter20837425.reachGoal('lk-price');
    });
    $('.job').on('click', function () {
        yaCounter20837425.reachGoal('vakansiya');
    });


    $("a[data-lightboxplus*=lightbox]").each(function () {
        $(this).colorbox({
            rel: $(this).attr("data-lightboxplus"),
            initialWidth: "30%",
            initialHeight: "30%",
            maxWidth: "90%",
            maxHeight: "90%",
            opacity: 0.8,
            current: " {current} из {total}",
            previous: "←",
            next: "→",
            close: "Закрыть"
        });
    });


    $('p.hide').hide();

    $('a.add_file').on('click', function (e) {
        $('p.hide:not(:visible):first').show('slow');
        if (!$('p.hide:not(:visible)').length) {
            $('a.add_file').hide(10);
        }
        e.preventDefault();
    });

    $('a.del_file').on('click', function (e) {
        var input_parent = $(this).parent();
        var input_wrap = input_parent.find('span');
        input_wrap.html(input_wrap.html());
        input_parent.hide('slow');
        if ($('a.add_file:not(:visible)').length) {
            $('a.add_file').show();
        }
        e.preventDefault();
    });

    $('.show-more').readmore({
        speed: 600,
        collapsedHeight: 0,
        moreLink: '<a href="#" class="show-more__link">&darr; Подробнее &darr;</a>',
        lessLink: '<a href="#" class="show-more__link">&uarr; Скрыть &uarr;</a>'
    });

});



//Для сайдбара
function offsetPosition(e) {
    var offsetTop = 0;
    do {
        offsetTop += e.offsetTop;
    } while (e = e.offsetParent);
    return offsetTop;
}

var aside = document.getElementById('scroll');

if (aside) {
    var OP = offsetPosition(aside);

    window.onscroll = function () {
        // window.pageYOffset - прокрутка;
        // document.documentElement.scrollHeight - высота всего документа;
        // aside.offsetHeight - высота элемента
        if (window.pageYOffset > document.documentElement.scrollHeight - 1318) {
            aside.className = 'stop';
            aside.style.top = (document.documentElement.scrollHeight - 1318 - OP) + 'px';
        } else {
            aside.style.top = '0';
            aside.className = (OP < window.pageYOffset ? 'prilip' : '');
        }
    };
}


function getLastOrders() {
    let container = document.querySelector('.lo-container');
    if (!container) {
        return;
    }
    let type = container.dataset.type;
    let cat = container.dataset.cat;

    fetch('/wp-json/order/' + type + (cat ? ('/' + cat) : ''))
            .then(
                    function (response) {
                        if (response.status !== 200) {
                            document.querySelector('.last-orders').parentNode.removeChild(document.querySelector('.last-orders'));
                            return;
                        }

                        document.querySelector('.lo-load').parentNode.removeChild(document.querySelector('.lo-load'));

                        response.json().then(function (data) {
                            for (var item of data) {
                                let order = document.createElement('a');
                                order.className = 'lo-item';
                                order.innerHTML = '<div class="lo-item__col"><span class="lo-item__label">Тип: </span><span class="lo-item__value">' + item.type + '</span></div>';
                                order.innerHTML += '<div class="lo-item__col"><span class="lo-item__label">Предмет: </span><span class="lo-item__value">' + item.subject + '</span></div>';
                                order.innerHTML += '<div class="lo-item__col">' + item.name + '</div>';
                                order.innerHTML += '<div class="lo-item__col"><span class="lo-item__label">Дата выполнения: </span><span class="lo-item__value">' + item.date_finished + '</span></div>';
                                order.innerHTML += '<div class="lo-item__col"><span class="lo-item__label">Стоимость: </span><span class="lo-item__value">' + item.price + ' ₽</span></div>';
                                order.href = '/orders/' + item.path + '/';
                                container.appendChild(order);
                            }
                            if (data.length === 0) {
                                document.querySelector('.last-orders').parentNode.removeChild(document.querySelector('.last-orders'));
                            } else {
                                createCarousel();
                            }
                        });
                    }
            )
            .catch(function () {
                document.querySelector('.last-orders').parentNode.removeChild(document.querySelector('.last-orders'));
            });
}


getLastOrders();

function createCarousel() {
    jQuery((".owl-carousel")).owlCarousel({
        loop: true,
        responsiveClass: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
                pagination: false,
                nav: true
            },
            520: {
                items: 2,
                pagination: false,
                nav: true
            },
            641: {
                items: 2,
                pagination: true
            },
            900: {
                items: 3,
                pagination: true
            }
        }
    });
}