<?php
/**
 * Copyright © Lumav Commerce OÜ. All rights reserved.
 */

namespace Lumav\Home4YouFtpProductUpdater\Logger;

/**
 * Class Error
 */
class Error extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * Logging level
     * @var int
     */
    protected $loggerType = \Monolog\Logger::ERROR;

    /**
     * Logging level
     * @var int
     */
    protected $level = \Monolog\Logger::ERROR;

    /**
     * File name
     * @var string
     */
    protected $fileName = '/var/log/Home4YouFtpProductUpdater/ftpProductUpdater_error.log';

    /**
     * {@inheritdoc}
     */
    public function isHandling(array $record)
    {
        return $record['level'] === $this->level;
    }
}