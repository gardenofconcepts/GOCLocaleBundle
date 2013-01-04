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

namespace GOC\LocaleBundle\Listener;

/**
 * Detects locale by session or HTTP request header and set default locale
 *
 * @author Dennis Oehme <oehme@gardenofconcepts.com>
 */
class Listener
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function onKernelRequest($request)
    {
        $locales = array();
        $request = $request->getRequest();

        $locales[] = $request->getLocale();

        if ($request->server->has('HTTP_ACCEPT_LANGUAGE')) {
            $locales[] = \Locale::acceptFromHttp($request->server->get('HTTP_ACCEPT_LANGUAGE'));
        }

        foreach ($locales as $locale) {
            if (!empty($locale)) {
                $request->setLocale($locale);
                \Locale::setDefault($locale);
                break;
            }
        }
    }
}
