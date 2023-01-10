<?php

namespace Lumav\DaireStudy\Block;

use Lumav\DaireStudy\Helper\Data;
use Magento\Framework\Json\Helper\Data as Json;
use Magento\Framework\View\Element\Template\Context;

/**
 * @category  Lumav
 * @package   Lumav_OutdatedBrowser
 * @copyright Copyright (c) 2020 Lumav OÜ (http://www.lumav.com)
 */
class Notification extends \Magento\Framework\View\Element\Template
{
    /**
     * Helper instance
     *
     * @var Data
     */
    protected $_helper = null;

    /**
     * Json helper instance
     *
     * @var JsonHelper
     */
    protected $_jsonHelper = null;

    /**
     * @param Context $context
     * @param Data $catalogData
     * @param array $data
     */
    public function __construct(Context $context, Data $helper, Json $jsonHelper, array $data = [])
    {
        $this->_helper     = $helper;
        $this->_jsonHelper = $jsonHelper;
        parent::__construct($context, $data);
    }

    /**
     * Determines whether the notification displayment is allowed or not
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->_helper->getIsEnabled();
    }

    /**
     * Retrieve store specific options for the external script
     *
     * @link https://browser-update.org/customize.html List of possible options
     * @example required: {e:16,f:58,o:51,o_a:45,s:-1,c:"67.0.3396.12",y:18.1,v:"1.10",uc:11.5,samsung:7.0},reminder: 24,l: "lv",url:"http:\/\/outdatedbrowser.com\/",test: true
     * @return string
     */
    public function getJsOptions()
    {
        $jsOptions = array();

        if ($minVersions = $this->_helper->getMinVersions()) {
            $jsOptions[] = 'required: {' . $minVersions . '}';
        }

        $jsOptions[] = 'reminder: ' . $this->_helper->getRemindAfter();

        if ($lang = $this->_helper->getLanguage()) {
            $jsOptions[] = 'l: ' . $this->_jsonHelper->jsonEncode($lang);
        }

        if ($notificationText = $this->_helper->getCustomNotificationText()) {
            $jsOptions[] = 'text: ' . $this->_jsonHelper->jsonEncode($notificationText);
        }

        if ($redirectUrl = $this->_helper->getRedirectUrl()) {
            $jsOptions[] = 'url: ' . $this->_jsonHelper->jsonEncode($redirectUrl);
        }

        $jsOptions[] = 'newwindow: ' . ($this->_helper->getOpenInNewWindow() ? 'true' : 'false');
        $jsOptions[] = 'test: ' . ($this->_helper->getIsDebugMode() ? 'true' : 'false');

        $jsOptions[] = 'domain: ' . $this->_jsonHelper->jsonEncode($this->_getJsLibraryLocation());
        $jsOptions[] = 'media_url: ' . $this->_jsonHelper->jsonEncode($this->_getMediaUrl());

        return implode(',', $jsOptions);
    }

    public function getJsOptionsAsArray() 
    {
        $jsOptions = array();

        if ($minVersions = $this->_helper->getMinVersions()) {
            $jsOptions['required'] =  $minVersions;
        }

        $jsOptions['reminder'] = $this->_helper->getRemindAfter();

        if ($lang = $this->_helper->getLanguage()) {
            $jsOptions['l'] = $lang;
        }

        if ($notificationText = $this->_helper->getCustomNotificationText()) {
            $jsOptions['text'] = $notificationText;
        } else {
            $jsOptions['text'] = "";
        }
        if ($notificationTestID = $this->_helper->getTestID()) {
            $jsOptions['testID'] = $notificationTestID;
        } else {
            $jsOptions['testID'] = "";
        }

        if ($notificationDaireVIN = $this->_helper->getDaireVIN()) {
            $jsOptions['daireVIN'] = $notificationDaireVIN;
        } else {
            $jsOptions['daireVIN'] = "";
        }

        if ($notificationPersonalVIN = $this->_helper->getPersonalVIN()) {
            $jsOptions['personalVIN'] = $notificationPersonalVIN;
        } else {
            $jsOptions['personalVIN'] = "";
        }

        if ($redirectUrl = $this->_helper->getRedirectUrl()) {
            $jsOptions['url'] = $redirectUrl;
        }

        $jsOptions['newwindow'] = $this->_helper->getOpenInNewWindow() ? true : false;
        $jsOptions['test'] = $this->_helper->getIsDebugMode() ? true : false;

        $jsOptions['domain'] = $this->_getJsLibraryLocation();
        $jsOptions['media_url'] = $this->_getMediaUrl();

        return $jsOptions;
    }

    /**
     * Retrieve URL path to JavaScript library
     *
     * @return string
     */
    protected function _getJsLibraryLocation()
    {
        return $this->getViewFileUrl('Lumav_OutdatedBrowser::js');
    }

    /**
     * Retrieve URL path to images
     *
     * @return string
     */
    protected function _getMediaUrl()
    {
        return $this->getViewFileUrl('Lumav_OutdatedBrowser::images');
    }
}
