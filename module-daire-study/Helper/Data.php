<?php

namespace Lumav\DaireStudy\Helper;

/**
 * @category  Lumav
 * @package   Lumav_OutdatedBrowser
 * @copyright @copyright Copyright (c) 2020 Lumav OÜ (http://www.lumav.com)
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var string
     */
    const XML_PATH_ENABLED = 'outdated_browser/general/enabled';

    /**
     * @var string
     */
    const XML_PATH_DEBUG = 'outdated_browser/general/debug';

    /**
     * @var string
     */
    const XML_PATH_MIN_VERSIONS = 'outdated_browser/general/min_versions';

    /**
     * @var string
     */
    const XML_PATH_REMIND_AFTER = 'outdated_browser/general/remind_after';

    /**
     * @var string
     */
    const XML_PATH_REDIRECT_URL = 'outdated_browser/general/redirect_url';

    /**
     * @var string
     */
    const XML_PATH_OPEN_NEW_WINDOW = 'outdated_browser/general/open_new_window';

    /**
     * @var string
     */
    const XML_PATH_CUSTOM_NOTIFICATION_TEXT = 'outdated_browser/general/custom_notification_text';

    /**
     * @var string
     */
    const XML_PATH_LANGUAGE = 'outdated_browser/general/language';
/**
     * @var string
     */
    const XML_PATH_TESTID = 'daire/general/testID';
/**
     * @var string
     */
    const XML_PATH_DAIREVIN = 'daire/general/daireVIN';
/**
     * @var string
     */
    const XML_PATH_PERSONALVIN = 'daire/general/personalVIN';    
    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(\Magento\Framework\App\Helper\Context $context)
    {
        parent::__construct($context);
    }

    /**
     * Allow notification displayment
     *
     * @return bool
     */
    public function getIsEnabled()
    {
        return $this->getStoreConfigFlag(self::XML_PATH_ENABLED);
    }

    /**
     * Show debug information when allowed
     * When allowed, notification will be displayed at all times
     *
     * @return bool
     */
    public function getIsDebugMode()
    {
        return $this->getStoreConfigFlag(self::XML_PATH_DEBUG);
    }

    /**
     * Get min. browser versions that should not be notified. Versions lower than defined will be notified.
     *
     * @return string
     */
    public function getMinVersions()
    {
        $minVersions = $this->getStoreConfig(self::XML_PATH_MIN_VERSIONS);
        if ($minVersions) {
            // replace new line characters with commas
            $minVersions = preg_replace('#\s+#', ',', trim($minVersions));
        }

        return (string) $minVersions;
    }

    /**
     * Get remind after value which defines when user should be notified again
     *
     * @return int
     */
    public function getRemindAfter()
    {
        return (int) $this->getStoreConfig(self::XML_PATH_REMIND_AFTER);
    }

    /**
     * Return redirect URL for the user
     * URL will redirect user to browser update website
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        return (string) $this->getStoreConfig(self::XML_PATH_REDIRECT_URL);
    }

    /**
     * Open redirect URL in new window/tab when allowed
     *
     * @return bool
     */
    public function getOpenInNewWindow()
    {
        return $this->getStoreConfigFlag(self::XML_PATH_OPEN_NEW_WINDOW);
    }

    /**
     * Get custom notification text
     *
     * @return string
     */
    public function getCustomNotificationText()
    {
        return (string) $this->getStoreConfig(self::XML_PATH_CUSTOM_NOTIFICATION_TEXT);
    }

    /**
     * Get language code
     * Supports automatic detection
     *
     * @return string
     */
    public function getLanguage()
    {
        $lang = $this->getStoreConfig(self::XML_PATH_LANGUAGE);
        if (!$lang) {
            $locale = $this->getStoreConfig(\Magento\Directory\Helper\Data::XML_PATH_DEFAULT_LOCALE);
            $lang   = substr($locale, 0, 2);
        }

        return $lang;
    }

    /**
     * Get store config value
     *
     * @param  string $xpath
     * @return mixed
     */
    public function getStoreConfig($xpath)
    {
        return $this->scopeConfig->getValue($xpath, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get store config flag
     *
     * @param  string $xpath
     * @return bool
     */
    public function getStoreConfigFlag($xpath)
    {
        return $this->scopeConfig->isSetFlag($xpath, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    public function getTestID()
    {
        return (string) $this->getStoreConfig(self::XML_PATH_TESTID);
    }
    public function getDaireVIN()
    {
        return (string) $this->getStoreConfig(self::XML_PATH_DAIREVIN);
    }
    public function getPersonalVIN()
    {
        return (string) $this->getStoreConfig(self::XML_PATH_PERSONALVIN);
    }
}
