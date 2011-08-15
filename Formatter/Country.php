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
 * Formats country code to localized country name
 *
 * @author Dennis Oehme <oehme@gardenofconcepts.com>
 */
use Symfony\Component\Locale\Locale;

class Country extends Formatter
{
    public function formatCountry($country, $locale = null)
    {
        $locale = $this->getLocale($locale);
        $locale = \Locale::getPrimaryLanguage($locale);
        $countries = Locale::getDisplayCountries( $locale );

        if (isset($countries[$country])) {
            return $countries[$country];
        }

        return $country;
    }
}
