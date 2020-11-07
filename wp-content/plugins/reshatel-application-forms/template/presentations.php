<?php
global $re_data;

if (isset($_GET['subject'])) {
    $subject = esc_html($_GET['subject']);
} else {
    $subject = '';
}
?>

<div role="form" class="<?php echo $class_form; ?>" id="wpcf7-f984-o1" lang="ru-RU" dir="ltr">
    <div class="screen-reader-response"></div>
    <form action="<?php echo $form_action; ?>" id='<?php echo $prefix_form_id . $type_form; ?>' method="post" class="wpcf7-form form-callback re_form" novalidate="novalidate">
        <div class="order-form">
            <div class="top-hidden">
                <div class="form-box__str theme">
                    <label class="form-box__str__label">Тема работы</label>
                    <span class="wpcf7-form-control-wrap head"><input type="text" name="<?php echo $re_data['form']['name_fields']['title']; ?>" value="" size="40" class="wpcf7-form-control wpcf7-text form-box__str__i-text" aria-invalid="false"></span>
                </div>
                <div class="form-box__str pred">
                    <label class="form-box__str__label">Предмет *</label>
                    <span class="wpcf7-form-control-wrap subject"><input type="text" name="<?php echo $re_data['form']['name_fields']['subject']; ?>" value="<?php echo $subject; ?>" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-box__str__i-text" aria-required="true" required aria-invalid="false"></span>
                </div>
                <div class="form-box__str solve">
                    <label class="form-box__str__label">Работу предоставить *</label>
                    <span class="wpcf7-form-control-wrap datetime-489"><input type="text" name="<?php echo $re_data['form']['name_fields']['date']; ?>" value="" size="40" class="wpcf7-form-control wpcf7-date-small wpcf7-validates-as-required form-box__str__i-text" aria-required="true" required placeholder="Дата" id="dp1483452982465" readonly="readonly"> </span>
                </div>

                <div class="form-group no-files form-box__str rfiles">
                    <label class="form-box__str__label">Загрузить файл(ы)</label><br>
                    <div class="b-files-small js-files"></div>
                    <div class="files_container">
                        <div class="boxButtonFile">
                            <a class="btn btn-primary" href="#">Добавить файлы</a>
                            <input type="file" multiple/>
                        </div>
                    </div>
                </div>

                <div class="form-box__str pageparams">
                    <label class="form-box__str__label">Количество слайдов</label><br><br>
                    <label class="form-box__str__label">от</label>
                    <span style="margin: 0 4px" class="wpcf7-form-control-wrap number-start">
                        <input type="number" name="<?php echo $re_data['form']['name_fields']['number_start']; ?>" value="8" class="wpcf7-form-control wpcf7-number wpcf7-validates-as-number form-box__str__number" min="0" max="99" step="5" onclick="this.select();" aria-invalid="false">
                    </span>
                    <label class="form-box__str__label">до</label>
                    <span style="margin: 0 0 0 4px" class="wpcf7-form-control-wrap number-end">
                        <input type="number" name="<?php echo $re_data['form']['name_fields']['number_end']; ?>" value="10" class="wpcf7-form-control wpcf7-number wpcf7-validates-as-number form-box__str__number" min="0" max="99" step="5" onclick="this.select();" aria-invalid="false">
                    </span>
                </div>

                <div class="form-box__str exp">
                    <label class="form-box__str__label">Пояснения</label>
                    <span class="wpcf7-form-control-wrap comment">
                        <textarea name="<?php echo $re_data['form']['name_fields']['comment']; ?>" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea form-box__str__textarea" aria-invalid="false" placeholder="Уточните требования к оформлению. Нужен ли доклад? Может у вас есть план работы?" onblur="this.style.height = '100px'"></textarea>
                    </span>
                </div>

                <div class="form-more-button">Узнать стоимость</div>
            </div> 

            <div class="form-hidden">
                <div class="form-box__str">
                    <label class="form-box__str__label">Имя *</label>
                    <span class="wpcf7-form-control-wrap name"><input type="text" name="<?php echo $re_data['form']['name_fields']['name']; ?>" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-box__str__i-text" aria-required="true" required aria-invalid="false"></span>
                </div>
                <div class="form-box__str form-box-email">
                    <label class="form-box__str__label">E-mail *</label>
                    <span class="wpcf7-form-control-wrap email"><input type="email" name="<?php echo $re_data['form']['name_fields']['email_for_bot']; ?>" value="example@email.com" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email form-box__str__i-text" aria-required="true" required aria-invalid="false"></span>
                </div>
                <div class="form-box__str">
                    <label class="form-box__str__label">E-mail *</label>
                    <span class="wpcf7-form-control-wrap email"><input type="email" name="<?php echo $re_data['form']['name_fields']['email']; ?>" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email form-box__str__i-text" aria-required="true" required aria-invalid="false"></span>
                </div>
                <div class="form-box__str">
                    <label class="form-box__str__label">Телефон</label>
                    <span class="wpcf7-form-control-wrap phon"><input type="text" name="<?php echo $re_data['form']['name_fields']['tel']; ?>" value="" size="40" class="wpcf7-form-control wpcf7-text form-box__str__i-text tel" aria-invalid="false" placeholder="+7(___)___-__-__"></span>
                </div>
                <div class="form-box__personal">
                    <input type="checkbox" id="cbx" name="personal" checked="checked" style="display: none;" required>
                    <label for="cbx" class="check personal">
                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                        <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                        <polyline points="1 9 7 14 15 4"></polyline>
                        </svg>
                        <span class="personal__text">Я соглашаюсь на передачу персональных данных согласно <a href="/personal/" target="_blank">политике конфиденциальности</a> и <a href="https://lk.reshatel.org/help/agreement/" target="_blank" rel="nofollow">пользовательскому соглашению</a></span></label>
                </div>

                <div class="form-box__str">
                    <input type="button" class="form-more-button-prev" value="назад">
                    <input type="submit" value="Перейти в заказ" class="wpcf7-form-control wpcf7-submit form__button presentation">
                </div>
                <div id="spinningSquaresG">
                    <div id="spinningSquaresG_1" class="spinningSquaresG"></div>
                    <div id="spinningSquaresG_2" class="spinningSquaresG"></div>
                    <div id="spinningSquaresG_3" class="spinningSquaresG"></div>
                    <div id="spinningSquaresG_4" class="spinningSquaresG"></div>
                    <div id="spinningSquaresG_5" class="spinningSquaresG"></div>
                    <div id="spinningSquaresG_6" class="spinningSquaresG"></div>
                    <div id="spinningSquaresG_7" class="spinningSquaresG"></div>
                    <div id="spinningSquaresG_8" class="spinningSquaresG"></div>
                </div>
            </div>

        </div>
        <div class="wpcf7-response-output wpcf7-display-none"></div></form></div>
