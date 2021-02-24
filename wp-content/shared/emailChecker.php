<?php

class EmailChecker
{
    /**
     * @var string
     */
    protected $email;
    /**
     * @var string[][]
     */
    private $zones;

    public function __construct($email)
    {
        $this->email = $email;
        $this->zones = [
            'ru' => ['ry', 'ri', 'rj', 'rh', 'tu', 'eu'],
            'com' => ['co', 'con', 'vom', 'om']
        ];
    }

    private function convertDomain($domain)
    {
        global $wpdb;

        $sql = $wpdb->prepare('SELECT c.name FROM wp_domain_variation v JOIN wp_domain_correct c ON v.correct_id = c.id WHERE v.name = %s LIMIT 1', $domain);
        $res = $wpdb->get_col($sql);
        return !empty($res) ? $res[0] : $domain;
    }

    public function check()
    {
        if (!$this->email) {
            return false;
        }
        $emailParts = explode('@', $this->email);
        if (count($emailParts) == 2) {
            $username = $emailParts[0];
            $domain = $emailParts[1];
            $domainParts = explode('.', $domain);
            if (count($domainParts) == 2) {
                foreach ($this->zones as $zone => $test) {
                    if (in_array($domainParts[1], $test)) {
                        $domain = "{$domainParts[0]}.{$zone}";
                        $this->email = "{$username}@{$domain}";
                        if (self::isLooksCorrect($this->email)) {
                            return $this->email;
                        }
                    }
                }
            }
        } else {
            return false;
        }

        return "{$username}@{$this->convertDomain($domain)}";
    }

    public function tryFix()
    {
        $before = $this->email;
        $res = $this->check();
        error_log(date("d.m.Y H:i:s") . ': ' . $before . '  ---->  ' . $res . PHP_EOL, 3, __DIR__ . '/email-checker.log');
        return $res;
    }

    public static function isLooksCorrect($email)
    {
        global $wpdb;

        try {
            $parts = explode('@', $email);
            if (count($parts) === 2) {
                $sql = $wpdb->prepare("SELECT id FROM `wp_domain_correct` WHERE `name` = %s LIMIT 1", $parts[1]);
                return $wpdb->get_row($sql) !== null;
            }
            return false;
        } catch (Exception $e) {
            return true;
        }
    }
}