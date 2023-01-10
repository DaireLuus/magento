<?php
/**
 * Copyright © Lumav Commerce OÜ. All rights reserved.
 */

namespace Lumav\Home4YouFtpProductUpdater\Logger;

/**
 * Class Info
 */
class Info extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * Logging level
     * @var int
     */
    protected $loggerType = \Monolog\Logger::INFO;

    /**
     * Logging level
     * @var int
     */
    protected $level = \Monolog\Logger::INFO;

    /**
     * File name
     * @var string
     */
    protected $fileName = '/var/log/Home4YouFtpProductUpdater/ftpProductUpdater_info.log';

    /**
     * {@inheritdoc}
     */
    public function isHandling(array $record)
    {
        return $record['level'] === $this->level;
    }
}