Twig extension
==============

datetime filter
---------------
* datetime($formatDate = 'full', $formatTime = 'short', $timezone = null, $locale = null)
* date($format = 'full', $timezone = null, $locale = null)
* time($format = 'short', $timezone = null, $locale = null)

===$format===
FULL, LONG, MEDIUM, SHORT, ATOM, COOKIE, ISO8601, RFC822, RFC850, RFC1036, RFC1123, RFC2822, RFC3339, RSS, W3C
(not case-insensitive)

or date/datetime formats, like Y/m/d or YYYY/mm/dd



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
