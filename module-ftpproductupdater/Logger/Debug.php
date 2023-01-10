<?php
/**
 * Copyright © Lumav Commerce OÜ. All rights reserved.
 */

namespace Lumav\Home4YouFtpProductUpdater\Logger;

use Lumav\Home4YouFtpProductUpdater\Model\Config;
use Magento\Framework\Filesystem\DriverInterface;

/**
 * Class Debug
 */
class Debug extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * Logging level
     * @var int
     */
    protected $loggerType = \Monolog\Logger::DEBUG;

    /**
     * Logging level
     * @var int
     */
    protected $level = \Monolog\Logger::DEBUG;

    /**
     * File name
     * @var string
     */
    protected $fileName = '/var/log/Home4YouFtpProductUpdater/ftpProductUpdater_debug.log';

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * {@inheritdoc}
     */
    public function isHandling(array $record)
    {
        return $record['level'] === $this->level;
    }


    /**
     * Debug constructor.
     * @param Configuration $config
     * @param DriverInterface $filesystem
     * @param null $filePath
     * @param null $fileName
     * @throws \Exception
     */
    public function __construct(
        Config $config,
        DriverInterface $filesystem,
        $filePath = null,
        $fileName = null
    )
    {
        $this->config = $config;
        parent::__construct($filesystem, $filePath, $fileName);
    }

    /**
     * @param array $record
     */
    public function write(array $record)
    {
        if($this->config->isDebugEnabled()) {
            parent::write($record);
        }
    }
}