<?php

class ROV {

    private $sqlOrder;
    private $sqlType;
    private $sqlSection;
    private $sqlCategory;
    private $sqlFile;

    public function __construct($dbParameters) {
        $this->sqlOrder = $dbParameters->order;
        $this->sqlType = $dbParameters->type;
        $this->sqlSection = $dbParameters->section;
        $this->sqlCategory = $dbParameters->category;
        $this->sqlFile = $dbParameters->file;
    }

    public function run() {
        register_activation_hook(__DIR__ . '/reshatel-order-viewer.php', [$this, 'install']);

        add_action('wp_enqueue_scripts', function() {
            wp_register_style('rv-style-css', plugins_url('css', __FILE__) . '/style.css', ['dashicons']);
            wp_enqueue_style('rv-style-css');

            $urlJS = plugins_url('js', __FILE__);
            wp_register_script('rv-readmore-js', $urlJS . '/readmore.min.js', ['jquery'], '1.0.0', true);
            wp_enqueue_script('rv-readmore-js');
            wp_register_script('rv-scroll-js', $urlJS . '/jscroll.min.js', ['jquery'], '2.4.1', true);
            wp_enqueue_script('rv-scroll-js');
            wp_register_script('rv-script-js', $urlJS . '/script.js', ['rv-scroll-js'], '1.0.0', true);
            wp_enqueue_script('rv-script-js');
        }, 100);

        add_shortcode('rv_show_order', [$this, 'showOrder']);
        add_shortcode('rv_show_feed', [$this, 'showFeed']);
    }

