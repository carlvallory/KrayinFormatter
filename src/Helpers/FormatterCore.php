<?php

namespace Vallory\KrayinFormatter\Helpers;

use Webkul\Core\Core;

class FormatterCore extends Core
{
    /**
     * Format price with base currency symbol. This method also give ability to encode
     * the base currency symbol and its optional.
     *
     * @param  float  $price
     * @return string
     */
    public function formatBasePrice($price)
    {
        if (is_null($price)) {
            $price = 0;
        }

        // Use 'krayin-formatter' namespace for config
        $thousandSeparator = core()->getConfigData('general.general.formatting.thousand_separator');

        if ($thousandSeparator === 'dot') {
            $formatter = new \NumberFormatter('es', \NumberFormatter::CURRENCY);
        } elseif ($thousandSeparator === 'comma') {
            $formatter = new \NumberFormatter('en', \NumberFormatter::CURRENCY);
        } else {
            // Fallback to default behavior
            $formatter = new \NumberFormatter(app()->getLocale(), \NumberFormatter::CURRENCY);
        }

        return $formatter->formatCurrency($price, config('app.currency'));
    }
}
