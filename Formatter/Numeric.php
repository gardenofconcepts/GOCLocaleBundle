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
 * Formats numeric values to localized number string
 *
 * @author Dennis Oehme <oehme@gardenofconcepts.com>
 */
class Numeric extends Formatter
{
    public function formatNumber($number, $locale = null)
    {
        $locale = $this->getLocale($locale);
        $formatter = new \NumberFormatter($locale, \NumberFormatter::DECIMAL);
        $formatter->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, 0);
        $formatter->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, 100);

        return $formatter->format($number);
    }

    public function formatInteger($integer, $locale = null)
    {
        $locale = $this->getLocale($locale);
        $formatter = new \NumberFormatter($locale, \NumberFormatter::DECIMAL);
        $formatter->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, 0);
        $formatter->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, 0);

        return $formatter->format($integer);
    }

    public function formatDecimal($decimal, $round = null, $locale = null)
    {
        // TODO: if ($decimal < -1) $decimal = '<span class="decimal-negative">'.$decimal.'</span>';
        $round = $round ?: 2;
        $locale = $this->getLocale($locale);
        $formatter = new \NumberFormatter($locale, \NumberFormatter::DECIMAL);
        $formatter->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, $round);
        $formatter->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, $round);

        return $formatter->format($decimal);
    }

    public function formatCurrency($currency, $type = null, $locale = null)
    {
        $type = $type ?: 'EUR';
        $locale = $this->getLocale($locale);
        $formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY );

        return $formatter->formatCurrency($currency, $type);
    }

    public function formatPercent($percent, $round = 2, $base = null, $locale = null)
    {
        $round = $round ?: 2;
        $locale = $this->getLocale($locale);
        $formatter = new \NumberFormatter($locale, \NumberFormatter::PERCENT);
        $formatter->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, $round);
        $formatter->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, $round);

        return $formatter->format($percent);
    }
}
