<?php global $re_data; ?>

<div role="form" class="<?php echo $class_form; ?>" lang="ru-RU" dir="ltr">
    <div class="screen-reader-response"></div>
    <form action="<?php echo $form_action; ?>" id='<?php echo $prefix_form_id . $type_form; ?>' method="post" class="wpcf7-form form-callback re_form" novalidate="novalidate">
        <div class="order-form">
            <div class="form-hidden">
                <div class="form-box__str">
                    <label class="form-box__str__label">Имя*</label>
                    <span class="wpcf7-form-control-wrap name">
                        <input type="text" name="<?php echo $re_data['form']['name_fields']['name']; ?>" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-box__str__i-text" required aria-invalid="false">
                    </span>
                </div>
                <div class="form-box__str form-box-email">
                    <label class="form-box__str__label">E-mail *</label>
                    <span class="wpcf7-form-control-wrap email"><input type="email" name="<?php echo $re_data['form']['name_fields']['email_for_bot']; ?>" value="example@email.com" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email form-box__str__i-text" aria-required="true" required aria-invalid="false"></span>
                </div>
                <div class="form-box__str">
                    <label class="form-box__str__label">E-mail*</label>
                    <span class="wpcf7-form-control-wrap email">
                        <input type="email" name="<?php echo $re_data['form']['name_fields']['email']; ?>" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email form-box__str__i-text" required aria-invalid="false">
                    </span>
                </div>
                <div class="form-box__str">
                    <label class="form-box__str__label">Телефон</label>
                    <span class="wpcf7-form-control-wrap phon">
                        <input type="text" name="<?php echo $re_data['form']['name_fields']['tel']; ?>" size="40" class="wpcf7-form-control wpcf7-text form-box__str__i-text tel" aria-invalid="false" placeholder="+7(___)___-__-__">
                    </span>
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
                    <input type="submit" value="Перейти в заказ" class="wpcf7-form-control wpcf7-submit form__button mc-article">
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
            <div class="top-hidden">
                <div class="form-box__str">
                    <label id="theme" class="form-box__str__label">Название заказа</label><br>
                    <span class="wpcf7-form-control-wrap head"><input type="text" name="<?php echo $re_data['form']['name_fields']['title']; ?>" size="40" class="wpcf7-form-control wpcf7-text form-box__str__i-text" aria-invalid="false" placeholder="Введите тему работы"></span>
                </div>

                <div class="form-box__str">
                    <label class="form-box__str__label">Тип работы*</label><br>
                    <span class="wpcf7-form-control-wrap refesse">
                        <select name="<?php echo $re_data['form']['name_fields']['select_type']; ?>" id="select_type_form" class="wpcf7-form-control wpcf7-select form-box__str__select required" aria-required="true" required aria-invalid="false">
                            <option value="">Выберите тип работы</option>
                            <option value="1" data-type="1" <?php echo ( get_query_var('category_name') == 'kontrolnye-raboty' ) ? 'selected' : ''; ?>>Контрольная работа</option>
                            <option value="2" data-type="1" <?php echo ( get_query_var('category_name') == 'reshenie-zadach' ) ? 'selected' : ''; ?>>Решение задач</option>
                            <option value="3" data-type="2" <?php echo ( get_query_var('category_name') == 'kursovye-raboty' ) ? 'selected' : ''; ?>>Курсовая работа</option>
                            <option value="4" data-type="2" <?php echo ( get_query_var('category_name') == 'diploms' ) ? 'selected' : ''; ?>>Дипломная работа</option>
                            <option value="5" data-type="2" <?php echo ( get_query_var('category_name') == 'referats' ) ? 'selected' : ''; ?>>Реферат</option>
                            <option value="10" data-type="2" <?php echo ( get_query_var('category_name') == 'essay' ) ? 'selected' : ''; ?>>Эссе</option>
                            <option value="11" data-type="2" <?php echo ( get_query_var('category_name') == 'otchety-po-praktike' ) ? 'selected' : ''; ?>>Отчет по практике</option>
                            <option value="9" data-type="4" <?php echo ( get_query_var('category_name') == 'presentations' ) ? 'selected' : ''; ?>>Презентация</option>
                            <option value="13" data-type="1" <?php echo ( get_query_var('category_name') == 'laboratornaya' ) ? 'selected' : ''; ?>>Лабораторная работа</option>
                            <option value="6" data-type="3" <?php echo ( get_query_var('category_name') == 'online-pomosh' ) ? 'selected' : ''; ?>>Онлайн помощь</option>
                        </select>
                    </span>
                </div>

                <div class="form-box__str">
                    <label class="form-box__str__label">Предмет*</label><br>
                    <span class="wpcf7-form-control-wrap subject">
                        <input type="text" name="<?php echo $re_data['form']['name_fields']['subject']; ?>" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-box__str__i-text" required aria-invalid="false">
                    </span>
                </div>

                <div class="form-box__str form-group-custom form-group-3">
                    <label class="form-box__str__label">Дата и время*</label><br>
                    <span class="wpcf7-form-control-wrap datetime-4891">
                        <input type="text" name="<?php echo $re_data['form']['name_fields']['date_and_time']; ?>" value="" size="20" class="wpcf7-form-control wpcf7-date wpcf7-datetime form-box__str__i-text" id="dp1482805130657" required>
                    </span>
                </div>

                <div class="form-box__str form-group-custom form-group-3">
                    <label class="form-box__str__label">Продолжительность*</label><br>
                    <span class="wpcf7-form-control-wrap duration">
                        <input type="text" name="<?php echo $re_data['form']['name_fields']['duration']; ?>" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-box__str__i-text" required aria-invalid="false">
                    </span>
                </div>
                <div class="form-box__str form-group-custom form-group-3">
                    <label class="form-box__str__label">Количество заданий*</label><br>
                    <span class="wpcf7-form-control-wrap quantity">
                        <input type="text" name="<?php echo $re_data['form']['name_fields']['number_task']; ?>" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-box__str__i-text" required aria-invalid="false">
                    </span>
                </div>

                <div class="form-box__str form-group-custom form-group-1 form-group-2 form-group-4">
                    <label class="form-box__str__label">Срок*</label><br>
                    <span class="wpcf7-form-control-wrap datetime-489"><input type="text" name="<?php echo $re_data['form']['name_fields']['date']; ?>" value="" size="40" class="wpcf7-form-control wpcf7-date-small wpcf7-validates-as-required form-box__str__i-text" aria-required="true" required placeholder="Введите дату" id="dp1483452982465" readonly="readonly"> </span>
                </div>

                <div class="form-spoiler__link">Параметры работы</div>
                <div class="form-spoiler">
                    <div class="form-box__str form-group-custom form-group-2">
                        <label class="form-box__str__label">Страниц от
                            <span class="wpcf7-form-control-wrap number-start">
                                <input type="number" name="<?php echo $re_data['form']['name_fields']['number_start']; ?>" value="20" class="wpcf7-form-control wpcf7-number wpcf7-validates-as-number form-box__str__number" min="0" max="99" step="5" onclick="this.select();" aria-invalid="false">
                            </span>
                        </label>
                        <label class="form-box__str__label">до
                            <span class="wpcf7-form-control-wrap number-end">
                                <input type="number" name="<?php echo $re_data['form']['name_fields']['number_end']; ?>" value="25" class="wpcf7-form-control wpcf7-number wpcf7-validates-as-number form-box__str__number" min="0" max="99" step="5" onclick="this.select();" aria-invalid="false">
                            </span>
                        </label>
                    </div>
                    <div class="form-box__str form-group-custom form-group-2">
                        <label class="form-box__str__label">Уникальность</label><br>
                        <span class="wpcf7-form-control-wrap unicum">
                            <input type="number" name="<?php echo $re_data['form']['name_fields']['unical_procent']; ?>" value="50" class="wpcf7-form-control wpcf7-number wpcf7-validates-as-number form-box__str__number" min="0" max="99" step="5" onclick="this.select();" aria-invalid="false">
                        </span>
                        % &nbsp;
                        <select class="unique_selector" name="<?php echo $re_data['form']['name_fields']['site_unical']; ?>">
                            <option value="antiplagiat.ru">antiplagiat.ru</option>
                            <option value="Антиплагиат.ВУЗ">Антиплагиат.ВУЗ</option>
                            <option value="Руконтекст">Руконтекст</option>
                        </select>
                    </div>

                    <div class="form-box__str form-group-custom form-group-4">
                        <label class="form-box__str__label">Слайдов от
                            <span class="wpcf7-form-control-wrap number-start">
                                <input type="number" name="<?php echo $re_data['form']['name_fields']['number_start']; ?>" value="20" class="wpcf7-form-control wpcf7-number wpcf7-validates-as-number form-box__str__number" min="0" max="99" step="5" onclick="this.select();" aria-invalid="false">
                            </span>
                        </label>
                        <label class="form-box__str__label">до
                            <span class="wpcf7-form-control-wrap number-end">
                                <input type="number" name="<?php echo $re_data['form']['name_fields']['number_end']; ?>" value="25" class="wpcf7-form-control wpcf7-number wpcf7-validates-as-number form-box__str__number" min="0" max="99" step="5" onclick="this.select();" aria-invalid="false">
                            </span>
                        </label>
                    </div>

                    <div class="form-group no-files form-box__str">
                        <label class="form-box__str__label form-group-1 form-group-2"><span id="files-offline">Задание</span><span id="files-online">Примерное задание</span></label><br>
                        <div class="b-files-small js-files"></div>
                        <div class="files_container">
                            <div class="boxButtonFile">
                                <a class="btn btn-primary" href="#">Добавить файлы</a>
                                <input type="file" multiple/>
                            </div>

                        </div>
                    </div>

                    <div class="form-box__str">
                        <label class="form-box__str__label">Пояснения</label><br>
                        <span class="wpcf7-form-control-wrap comment">
                            <textarea name="<?php echo $re_data['form']['name_fields']['comment']; ?>" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea form-box__str__textarea" aria-invalid="false" placeholder="Номер задания, вариант, пожелания..."></textarea>
                        </span>
                    </div>

                </div>
                <div class="form-more-button">Узнать стоимость</div>
            </div>
        </div>
        <div class="wpcf7-response-output wpcf7-display-none"></div>
    </form>
</div>

<div id="re_form-<?php echo $type_form; ?>-result"></div>
