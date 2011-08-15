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
 * Interface for an salutation object that could be localized
 *
 * @author Dennis Oehme <oehme@gardenofconcepts.com>
 */
interface Salutation
{
    const MALE = 'm';
    const FEMALE = 'f';
    const ORGANIZATION = 'o';

    /**
     * @return string m, f or o
     */
    public function getSalutation();

    /**
     * @return string
     */
    public function getOrganization();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getFirstname();

    /**
     * @return string
     */
    public function getLastname();
}
