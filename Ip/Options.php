<?php
/**
 * @package ImpressPages

 *
 */

namespace Ip;


/**
 * Website options storage
 *
 * @package Ip
 */
class Options
{

    /**
     * Get option value
     * @param string $key Option key
     * @param null $defaultValue A value to return if the option is not set
     * @return string Option value
     * @throws Exception
     */
    public function getOption($key, $defaultValue = null)
    {
        $parts = explode('.', $key, 2);
        if (!isset($parts[1])) {
            throw new \Ip\Exception("Option key must have plugin name separated by dot.");
        }
        return \Ip\ServiceLocator::storage()->get('Config', $parts[0] . '.' . $parts[1], $defaultValue);
    }


    /**
     * Get language specific option value
     * @param string $key Option key
     * @param int $languageId Language ID
     * @param null $defaultValue A value to return if the option is not set
     * @return string Option value
     * @throws Exception
     */
    public function getOptionLang($key, $languageId, $defaultValue = null)
    {
        $parts = explode('.', $key, 2);
        if (!isset($parts[1])) {
            throw new \Ip\Exception("Option key must have plugin name separated by dot.");
        }

        $answer = \Ip\ServiceLocator::storage()->get('Config', $parts[0] . '.' . $languageId . '.' . $parts[1]);
        if ($answer === null) {
            $answer = ipGetOption($key, $defaultValue);
        }
        return $answer;
    }

    /**
     * Set CMS specific option
     * @param string $key Option key
     * @param $value Option value
     * @throws Exception
     */
    public function setOption($key, $value)
    {
        $parts = explode('.', $key, 2);
        if (!isset($parts[1])) {
            throw new \Ip\Exception("Option key must have plugin name separated by dot.");
        }
        \Ip\ServiceLocator::storage()->set('Config', $parts[0] . '.' . $parts[1], $value);
    }

    /**
     * Set language specific option
     * @param string $key Option key
     * @param int $languageId Language ID
     * @param $value Option value
     * @throws Exception
     */
    public function setOptionLang($key, $languageId, $value)
    {
        $parts = explode('.', $key, 2);
        if (!isset($parts[1])) {
            throw new \Ip\Exception("Option key must have plugin name separated by dot.");
        }
        \Ip\ServiceLocator::storage()->set('Config', $parts[0] . '.' . $languageId . '.' . $parts[1], $value);
    }


    /**
     * Remove option
     * @param string $key Option key
     * @throws Exception
     */
    public function removeOption($key)
    {
        $parts = explode('.', $key, 2);
        if (!isset($parts[1])) {
            throw new \Ip\Exception("Option key must have plugin name separated by dot.");
        }
        \Ip\ServiceLocator::storage()->remove('Config', $parts[0] . '.' . $parts[1]);
    }

    /**
     * Remove language specific option
     * @param string $key Option key
     * @param int $languageId Language ID
     * @throws Exception
     */
    public function removeOptionLang($key, $languageId)
    {
        $parts = explode('.', $key, 2);
        if (!isset($parts[1])) {
            throw new \Ip\Exception("Option key must have plugin name separated by dot.");
        }
        \Ip\ServiceLocator::storage()->remove('Config', $parts[0] . '.' . $languageId . '.' . $parts[1]);
    }



    /**
     * Import options form JSON file
     *
     * @param string $configFile File name to import
     * @throws Exception
     */
    public function import($configFile)
    {
        $content = file_get_contents($configFile);
        $values = json_decode($content, true);
        if (!is_array($values)) {
            throw new \Ip\Exception("Can't parse configuration file: " . $configFile);
        }
        foreach ($values as $key => $value) {
            ipSetOption($key, $value);
        }
    }

    /**
     * Get all web site options
     *
     * @return array Configuration options
     */
    function getAllOptions()
    {
        $optionValues = \Ip\ServiceLocator::storage()->getAll('Config');
        $options = array();
        foreach ($optionValues as $option) {
            $options[$option['key']] = $option['value'];
        }
        return $options;
    }
}