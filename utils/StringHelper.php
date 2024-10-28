<?php

namespace app\utils;

/**
 * StringHelper provides various string utility functions.
 */
class StringHelper
{
    /**
     * Sanitizes a string to be used as a column name.
     * 
     * @param string $header The header string to sanitize.
     * @return string The sanitized column name.
     */
    public static function sanitizeColumnName($header)
    {
        // Convert the header to lowercase
        $header = strtolower($header);

        // Replace spaces and invalid characters with an underscore
        $header = preg_replace('/[^a-z0-9_]+/', '_', $header);

        // Remove any leading or trailing underscores
        return trim($header, '_');
    }

    public static function sanitizeValue($value)
    {
        // Replace spaces and invalid characters with an underscore
        return preg_replace('/[\'"\\%]+/', '', $value);
    }

    public static function getDatesInPeriod($period, $format='Y-m-d')
    {
        // Convert the period to a DateTime object for the first day of the month
        $startDate = new \DateTime($period . '-01');
        
        // Get the last day of the month
        $endDate = clone $startDate;
        $endDate->modify('last day of this month');

        $dates = [];
        // Loop from start date to end date
        while ($startDate <= $endDate) {
            $dates[] = $startDate->format($format); // Use the provided format
            $startDate->modify('+1 day');
        }

        return $dates;
    }

    public static function sanitizeCurrency($input) {
        // Remove non-numeric characters except for period
        $numericValue = preg_replace('/[^\d]/', '', $input);
        return (int)$numericValue;
    }

    public static function sanitizeCurrencyAbs($input) {
        // Remove non-numeric characters except for period and leading minus sign
        $numericValue = preg_replace('/(?!^-)[^\d]/', '', $input);
        return (int)$numericValue;
    }

    public static function camelToSnakeCase($input) {
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $input));
    }   
    
    public static function truncateString($string, $maxLength = 64, $suffix = '')
    {
        if (strlen($string) > $maxLength) {
            return substr($string, 0, $maxLength) . $suffix;
        }
        return $string;
    }


}
