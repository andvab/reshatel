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
    <form action="<?php echo $form_action; ?>" id='<?php echo $prefix_form_id . $type_form; ?>' method="post" class="wpcf7-form form-callback re_form kontr" novalidate="novalidate">
        <div class="order-form">
            <div class="top-hidden">
                <div class="form-group no-files form-box__str">
                    <label class="form-box__str__label">Исходный текст</label>
                    <div class="b-files-small js-files"></div>
                    <div class="files_container">
                        <div class="boxButtonFile">
                            <a class="btn btn-primary" href="#">Добавить файлы</a>
                            <input type="file" multiple/>
                        </div>

                    </div>
                </div>

                <div class="form-box__str">
                    <label class="form-box__str__label">Перевод предоставить *</label>
                    <span class="wpcf7-form-control-wrap datetime-489"><input type="text" name="<?php echo $re_data['form']['name_fields']['date']; ?>" value="" size="40" class="wpcf7-form-control wpcf7-date-small wpcf7-validates-as-required form-box__str__i-text" aria-required="true" required placeholder="Дата" id="dp1483452982465" readonly="readonly"> </span>
                </div>

                <div class="form-box__str">
                    <label class="form-box__str__label">Направление перевода *</label>
                    <span class="wpcf7-form-control-wrap subject"><select name="<?php echo $re_data['form']['name_fields']['subject']; ?>" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-box__str__select translate_selector" aria-required="true" required aria-invalid="false">
                            <option value="1*Русский ➝ Английский">Русский &rarr; Английский</option>
                            <option value="1*Английский ➝ Русский">Английский &rarr; Русский</option>
                            <option value="2*Русский ➝ Французский">Русский &rarr; Французский</option>
                            <option value="2*Французский ➝ Русский">Французский &rarr; Русский</option>
                            <option value="5*Прочие языки">Переводы других языков</option>
                        </select></span>
                </div>

                <div class="form-box__str">
                    <label class="form-box__str__label">Пояснения</label>
                    <span class="wpcf7-form-control-wrap comment">
                        <textarea name="<?php echo $re_data['form']['name_fields']['comment']; ?>" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea form-box__str__textarea" aria-invalid="false" placeholder="Дополнительная информация" onblur="this.style.height = '100px'"></textarea>
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
                    <input type="submit" value="Перейти в заказ" class="wpcf7-form-control wpcf7-submit form__button translation">
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
