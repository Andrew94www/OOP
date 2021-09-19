<?php
class CookieShell
{
    public function set($name, $value, $time)
    {
        setcookie($name, $value, time() + $time);
        $_COOKIE[$name] =  $value;  /*устанавливает $name задает имя $value устанавливает значение куки
                                                     ,$time задает время в сек, через сколько кука умрет*/
    }

    public function get($name)
    {
        return $_COOKIE[$name];
    }

    public function del($name)
    {

        unset($_COOKIE[$name]);
        $_COOKIE[$name] = null;
    }

    public function exists($name)
    {
        if (isset($_COOKIE[$name])) {
            return true;
        } else {
            return false;
        }
    }
}
$csh = new CookieShell;
if ($csh->exists('count')) {
    $val = $_COOKIE['count'];
} else {
    $val = 0;
}
$val++;
$csh->set('count', $val, 10);

echo $val;
