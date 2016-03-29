<?php

namespace Blij\HelperString;

use InvalidArgumentException;

/**
 * Class HplString
 * @package Blij\HelperString
 */
class HplString
{
    /**
     * Строка.
     * @var string
     */
    private $string;

    /**
     * Кодировка.
     * @var string
     */
    private $encoding;

    /**
     * HplString constructor.
     * @param string $string
     * @param string|null $encoding
     */
    public function __construct($string = '', $encoding = null)
    {
        if (!is_string($string)) {
            throw new InvalidArgumentException(sprintf(
                'Передаваемый первый аргумент в %s() должен быть строкой'
                , __METHOD__
            ));
        }

        if (!is_string($encoding) && !is_null($encoding)) {
            throw new InvalidArgumentException(sprintf(
                'Передаваемый второй аргумент в %s() должен быть строкой'
                , __METHOD__
            ));
        }

        $this->string = $string;
        $this->encoding = is_null($encoding) ? mb_internal_encoding() : $encoding;
    }

    /**
     * Возвращает строку.
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     *  Возвращает указанный символ из строки.
     * @param int $index
     * @return mixed
     */
    public function charAt($index)
    {
        if (!is_int($index)) {
            throw new InvalidArgumentException(sprintf(
                'Передаваемый первый аргумент в %s() должен быть числом'
                , __METHOD__
            ));
        }

        return $this->slice($index, 1);
    }

    /**
     * Возвращает длину строки.
     * @return mixed
     */
    public function length()
    {
        return mb_strlen($this->string, $this->encoding);
    }

    /**
     * Извлекает часть строки и возвращает новую строку.
     * @param int $start
     * @param int|null $length
     * @return mixed
     */
    public function slice($start, $length = null)
    {
        if (!is_int($start)) {
            throw new InvalidArgumentException(sprintf(
                'Передаваемый первый аргумент в %s() должен быть числом'
                , __METHOD__
            ));
        }

        if (!is_int($length) && !is_null($length)) {
            throw new InvalidArgumentException(sprintf(
                'Передаваемый второй аргумент в %s() должен быть числом'
                , __METHOD__
            ));
        }

        $string = mb_substr($this->string, $start, $length, $this->encoding);

        return new $this($string, $this->encoding);
    }

    /**
     * Преобразование в нижний регистр.
     * @return mixed
     */
    public function toLowerCase()
    {
        $string = mb_strtolower($this->string, $this->encoding);

        return new $this($string, $this->encoding);
    }

    /**
     * Возвращает строку.
     * @return string
     */
    public function toString()
    {
        return $this->string;
    }

    /**
     * Преобразование в верхний регистр.
     * @return mixed
     */
    public function toUpperCase()
    {
        $string = mb_strtoupper($this->string, $this->encoding);

        return new $this($string, $this->encoding);
    }

    /**
     * Удаляет пробелы (или другие символы) из начала и конца строки.
     * @param string|null $charList
     * @return mixed
     */
    public function trim($charList = null)
    {
        if (!is_string($charList) && !is_null($charList)) {
            throw new InvalidArgumentException(sprintf(
                'Передаваемый первый аргумент в %s() должен быть строкой'
                , __METHOD__
            ));
        }

        if (is_null($charList)) {
            $string = trim($this->string);
        } else {
            $string = trim($this->string, $charList);
        }

        return new $this($string, $this->encoding);
    }

    /**
     * Удаляет пробелы (или другие символы) из начала строки.
     * @param string|null $charList
     * @return mixed
     */
    public function trimLeft($charList = null)
    {
        if (!is_string($charList) && !is_null($charList)) {
            throw new InvalidArgumentException(sprintf(
                'Передаваемый первый аргумент в %s() должен быть строкой'
                , __METHOD__
            ));
        }

        if (is_null($charList)) {
            $string = ltrim($this->string);
        } else {
            $string = ltrim($this->string, $charList);
        }

        return new $this($string, $this->encoding);
    }

    /**
     * Удаляет пробелы (или другие символы) из конца строки.
     * @param string|null $charList
     * @return mixed
     */
    public function trimRight($charList = null)
    {
        if (!is_string($charList) && !is_null($charList)) {
            throw new InvalidArgumentException(sprintf(
                'Передаваемый первый аргумент в %s() должен быть строкой'
                , __METHOD__
            ));
        }

        if (is_null($charList)) {
            $string = rtrim($this->string);
        } else {
            $string = rtrim($this->string, $charList);
        }

        return new $this($string, $this->encoding);
    }
}
