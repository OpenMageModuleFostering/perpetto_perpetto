<?php

/**
 * Class Perpetto_Perpetto_Adminhtml_Perpetto_CampaignsController
 */
class Perpetto_Perpetto_Adminhtml_Perpetto_CampaignsController extends Mage_Adminhtml_Controller_Action
{

    /**
     * @return $this
     */
    public function testAction()
    {
        $request = $this->getRequest();
        $campaignId = (int) $request->getParam('campaign');
        $emailId = (int) $request->getParam('email');

        $api = Mage::helper('perpetto/api');

        try {
            $api->sendEmailCampaignTestEmail($campaignId, $emailId);
            $this->_getSession()->addSuccess('Test email successfully dispatched.');
        } catch (Exception $e) {
            $message = 'Test email failed: ' . $e->getMessage();
            $this->_getSession()->addError($message);
        }

        $this->_redirect('*/system_config/edit', array('section' => 'perpetto_campaigns'));

        return $this;
    }
}
