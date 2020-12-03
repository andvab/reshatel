<?php

class EmailChecker
{
    /**
     * @var string[]
     */
    protected $gmail;

    /**
     * @var string
     */
    protected $email;
    /**
     * @var string[][]
     */
    private $zones;
    /**
     * @var string[][]
     */
    private $services;

    public function __construct($email)
    {
        $this->email = $email;
        $this->services = [
            'gmail.com' => [
                'gmail.ru',
                'gamail.com',
                'gvail.com',
                'gail.com',
                'gmal.com',
                'gmaul.com',
                'gmaol.com',
                'qmail.com',
                'bmail.com',
                'hmail.com',
                'gmeil.com',
                'gmal.ru',
                'gmal.com',
                'gmai.com',
                'jmail.com',
                'gmsil.com'
            ],
            'yandex.ru' => [
                'yndex.ru',
                'yande.ru',
                'yanbex.ru',
                'uandex.ru',
                'yandex.ru.ru',
                'yadex.ru',
                'eandex.ru',
                'iandex.ru',
                'jandex.ru',
                'yandekx.ru',
                'yahdex.ru',
                'yqndex.ru',
                'yansex.ru',
                'yamdex.ru',
                'yamdez.ru',
                'yandec.ru',
            ],
            'mail.ru' => [
                'maii.ru',
                'mael.ru',
                'mail.ru.ru',
                'meil.ru',
                'maile.ru',
                'maiil.ru',
                'mial.ru',
                'vail.ru',
                'gail.ru',
                'amil.ru',
                'msil.ru',
                'nail.ru'
            ],
            'inbox.ru' => [
                'indox.ru',
                'invox.ru',
                'ibnox.ru'
            ],
            'bk.ru' => [
                'bj.ru',
                'bl.ru',
                'bi.ru'
            ],
            'rambler.ru' => [
                'ramler.ru',
                'ramble.ru',
                'bambler.ru',
                'ramrler.ru',
                'rambker.ru',
                'ramdler.ru',
                'gambler.ru',
                'rfmbler.ru'
            ]
        ];
        $this->zones = [
            'ru' => ['ry', 'ri', 'rj', 'rh', 'tu', 'eu'],
            'com' => ['co', 'con', 'vom']
        ];

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

        foreach ($this->services as $service => $test) {
            if (in_array($domain, $test)) {
                return "{$username}@{$service}";
            }
        }

        return false;
    }

    public function tryFix()
    {
        $before = $this->email;
        $res = $this->check() ?: $this->email;
        error_log(date("d.m.Y H:i:s") . ': ' . $before . '  ---->  ' . $res . PHP_EOL, 3, __DIR__.'/email-checker.log');
        return $res;
    }

    public static function isLooksCorrect($email)
    {
        $pattern = "/(@mail.ru)|(@inbox.ru)|(@mail.ua)|(@bk.ru)|(@list.ru)|
        (yandex.ru)|(@ya.ru)|(yandex.com)|(@yandex.kz)|(@yandex.ua)|(@yandex.by)|(@narod.ru)|(@gmail.com)|
        (@yahoo.com)|(@yahoo.fr)|(rocketmail.com)|(@rambler.ru)|(ro.ru)|(@icloud.com)|(@reshatel.org)|(@ukr.net)|
        (@hotmail.com)|(@ngs.ru)|(@tut.by)|(@outlook.com)|(@me.com)|(@sibmail.com)|(@i.ua)|(@inbox.lv)|(@meta.ua)|
        (qq.com)|(@my.com)|(@edu.hse.ru)|(@live.ru)|(@bigmir.net)|(@lenta.ru)|(@e1.ru)|(@protonmail.com)|
        (@qip.ru)|(phystech.edu)|(@pfur.ru)/";
        return preg_match($pattern, $email);
    }
}