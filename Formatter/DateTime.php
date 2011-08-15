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
    protected $datetimeFormats = array(
        'none'   => \IntlDateFormatter::NONE,
        'short'  => \IntlDateFormatter::SHORT,
        'medium' => \IntlDateFormatter::MEDIUM,
        'long'   => \IntlDateFormatter::LONG,
        'full'   => \IntlDateFormatter::FULL,
    );

    public function getDateTime($input)
    {
        if (!$input instanceof \DateTime) {
            return new \DateTime($input);
        }

        return $input;
    }

    public function getDateTimeFormat($format, $default = null)
    {
        if (empty($format) && !empty($default) && isset($this->datetimeFormats[$default])) {
            return $this->datetimeFormats[$default];
        }

        if (isset($this->datetimeFormats[strtolower($format)])) {
            return $this->datetimeFormats[strtolower($format)];
        }

        // TODO: pattern
        // pattern

        return \IntlDateFormatter::SHORT;
    }

    public function formatDatetime($datetime, $formatDate = null, $formatTime = null, $locale = null)
    {
        $datetime   = $this->getDateTime($datetime);
        $formatDate = $this->getDateTimeFormat($formatDate, 'full');
        $formatTime = $this->getDateTimeFormat($formatTime, 'short');
        $locale     = $this->getLocale($locale);
        $formatter  = new \IntlDateFormatter($locale, $formatDate, $formatTime);

        return $formatter->format($datetime);
    }

    public function formatDate($date, $format = null, $locale = null)
    {
        $date       = $this->getDateTime($date);
        $format     = $this->getDateTimeFormat($format, 'full');
        $locale     = $this->getLocale($locale);
        $formatter  = new \IntlDateFormatter($locale, $format, \IntlDateFormatter::NONE);

        return $formatter->format($date);
    }

    public function formatTime($time, $format = null, $locale = null)
    {
        $time       = $this->getDateTime($time);
        $format     = $this->getDateTimeFormat($format, 'short');
        $locale     = $this->getLocale($locale);
        $formatter  = new \IntlDateFormatter($locale, \IntlDateFormatter::NONE, $format);

        return $formatter->format($time);
    }
}
