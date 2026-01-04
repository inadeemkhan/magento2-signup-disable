<?php
namespace DevScripts\SignupDisable\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;

class Message extends Template
{
    private const XML_ENABLE        = 'signup_disable/general/enable';
    private const XML_MESSAGE       = 'signup_disable/general/message';
    private const XML_SHOW_LOGIN    = 'signup_disable/general/show_login_button';
    private const XML_SHOW_HOME     = 'signup_disable/general/show_home_button';

    protected ScopeConfigInterface $scopeConfig;

    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->scopeConfig = $scopeConfig;
    }

    public function isSignupDisabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_ENABLE,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getMessage(): string
    {
        return (string) $this->scopeConfig->getValue(
            self::XML_MESSAGE,
            ScopeInterface::SCOPE_STORE
        ) ?: __('Customer registration is currently disabled.');
    }

    public function canShowLogin(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_SHOW_LOGIN,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function canShowHome(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_SHOW_HOME,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function getLoginUrl(): string
    {
        return $this->getUrl('customer/account/login');
    }

    public function getHomeUrl(): string
    {
        return $this->getUrl('');
    }
}