<?php

/*
 * This file is part of the GOCLocaleBundle
 *
 * Copyright (c) 2011 Dennis Oehme <oehme@gardenofconcepts.com>
 * Copyright (c) 2011 Garden of Concepts GmbH, http://www.gardenofoncepts.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GOC\LocaleBundle\Formatter;

/**
 * Formats DateTime objects or datetime-formated strings to localized
 * datetime string
 *
 * @author Dennis Oehme <oehme@gardenofconcepts.com>
 */
class DateTime extends Formatter
{
    private $datetimeFormats = array(
        'NONE'   => \IntlDateFormatter::NONE,
        'SHORT'  => \IntlDateFormatter::SHORT,
        'MEDIUM' => \IntlDateFormatter::MEDIUM,
        'LONG'   => \IntlDateFormatter::LONG,
        'FULL'   => \IntlDateFormatter::FULL,
    );

    private $constants = array(
        'ATOM'    => \DateTime::ATOM,
        'COOKIE'  => \DateTime::COOKIE,
        'ISO8601' => \DateTime::ISO8601,
        'RFC822'  => \DateTime::RFC822,
        'RFC850'  => \DateTime::RFC850,
        'RFC1036' => \DateTime::RFC1036,
        'RFC1123' => \DateTime::RFC1123,
        'RFC2822' => \DateTime::RFC2822,
        'RFC3339' => \DateTime::RFC3339,
        'RSS'     => \DateTime::RSS,
        'W3C'     => \DateTime::W3C,
        'R'       => \DateTime::RFC2822, // date() => r
        'C'       => \DateTime::ISO8601, // date() => C
        'U'       => 'U', // date() => U
    );

    public function getDateTime($date, $timezone = null)
    {
        if (!$date instanceof \DateTime) {
            if (ctype_digit((string) $date)) {
                $date = new \DateTime('@'.$date);
            } else {
                $date = new \DateTime($date);
            }
        }

        if ($timezone !== null) {
            if (!$timezone instanceof \DateTimeZone) {
                $timezone = new \DateTimeZone($timezone);
            }

            $date->setTimezone($timezone);
        } else {
            $date->setTimezone(new \DateTimeZone(date_default_timezone_get()));
        }

        return $date;
    }

    public function getDateTimeFormat($format, $default = null)
    {
        if (isset($this->datetimeFormats[strtoupper($format)])) {
            return $this->datetimeFormats[strtoupper($format)];
        }

        if (empty($format) && !empty($default)) {
            return $this->datetimeFormats[strtoupper($default)];
        }

        return \IntlDateFormatter::SHORT;
    }

    public function isPattern($format)
    {
        return !empty($format) && !isset($this->datetimeFormats[strtoupper($format)]);
    }

    public function isConstant($format)
    {
        return isset($this->constants[strtoupper($format)]);
    }

    public function getConstant($constant)
    {
        if ($this->isConstant($constant)) {
            return $this->constants[strtoupper($constant)];
        }

        return null;
    }

    public function getFormat($format)
    {
        if (isset($this->dateToDatetimeFormat[strtoupper($format)])) {
            return $this->dateToDatetimeFormat[strtoupper($format)];
        }

        return $format;
    }

    public function formatDatetime($datetime, $formatDate = null, $formatTime = null, $timezone = null, $locale = null)
    {
        $datetime   = $this->getDateTime($datetime, $timezone);
        $locale     = $this->getLocale($locale);
        $format     = trim($formatDate . ' ' . $formatTime);

        if ($this->isConstant($format)) {
            return $datetime->format($this->getConstant($format));
        }

        if ($this->isPattern($formatDate) || $this->isPattern($formatTime)) {
            $formatter  = new \IntlDateFormatter($locale, null, null, $datetime->getTimezone()->getName());
            $formatter->setPattern($this->getFormat($format));
        } else {
            $formatDate = $this->getDateTimeFormat($formatDate, 'FULL');
            $formatTime = $this->getDateTimeFormat($formatTime, 'SHORT');
            $formatter  = new \IntlDateFormatter($locale, $formatDate, $formatTime, $datetime->getTimezone()->getName());
        }

        return $formatter->format($datetime);
    }

    public function formatDate($date, $format = null, $timezone = null, $locale = null)
    {
        $date       = $this->getDateTime($date, $timezone);
        $locale     = $this->getLocale($locale);

        if ($this->isConstant($format)) {
            return $date->format($this->getConstant($format));
        }

        if ($this->isPattern($format)) {
            $formatter  = new \IntlDateFormatter($locale, null, null, $date->getTimezone()->getName());
            $formatter->setPattern($this->getFormat($format));
        } else {
            $format     = $this->getDateTimeFormat($format, 'FULL');
            $formatter  = new \IntlDateFormatter($locale, $format, \IntlDateFormatter::NONE, $date->getTimezone()->getName());
        }

        return $formatter->format($date);
    }

    public function formatTime($time, $format = null, $timezone = null, $locale = null)
    {
        $time       = $this->getDateTime($time, $timezone);
        $locale     = $this->getLocale($locale);

        if ($this->isConstant($format)) {
            return $time->format($this->getConstant($format));
        }

        if ($this->isPattern($format)) {
            $formatter  = new \IntlDateFormatter($locale, null, null, $time->getTimezone()->getName());
            $formatter->setPattern($this->getFormat($format));
        } else {
            $format     = $this->getDateTimeFormat($format, 'SHORT');
            $formatter  = new \IntlDateFormatter($locale, \IntlDateFormatter::NONE, $format, $time->getTimezone()->getName());
        }

        return $formatter->format($time);
    }
}
