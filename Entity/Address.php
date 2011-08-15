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

namespace GOC\LocaleBundle\Entity;

/**
 * Interface for an address that could be localized
 *
 * @author Dennis Oehme <oehme@gardenofconcepts.com>
 */
interface Address
{
    /**
     * Get thoroughfare
     *
     * @return string
     */
    public function getThoroughfare();

    /**
     * Get postalcode
     *
     * @return string
     */
    public function getPostalcode();

    /**
     * Get locality
     *
     * @return string
     */
    public function getLocality();

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry();
}
