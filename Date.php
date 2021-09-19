<?php

class Date
{
    public $date;
    public function __construct($date = null)
    {
        if ($date == null) {
            $this->date = date('Y.m.d');
        } else {
            $this->date = $date;
        }
    }

    public function getDay()
    {
        return substr($this->date, 8, 2);
    }

    public function getMonth($lang = null)
    {
        if ($lang == 'en' or $lang == 'ru') {
            preg_match_all('#[a-z]{3,10}#', $this->date, $arr);
            return $arr[0][0];
        } else {
            return  substr($this->date, 5, 2);
        }
    }

    public function getYear()
    {
        return substr($this->date, 0, 4);
    }

    public function getWeekDay($lang = null)
    {
        if ($lang == 'en' or $lang == 'ru') {
            preg_match_all('#[a-z]{3,10}#', $this->date, $arr);
            return $arr[0][1];
        }
    }

    public function addDay($value)
    {
        if (preg_match('#\d\d\d\d-\d\d-\d\d#', $this->date)) {

            $val = (int) substr($this->date, 8, 2) + $value;

            return $this->getYear() . '-' . $this->getMonth() . '-' . $val;
        }
    }

    public function subDay($value)
    {
        if (preg_match('#\d\d\d\d-\d\d-\d\d#', $this->date)) {

            $val = (int) substr($this->date, 8, 2) - $value;

            return $this->getYear() . '-' . $this->getMonth() . '-' . $val;
        }
    }
    public function addMonth($value)
    {
        if (preg_match('#\d\d\d\d-\d\d-\d\d#', $this->date)) {

            $val = (int) substr($this->date, 5, 2) + $value;

            return $this->getYear() . '-' . $val . '-' . $this->getDay();
        }
    }

    public function subMonth($value)
    {

        if (preg_match('#\d\d\d\d-\d\d-\d\d#', $this->date)) {

            $val = (int) substr($this->date, 5, 2) - $value;

            return $this->getYear() . '-' . $val . '-' . $this->getDay();
        }
    }

    public function addYear($value)
    {
        if (preg_match('#\d\d\d\d-\d\d-\d\d#', $this->date)) {

            $val = (int) substr($this->date, 0, 4) + $value;

            return $this->getYear() . '-' . $val . '-' . $this->getDay();
        }
    }

    public function subYear($value)
    {
        if (preg_match('#\d\d\d\d-\d\d-\d\d#', $this->date)) {

            $val = (int) substr($this->date, 0, 4) - $value;

            return $this->getYear() . '-' . $val . '-' . $this->getDay();
        }
    }

    public function format($format)
    {
        $str = '';
        $a = substr($format, 0, 1);
        $b = substr($format, 1, 1);
        $c = substr($format, 2, 1);
        $d = substr($format, 3, 1);
        $e = substr($format, 4, 1);
        $arr = [$a, $b, $c, $d, $e];
        if (preg_match('#\d\d\d\d-\d\d-\d\d#', $this->date)) {
            foreach ($arr as $n) {
                if ($n == 'Y') {
                    $str .= preg_replace('#(\d\d\d\d)-(\d\d)-(\d\d)#', '$1', $this->date);
                } else if ($n == 'm') {
                    $str .= preg_replace('#(\d\d\d\d)-(\d\d)-(\d\d)#', '$2', $this->date);
                } else if ($n == 'd') {
                    $str .= preg_replace('#(\d\d\d\d)-(\d\d)-(\d\d)#', '$3', $this->date);
                } else {
                    $str .= $n;
                }
            }
            return $str;
        }
    }

    public function __toString()
    {
        return $this->date;
    }
}


class Interval extends Date
{
    public $date1;
    public $date2;
    public function __construct(Date $date1, Date $date2)
    {
        $this->date1 = $date1;
        $this->date2 = $date2;
    }

    public function toDays()
    {
        return (int) $this->date1->getDay() - (int)$this->date2->getDay();
    }

    public function toMonths()
    {
        return (int) $this->date1->getMonth() - (int)$this->date2->getMonth();
    }

    public function toYears()
    {
        return (int) $this->date1->getYear() - (int)$this->date2->getYear();
    }

    public function __toString()
    {

        return '[date = ' . $this->toDays() . ' month = ' . $this->toMonths() . ' year = ' . $this->toYears() . ']';
    }
}
$ob1 = new Date('2027-08-09');
$ob2 = new Date('2025-06-05');
$ob3 = new Interval($ob1, $ob2);
echo $ob3;
