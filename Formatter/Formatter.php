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

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Locale\Locale;

/**
 * Abstract class for formatter
 *
 * @author Dennis Oehme <oehme@gardenofconcepts.com>
 */
class Formatter
{
    protected $container;

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getLocale($locale = null)
    {
        if (empty($locale)) {
            \Locale::getDefault();
        }

        return $locale;
    }
}
