<?php
/**
 * General payment config representation injected for HgwMainConfigInterface.
 *
 * @license Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 * @copyright Copyright © 2016-present heidelpay GmbH. All rights reserved.
 *
 * @link  http://dev.heidelpay.com/
 *
 * @author  Simon Gabriel <development@heidelpay.com>
 *
 * @package  heidelpay/magento2
 */
namespace Heidelpay\Gateway\Gateway\Config;

use Heidelpay\Gateway\Traits\DumpGetterReturnsTrait;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class HgwMainConfig implements HgwMainConfigInterface
{
    use DumpGetterReturnsTrait;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var string
     */
    private $pathPattern;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param string $pathPattern
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        $pathPattern = HgwMainConfigInterface::DEFAULT_PATH_PATTERN
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->pathPattern = $pathPattern;
    }

    /**
     * Retrieve config value by path and scope.
     *
     * @param $parameter
     * @return mixed
     */
    private function getValue($parameter)
    {
        return $this->scopeConfig->getValue($this->pathPattern . $parameter, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Retrieve config flag by path and scope
     *
     * @param $parameter
     * @return bool
     */
    private function isSetFlag($parameter)
    {
        return (bool) $this->scopeConfig->isSetFlag($this->pathPattern . $parameter, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Returns true if the sandbox mode is enabled.
     *
     * @return bool
     */
    public function isSandboxModeActive()
    {
        return $this->isSetFlag(HgwMainConfigInterface::FLAG_SANDBOXMODE);
    }

    /**
     * Returns true if the payment plugin is enabled.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->isSetFlag(HgwMainConfigInterface::FLAG_ACTIVE);
    }

    /**
     * Returns the security sender property from config.
     *
     * @return mixed
     */
    public function getSecuritySender()
    {
        return $this->getValue(HgwMainConfigInterface::CONFIG_SECURITY_SENDER);
    }

    /**
     * Returns the user login property from config.
     *
     * @return mixed
     */
    public function getUserLogin()
    {
        return $this->getValue(HgwMainConfigInterface::CONFIG_USER_LOGIN);
    }

    /**
     * Returns the user password property from config.
     *
     * @return mixed
     */
    public function getUserPasswd()
    {
        return $this->getValue(HgwMainConfigInterface::CONFIG_USER_PASSWD);
    }

    /**
     * Returns the default css path property from config.
     *
     * @return mixed
     */
    public function getDefaultCss()
    {
        return $this->getValue(HgwMainConfigInterface::CONFIG_DEFAULT_CSS);
    }

    /**
     * Returns the abstract payment model from config.
     *
     * @return mixed
     */
    public function getConfigModel()
    {
        return $this->getValue(HgwMainConfigInterface::CONFIG_MODEL);
    }

    /**
     * @return ScopeConfigInterface
     */
    public function getScopeConfig()
    {
        return $this->scopeConfig;
    }
}