    public function install() {
        global $wpdb;

        $sql = "CREATE TABLE IF NOT EXISTS `" . $this->sqlType . "` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                `name` varchar(255) NOT NULL,
                                `name_en` varchar(255) NULL,
                                PRIMARY KEY (`id`),
                                INDEX `inx__name_en` (`name_en`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $wpdb->query($sql);

        $sql = "INSERT INTO `" . $this->sqlType . "` VALUES (1,'Контрольная','kontrolnye-raboty'),(2,'Решение задач','reshenie-zadach'),(3,'Курсовая','kursovye-raboty'),(4,'Диплом','diploms'),(5,'Реферат','referats'),(6,'Онлайн помощь','online-pomosh'),(7,'Другое',NULL),(8,'Дистанционный тест',NULL),(9,'Презентация','presentations'),(10,'Эссе','essay'),(11,'Отчет по практике','otchety-po-praktike'),(12,'Перевод','perevody');";
        $wpdb->query($sql);


        $sql = "CREATE TABLE IF NOT EXISTS `" . $this->sqlOrder . "` (
  				`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  				`type_id` int(10) unsigned NOT NULL,
  				`category_id` int(10) unsigned NULL,
  				`section_id` int(10) unsigned NULL,
  				`page_name` varchar(255) NOT NULL,

  				`name` varchar(255) NOT NULL,
                                `subject` varchar(255) NOT NULL,
                                `date_created` datetime NOT NULL,
                                `date_finished` datetime DEFAULT NULL,
                                `pages_start` int(11) DEFAULT NULL,
                                `pages_end` int(11) DEFAULT NULL,
                                `unique_persent` int(11) DEFAULT NULL,
                                `time_start` varchar(255) DEFAULT NULL,
                                `duration` varchar(255) DEFAULT NULL,
                                `comments` longtext DEFAULT NULL,
                                `unique_tester_id` int(11) unsigned DEFAULT NULL,
                                `price` int(11) DEFAULT NULL,
                                `tests_count` varchar(255) DEFAULT NULL,
                                `try_count` varchar(255) DEFAULT NULL,
                                
  				PRIMARY KEY (`id`),
                                INDEX `inx__date_finished` (`date_finished`),
                                INDEX `inx__page_name` (`page_name`),
                                INDEX `inx__category_id` (`category_id`),
                                INDEX `inx__section_id` (`section_id`),
                                INDEX `inx__type_id` (`type_id`),
                                CONSTRAINT FOREIGN KEY `fk__order__type` (`type_id`) REFERENCES `$this->sqlType` (`id`) ON DELETE CASCADE
				) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $wpdb->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS `" . $this->sqlSection . "` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                `name` varchar(255) NOT NULL,
                                PRIMARY KEY (`id`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $wpdb->query($sql);

        $sql = "INSERT INTO `" . $this->sqlSection . "` VALUES (1,'Математические'),(2,'Естественные'),(3,'Технические'),(4,'Программирование и информатика'),(5,'Гуманитарные'),(6,'Экономические'),(7,'Иностранные языки'),(8,'Правовые');";
        $wpdb->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS `" . $this->sqlCategory . "` (
                                `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                `name` varchar(255) NOT NULL,
                                `name_dat` varchar(255) NOT NULL,
                                `name_translit` varchar(255) NOT NULL,
                                `section_id` int(10) unsigned NOT NULL,
                                PRIMARY KEY (`id`),
                                INDEX `inx__section_id` (`section_id`),
                                INDEX `inx__name_id` (`name`),
                                CONSTRAINT FOREIGN KEY `fk__category__section` (`section_id`) REFERENCES `$this->sqlSection` (`id`) ON DELETE CASCADE
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $wpdb->query($sql);

        $values = file_get_contents(__DIR__ . '/categories.sql');
        $sql = "INSERT INTO `$this->sqlCategory` VALUES $values";
        $wpdb->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS `$this->sqlFile` (
                                `id` INT NOT NULL AUTO_INCREMENT,
                                `order_id` INT(10) UNSIGNED NOT NULL,
                                `is_done` TINYINT(1) NOT NULL DEFAULT 0,
                                `name` VARCHAR(255) NOT NULL,
                                `url` VARCHAR(255) NOT NULL,
                                `date_loaded` DATETIME NULL,
                                PRIMARY KEY (`id`),
                                INDEX `inx__order_id` (`order_id`),
                                CONSTRAINT `order_file__order` FOREIGN KEY (`order_id`) REFERENCES `$this->sqlOrder` (`id`) ON DELETE CASCADE
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $wpdb->query($sql);
    }

    private function getOrderTesterName($uniquiId) {
        $testers = [
            1 => 'antiplagiat.ru',
            2 => 'Антиплагиат.ВУЗ',
            3 => 'etxt.ru'
        ];

        return $testers[$uniquiId];
    }

    public function getOrderFromCurrentUrl() {
        global $wpdb;

        $path = explode('/', $_SERVER["REQUEST_URI"]);

        $orderName = $path[2];

        if (!$orderName) {
            return null;
        }

        $sql = $wpdb->prepare("SELECT o.id, o.type_id, t.name type, t.name_en type_url, o.name, o.subject, o.category_id, o.date_created, o.date_finished, o.pages_start, o.pages_end, o.unique_persent, o.unique_tester_id, o.duration, o.tests_count, o.try_count, o.comments, o.price, c.name_dat cat_dat FROM " . $this->sqlOrder . " o LEFT JOIN " . $this->sqlType . " t ON o.type_id = t.id LEFT JOIN " . $this->sqlCategory . " c ON o.category_id = c.id 
                               WHERE o.page_name = %s", $orderName);

        $order = $wpdb->get_row($sql);

        if (!$order) {
            return null;
        }

//        add_filter('wp_title', function() use($order) {
//            return ($order ? $order->name : 'Ошибка') . ' | ';
//        });
        add_filter('aioseo_title', function() use($order) {
            return ($order ? $order->name . ' на заказ': 'Ошибка') . ' | Решатель';
        });
        add_filter('aioseo_canonical_url', function() use($orderName) {
            return get_site_url() . "/orders/$orderName/";
        });
        add_action('wp_head', function() use($order) {
            echo '<meta name="description" content="' . "$order->name - $order->type по $order->cat_dat на заказ" . '" />';
            if (iconv_strlen($order->comments) < 1000) {
                echo '<meta name="robots" content="noindex, follow"/>';
            }
        });

        $order->tester = $this->getOrderTesterName($order->unique_tester_id);

        return $order;
    }

    public function getOrders($page = 1, $conds = null, $count = 20) {
        global $wpdb;

        $where = '';
        $parameters = [];
        if ($conds['type_id']) {
            $where = "WHERE o.type_id = %d";
            array_push($parameters, $conds['type_id']);
        }
        if ($conds['section_id']) {
            $where .= ($where ? " AND" : "WHERE") . " o.section_id = %d";
            array_push($parameters, $conds['section_id']);
        }
        if ($conds['category_id']) {
            $where .= ($where ? " AND" : "WHERE") . " o.category_id = %d";
            array_push($parameters, $conds['category_id']);
        }
        if ($conds['search']) {
            $pattern = "%{$conds['search']}%";
            $where .= ($where ? " AND" : "WHERE") . " o.subject LIKE %s OR o.name LIKE %s OR o.comments LIKE %s";
            array_push($parameters, $pattern, $pattern, $pattern);
        }
        if ($conds['except']) {
            $where .= ($where ? " AND" : "WHERE") . " o.id != %d";
            array_push($parameters, $conds['except']);
        }

        array_push($parameters, ($page - 1) * $count);
        array_push($parameters, $count);

        $sql = $wpdb->prepare("SELECT o.id, t.name type, o.name, o.subject, o.date_created, o.date_finished, o.price, o.section_id, o.category_id, o.page_name path
                               FROM " . $this->sqlOrder . " o LEFT JOIN " . $this->sqlType . " t ON o.type_id = t.id " . $where . " 
                               ORDER BY o.date_finished DESC LIMIT %d, %d", ...$parameters);

        return $wpdb->get_results($sql);
    }

    public function getOrderFIles($orderId, $isDone = 0) {
        global $wpdb;

        $sql = $wpdb->prepare("SELECT f.name, f.url, f.date_loaded FROM $this->sqlFile f WHERE f.order_id = %d AND f.is_done = %d", $orderId, $isDone);

        return $wpdb->get_results($sql);
    }

    static public function test($parts) {
        error_log('test');
        return "TEST";
    }

    public function showOrder() {
        $order = $this->getOrderFromCurrentUrl();
        if (!$order) {
            include( get_query_template('404') );
            exit;
        }
        $filesUser = $this->getOrderFIles($order->id);

        ob_start();
        include __DIR__ . '/template/show.php';
        return ob_get_clean();
    }

    public function showFeed($atts) {
        $params = shortcode_atts(['page' => 1, 'type' => null, 'section' => null, 'category' => null, 'search' => null], $atts);
        $page = $params['page'];
        $conds['type_id'] = $params['type'];
        $conds['section_id'] = $params['section'];
        $conds['category_id'] = $params['category'];
        $conds['search'] = $params['search'];

        $selectedType = $conds['type_id'];
        $selectedSection = $conds['section_id'];
        $selectedCategory = $conds['category_id'];
        $search = $conds['search'];

        $orders = $this->getOrders($page, $conds);
        $types = $this->getTypes();
        $sections = $this->getSections();
        $categories = $selectedSection ? $this->getCategories($selectedSection) : null;

        add_action('wp_head', function() {
            echo '<link rel="canonical" href="https://reshatel.org/orders/">';
        });

        ob_start();
        include __DIR__ . '/template/feed.php';
        return ob_get_clean();
    }

    public function showLastOrdersJSON(WP_REST_Request $request) {
        $page = filter_var($request['page'], FILTER_VALIDATE_INT, ['options' => ['default' => 1, 'min_range' => 1]]);
        $type = filter_var($request['type'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        $category = filter_var($request['cat'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        $exceptOrder = (int)$request->get_param('e');

        $orders = $this->getOrders($page, ['type_id' => $type, 'category_id' => $category, 'except' => $exceptOrder]);

        foreach ($orders as $order) {
            $order->date_finished = mysql2date('j F Y', $order->date_finished);
        }

        return $orders;
    }

    public function getSections() {
        global $wpdb;

        return $wpdb->get_results("SELECT id, name FROM $this->sqlSection");
    }

    public function getCategories($sectionId) {
        global $wpdb;

        $sql = $wpdb->prepare("SELECT id, name FROM $this->sqlCategory WHERE section_id = %d ORDER BY name", $sectionId);

        return $wpdb->get_results($sql);
    }

    public function getTypes() {
        global $wpdb;

        return $wpdb->get_results("SELECT id, name FROM $this->sqlType");
    }

    public static function buildSitemap() {
        global $wpdb;

        $generatorObject = &GoogleSitemapGenerator::GetInstance();
        if (!$generatorObject) {
            return false;
        }

        $sql = "SELECT CONCAT('orders/',o.page_name,'/') path FROM wp_lk_order o LEFT JOIN wp_lk_type t ON o.type_id = t.id LEFT JOIN wp_lk_category c ON o.category_id = c.id WHERE CHAR_LENGTH(o.comments) > 999 ORDER BY o.id DESC LIMIT 49999";
        $urls = $wpdb->get_results($sql);

        $date = $wpdb->get_var('SELECT UNIX_TIMESTAMP(max(date_finished)) FROM wp_lk_order') ?: time();

        $site = get_site_url();
        foreach ($urls as $url) {
            $generatorObject->AddUrl("$site/$url->path", $date, "monthly", 0.8);
        }

//        error_log("Sitemap created!", 0);
    }

}
