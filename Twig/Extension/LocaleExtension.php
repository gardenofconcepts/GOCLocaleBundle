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

namespace GOC\LocaleBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Twig extension as helper to localize data
 *
 * @author Dennis Oehme <oehme@gardenofconcepts.com>
 */
class LocaleExtension extends \Twig_Extension
{
    protected $container;
    
    protected $dateFormatter;
    protected $numericFormatter;
    protected $countryFormatter;
    protected $salutationFormatter;
    protected $addressFormatter;

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $this->dateFormatter    = new \GOC\LocaleBundle\Formatter\DateTime($container);
        $this->numericFormatter = new \GOC\LocaleBundle\Formatter\Numeric($container);
        $this->countryFormatter = new \GOC\LocaleBundle\Formatter\Country($container);
        $this->addressFormatter = new \GOC\LocaleBundle\Formatter\Address($container);
        $this->salutationFormatter = new \GOC\LocaleBundle\Formatter\Salutation($container);
    }

    public function getFunctions()
    {
        return array();
    }

    public function getFilters()
    {
        return array(
            'date'      => new \Twig_Filter_Method($this, 'formatDate', array('is_safe' => array('html'))),
            'datetime'  => new \Twig_Filter_Method($this, 'formatDatetime', array('is_safe' => array('html'))),
            'time'      => new \Twig_Filter_Method($this, 'formatTime', array('is_safe' => array('html'))),
            'number'    => new \Twig_Filter_Method($this, 'formatNumber', array('is_safe' => array('html'))),
            'integer'   => new \Twig_Filter_Method($this, 'formatInteger', array('is_safe' => array('html'))),
            'decimal'   => new \Twig_Filter_Method($this, 'formatDecimal', array('is_safe' => array('html'))),
            'percent'   => new \Twig_Filter_Method($this, 'formatPercent', array('is_safe' => array('html'))),
            'currency'  => new \Twig_Filter_Method($this, 'formatCurrency', array('is_safe' => array('html'))),
            'country'   => new \Twig_Filter_Method($this, 'formatCountry', array('is_safe' => array('html'))),
            //'address'   => new \Twig_Filter_Method($this, 'formatAddress', array('is_safe' => array('html'))),
            //'salutation'   => new \Twig_Filter_Method($this, 'formatSalutation', array('is_safe' => array('html'))),
        );
    }

    public function formatDatetime($datetime, $formatDate = null, $formatTime = null, $timezone = null, $locale = null)
    {
        return $this->dateFormatter->formatDatetime($datetime, $formatDate, $formatTime, $timezone, $locale);
    }

    public function formatDate($date, $format = null, $timezone = null, $locale = null)
    {
        return $this->dateFormatter->formatDate($date, $format, $timezone, $locale);
    }

    public function formatTime($time, $format = null, $timezone = null, $locale = null)
    {
        return $this->dateFormatter->formatTime($time, $format, $timezone, $locale);
    }

    public function formatCountry($country, $locale = null)
    {
        return $this->countryFormatter->formatCountry($country, $locale);
    }

    public function formatNumber($integer, $locale = null)
    {
        return $this->numericFormatter->formatNumber($integer, $locale);
    }

    public function formatInteger($number, $locale = null)
    {
        return $this->numericFormatter->formatInteger($number, $locale);
    }

    public function formatDecimal($decimal, $round = null, $locale = null)
    {
        return $this->numericFormatter->formatDecimal($decimal, $round, $locale);
    }

    public function formatCurrency($currency, $type = null, $locale = null)
    {
        return $this->numericFormatter->formatCurrency($currency, $type, $locale);
    }

    public function formatPercent($percent, $locale = null)
    {
        return $this->numericFormatter->formatPercent($percent, $locale);
    }

    public function formatAddress($address, $format = null, $locale = null)
    {
        return $this->addressFormatter->formatAddress($address, $format, $locale);
    }

    public function formatSalutation($person, $format = null, $locale = null)
    {
        return $this->numericFormatter->formatSalutation($person, $format, $locale);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'locale';
    }
}
