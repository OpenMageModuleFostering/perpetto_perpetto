<?php

/**
 * Class Perpetto_Perpetto_Block_Adminhtml_System_Config_Form_Campaigns
 */
class Perpetto_Perpetto_Block_Adminhtml_System_Config_Form_Campaigns extends Perpetto_Perpetto_Block_Adminhtml_System_Config_Form_Abstract
{
    /**
     * @var Perpetto_Perpetto_Model_Resource_Slot_Collection
     */
    protected $_campaigns;

    /**
     * Init
     */
    protected function _construct()
    {
        parent::_construct();

        $this->setTemplate('perpetto/adminhtml/system/config/form/campaigns.phtml');

        // @TODO: calls the API every time
        try {
            Mage::helper('perpetto/api')->updateEmailCampaigns();
        } catch (Exception $e) {
            Mage::log($e);
        }
    }

    /**
     * Retrieve slots grouped by page
     *
     * @return array
     */
    public function getEmailCampaigns()
    {
        $helper = Mage::helper('perpetto');
        $campaigns = $helper->getEmailCampaigns();

        return $campaigns;
    }

    /**
     * @return string
     */
    public function getDashboardUrl()
    {
        $url = Mage::helper('perpetto/url')->getEmailCampaignsDashboardUrl();

        return $url;
    }

    /**
     * @return string
     */
    public function getContactsUrl()
    {
        $url = Mage::helper('perpetto/url')->getContactsUrl();

        return $url;
    }

    /**
     * @return string
     */
    public function getBillingUrl()
    {
        $url = Mage::helper('perpetto/url')->getBillingUrl();

        return $url;
    }

    /**
     * @return string
     */
    public function getEmailCampaignsUrl()
    {
        $url = Mage::helper('perpetto/url')->getEmailCampaignsUrl();

        return $url;
    }

    /**
     * @param $campaignId
     * @param $emailId
     * @return string
     */
    public function getEmailCampaignTestUrl($campaignId, $emailId)
    {
        $url = $this->getUrl('*/perpetto_campaigns/test', array('campaign' => $campaignId, 'email' => $emailId));

        return $url;
    }

    /**
     * @return bool
     */
    public function showCampaigns()
    {
        $showSlots = Mage::helper('perpetto')->isActive();

        return $showSlots;
    }

    /**
     * @return bool
     */
    public function showLinks()
    {
        $showLinks = Mage::helper('perpetto')->isActive();

        return $showLinks;
    }

    /**
     * @return string
     */
    public function getBillingTitle()
    {
        $helper = Mage::helper('perpetto');
        $title = 'Billing Information';

        if ($helper->isTrial()) {
            $days = $helper->getTrialDaysLeft();
            $title = $this->__('Free Trial (%d Day%s Left)', $days, $days != 1 ? 's' : '');
        }

        return $title;
    }

    /**
     * @return string
     */
    public function getBillingText()
    {
        $helper = Mage::helper('perpetto');
        $text = $helper->isTrial()
            ? 'Don\'t forget to add your billing information before the trial ends.'
            : 'You can see your current bill and the forecast for this month.';

        return $text;
    }

    /**
     * @return string
     */
    public function getBillingButtonText()
    {
        $helper = Mage::helper('perpetto');
        $text = $helper->isTrial()
            ? 'Add Billing Information Securely'
            : 'Check Current Bill';

        return $text;
    }

}
