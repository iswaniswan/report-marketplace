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
        $value =  preg_replace('/[\'"\\%]+/', '', $value);
        return trim($value);
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
        $numericValue = preg_replace('/[^\d.]/', '', $input);
        return (float)$numericValue;
    }

    public static function sanitizeCurrencyAbs($input) {
        // Remove non-numeric characters except for period and leading minus sign
        $numericValue = preg_replace('/(?!^-)[^\d.]/', '', $input);
        return (float)$numericValue;
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

    public static function trimDateToMonthToDay($dateString, $excludeDays=[])
    {
        $date = strtotime($dateString);
        $day = date('d', $date);
        
        // If the date is the first or last day of the month, include the month abbreviation.
        if ($day === '01' || $day === date('t', $date) || in_array($day, $excludeDays)) {
            return date('M d', $date);
        }
    
        // Otherwise, just return the day.
        return $day;
    }

    public static function toCamelCase($string) {
        // Convert the string to lowercase and split it by spaces
        $words = explode(' ', strtolower($string));
        
        // Capitalize the first letter of each word except the first one
        $words = array_map(function ($word, $index) {
            return $index === 0 ? $word : ucfirst($word);
        }, $words, array_keys($words));
        
        // Join the words back together
        return implode('', $words);
    }    

    public static function intToMonth($month) {
        $month = (int) $month;
        $months = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug',
            9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
        ];
        return $months[$month];
    }

}
