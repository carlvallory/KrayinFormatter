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
        $thousandSeparator = $this->getConfigData('general.general.formatting.thousand_separator');

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

    /**
     * Format date
     *
     * @param  string  $date
     * @param  string  $format
     * @return string
     */
    public function formatDate($date, $format = 'd M Y h:iA')
    {
        // Get configured date format from package config
        $configuredFormat = $this->getConfigData('general.general.formatting.date_format');

        // Use configured format if available, otherwise fall back to default
        if ($configuredFormat) {
            // Apply configured format
            if ($format === 'd M Y h:iA') {
                 $format = $configuredFormat . ' h:iA'; 
            }
        }

        return \Carbon\Carbon::parse($date)->format($format);
    }

    /**
     * Retrieve all timezones with Automatic option.
     *
     * @return array
     */
    public function timezones(): array
    {
        $options = [];

        // Add Automatic Option
        $options[] = [
            'title' => trans('krayin-formatter::app.formatting.options.automatic'),
            'value' => 'auto',
        ];

        // Add System Timezones
        foreach (timezone_identifiers_list() as $timezone) {
            $options[] = [
                'title' => $timezone,
                'value' => $timezone,
            ];
        }

        return $options;
    }
    /**
     * Get the base currency code from config.
     *
     * @return string
     */
    public function getBaseCurrencyCode()
    {
        return config('app.currency');
    }
}
