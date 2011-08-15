Twig extension
==============

datetime filter
---------------
* datetime($formatDate = 'full', $formatTime = 'short', $locale = null)
* date($format = 'full', $locale = null)
* time($format = 'short', $locale = null)

$format equals to IntlDateFormatter::FULL, etc.

numeric filter
--------------
* number($locale = null)
* integer($locale = null)
* decimal($round = null, $locale = null)
* currency($type = null, $locale = null)
* percent($round = 2, $base = null, $locale = null)

country filter
--------------
* country($locale = null)

address filter
--------------
not implemented yet

salutation filter
-----------------
not implemented yet
