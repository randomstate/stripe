<?php


namespace RandomState\Stripe\Fake\Traits;


trait RuntimeExpansions
{
    protected static $expanders = [];

    public static function expand(string $string, \Closure $param)
    {
        static::$expanders[$string] = $param;
    }

    public function __call($name, $arguments)
    {
        $isExpansionAttempt = strpos($name, 'expand') === 0;
        $expansion = str_replace('expand', '', $name);

        if ($isExpansionAttempt) {
            $uncamelize = function ($str) {
                $str = lcfirst($str);
                $lc = strtolower($str);
                $result = '';
                $length = strlen($str);
                for ($i = 0; $i < $length; $i++) {
                    $result .= ($str[$i] == $lc[$i] ? '' : '_') . $lc[$i];
                }
                return $result;
            };

            $expander = $uncamelize($expansion);

            if ($expander = static::$expanders[$expander] ?? null) {
                return $expander($this);
            }
        }

        throw new \Error("Undefined method: " . $name);
    }
}