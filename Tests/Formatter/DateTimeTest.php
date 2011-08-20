<?php

use \GOC\LocaleBundle\Formatter\DateTime as Formatter;

class DateTimeTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        \Locale::setDefault('de_DE');

        $formatter = new Formatter();

        $datetime = new DateTime('03.10.2011 13:49:12');
        $this->assertEquals($formatter->formatDate($datetime), 'Montag, 3. Oktober 2011');

        $datetime = new DateTime('now');
        $this->assertEquals($formatter->formatDate($datetime, 'short'), date('d.m.y'));
        $this->assertEquals($formatter->formatTime($datetime, 'short'), date('h:i'));
        //$this->assertEquals($formatter->formatDatetime($datetime, 'short', 'short'), date('d.m.y h:i'));

        $this->assertEquals($formatter->formatDate('now', 'short'), date('d.m.y'));
        $this->assertEquals($formatter->formatTime('now', 'short'), date('h:i'));

        $this->assertEquals($formatter->formatDate(time(), 'U'), time());
        $this->assertEquals($formatter->formatDatetime(time(), 'U'), time());
        $this->assertEquals($formatter->formatTime(time(), 'U'), time());
    }

    public function testDate()
    {
        \Locale::setDefault('de_DE');

        $formatter = new Formatter();
        $datetime = new DateTime('03.10.2011 13:49:12');

        $this->assertEquals($formatter->formatDate($datetime), 'Montag, 3. Oktober 2011');
        $this->assertEquals($formatter->formatDate($datetime, 'short'), '03.10.11');
        $this->assertEquals($formatter->formatDate($datetime, 'medium'), '03.10.2011');
        $this->assertEquals($formatter->formatDate($datetime, 'long'), '3. Oktober 2011');
        $this->assertEquals($formatter->formatDate($datetime, 'full'), 'Montag, 3. Oktober 2011');

        $this->assertEquals($formatter->formatDate($datetime, null, null, 'en_US'), 'Monday, October 3, 2011');
        $this->assertEquals($formatter->formatDate($datetime, 'short', null, 'en_US'), '10/3/11');
        $this->assertEquals($formatter->formatDate($datetime, 'medium', null, 'en_US'), 'Oct 3, 2011');
        $this->assertEquals($formatter->formatDate($datetime, 'long', null, 'en_US'), 'October 3, 2011');
        $this->assertEquals($formatter->formatDate($datetime, 'full', null, 'en_US'), 'Monday, October 3, 2011');

        $this->assertEquals($formatter->formatDate($datetime, 'YYYY-MM-dd'), '2011-10-03');
        $this->assertEquals($formatter->formatDate($datetime, 'dd.M.Y'), '03.10.2011');
    }

    public function testTime()
    {
        \Locale::setDefault('de_DE');

        $formatter = new Formatter();
        $datetime = new DateTime('03.10.2011 13:49:12');

        $this->assertEquals($formatter->formatTime($datetime), '13:49');
        $this->assertEquals($formatter->formatTime($datetime, 'short'), '13:49');
        $this->assertEquals($formatter->formatTime($datetime, 'medium'), '13:49:12');
        $this->assertEquals($formatter->formatTime($datetime, 'long'), '13:49:12 MESZ');
        $this->assertEquals($formatter->formatTime($datetime, 'full'), '13:49:12 Mitteleuropäische Sommerzeit');

        $this->assertEquals($formatter->formatTime($datetime, 'H:m'), '13:49');
    }

    public function testDatetime()
    {
        \Locale::setDefault('de_DE');

        $formatter = new Formatter();
        $datetime = new DateTime('03.10.2011 13:49:12');

        $this->assertEquals($formatter->formatDatetime($datetime), 'Montag, 3. Oktober 2011 13:49');
        $this->assertEquals($formatter->formatDatetime($datetime, 'short', 'short'), '03.10.11 13:49');
        $this->assertEquals($formatter->formatDatetime($datetime, 'full', 'medium'), 'Montag, 3. Oktober 2011 13:49:12');

        $this->assertEquals($formatter->formatDatetime($datetime, null, 'medium'), 'Montag, 3. Oktober 2011 13:49:12');
        $this->assertEquals($formatter->formatDatetime($datetime, 'medium', null), '03.10.2011 13:49');
    }

    public function testConstants()
    {
        \Locale::setDefault('de_DE');

        $formatter = new Formatter();
        
        //$this->assertEquals($formatter->formatDatetime('now', 'c'), date('c')); // date('c') !== \Datetime::ISO8601
        
        $this->assertEquals($formatter->formatDatetime('now', 'r'), date('r'));
        $this->assertEquals($formatter->formatTime('now', 'r'), date('r'));
        $this->assertEquals($formatter->formatDate('now', 'r'), date('r'));
        
        $this->assertEquals($formatter->formatDatetime('now', 'U'), date('U'));
        $this->assertEquals($formatter->formatTime('now', 'U'), date('U'));
        $this->assertEquals($formatter->formatDatetime('now', 'U'), date('U'));
    }
}
