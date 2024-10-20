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
}
