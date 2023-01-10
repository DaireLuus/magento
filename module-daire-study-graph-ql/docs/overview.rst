Overview
========

## **Installation**
1. Composer Installation
      - Navigate to your Magento root folder<br />
            `cd path_to_the_magento_root_directory`
      - Then run the following command<br />
            `composer require "lumav/module-outdatedbrowser-graph-ql:dev-master"`
      - Make sure that composer finished the installation without errors

 2. Command Line Installation
      - Backup your web directory and database.
      - Download the latest Cron Scheduler installation package
            `cd path_to_the_magento_root_directory`<br />
      - Upload contents of the Cron Scheduler installation package to your Magento root directory
      - Then run the following command<br />
            `php bin/magento module:enable Lumav_OutDatedBrowserGraphQl`<br />

- After install the extension, run the following command
```
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
php bin/magento cache:flush
```
- Log out from the backend and login again.


