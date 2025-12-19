<?php

namespace App\Helpers;

class Helper
{
    /**
     * Get the application name
     */
    public static function appName()
    {
        return config('app.name', 'Laravel');
    }

    /**
     * Format price
     */
    public static function formatPrice($amount, $currency = 'AED')
    {
        return number_format($amount, 2) . ' ' . $currency;
    }

    /**
     * Generate random string
     */
    public static function randomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    /**
     * Check if string is JSON
     */
    public static function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * Get current date in format
     */
    public static function currentDate($format = 'Y-m-d')
    {
        return date($format);
    }

    /**
     * Get current time in format
     */
    public static function currentTime($format = 'H:i:s')
    {
        return date($format);
    }

    /**
     * Truncate text
     */
    public static function truncate($text, $length = 100, $ending = '...')
    {
        if (strlen($text) > $length) {
            $text = substr($text, 0, $length) . $ending;
        }
        return $text;
    }

    /**
     * Get user IP address
     */
    public static function getClientIp()
    {
        $ip = request()->ip();

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return $ip;
        }

        return '127.0.0.1';
    }

    /**
     * Sanitize input
     */
    public static function sanitize($input)
    {
        return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Check if route is active
     */
    public static function isActiveRoute($routeName)
    {
        return request()->routeIs($routeName) ? 'active' : '';
    }
}
