<?php
namespace Pdf\Attachment\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Pdf\AttachmentHelper\Emailreport;
use Magento\Framework\Filesystem;

/**
 * Class CreditEmail
 * @package Pdf\Attachment\Block
 */
class CreditEmail extends Template
{
    /* A constant is declared with custom field in admin created using system.xml */

    const XML_PATH_CUSTOM_EMAIL_TEMPLATE= 'sales_email/pdf_accounting/customer_credit_email';   // section_id/group_id/field_id

    /**
     * @var Emailreport
     */
    private $emailReport;
    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @param Context $context
     * @param Emailreport $emailReport
     * @param Filesystem $fileSystem
     * @param array $data
     */
    public function __construct(
        Context $context,
        Emailreport $emailReport,
        Filesystem $fileSystem,
        array $data = []
    ){
        $this->emailReport = $emailReport;
        $this->fileSystem = $fileSystem;
        parent::__construct($context, $data);
    }

    /**
     * @return $this
     */
    public function sendEmailReport()
    {
        /* Sender Detail */
        $senderInfo = [
            'name' => 'sender',
            'email' => 'sender@domain.com'
        ];

        /* Receiver Detail */
        $receiverInfo = [
            'name' => 'receiver',
            'email' => 'receiver@domain.com'
        ];

        /* To assign the values to template variables */

        $customerName = $receiverInfo['name'];
        $customerEmail = $receiverInfo['email'];

        $customerDetails = [];
        $customerDetails['name'] = $customerName;
        $customerDetails['email'] = $customerEmail;

        /* The Pdf file path has to be assigned to the variable for the email attachment*/

        $mediaPath = $this->fileSystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)
            ->getAbsolutePath();
        $pdf_file = $mediaPath.'pdfFileName.pdf';

        $this->emailReport->sendEmailReport(
            self::XML_PATH_CUSTOM_EMAIL_TEMPLATE,
            $senderInfo,
            $receiverInfo,
            $customerDetails,
            $pdf_file
        );
    }
}
