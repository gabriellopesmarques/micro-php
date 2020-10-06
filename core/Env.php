<?php

namespace Core;

class Env
{
    /**
     * load environment variables from file,
     * you can use the function getenv to get
     * environment variables. ex.: getenv("TIMEZONE")
     *
     * @param   string  $envPath       file path
     * @param   array   $requiredVars  list of required var
     *
     * @return  null
     */
    public static function load($envPath, $requiredVars = [])
    {
        if (!file_exists($envPath)) {
            return false;
        }

        $env = file_get_contents($envPath);
        $lines = preg_split('/\n/', $env);

        foreach ($lines as $line) {
            $env = self::parseLine($line);

            if (!is_null($env)) {
                putenv($env);
            }
        }

        self::checkRequiredVars($requiredVars);
    }

    private static function checkRequiredVars($requiredVars)
    {
        foreach ($requiredVars as $var) {
            if (getenv($var) === false) {
                die($var . ' is required in .env file');
            }
        }
    }

    private static function parseLine($line)
    {
        $line = self::removeComments($line);
        $keyValue = explode('=', $line);

        if (isset($keyValue[0]) && isset($keyValue[1])) {
            return $keyValue[0] . '=' . self::trimQuotationMarks($keyValue[1]);
        }
        return null;
    }

    private static function trimQuotationMarks($text)
    {
        $text = trim($text, '"');
        return trim($text, "'");
    }

    private static function removeComments($line)
    {
        return preg_replace('/(\s+)?#.*+/', '', $line);
    }
}
