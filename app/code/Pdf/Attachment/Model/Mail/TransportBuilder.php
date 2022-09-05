<?php
namespace Pdf\Attachment\Model\Mail;

/**
 * Class TransportBuilder
 * @package Pdf\Attachment\Model\Mail
 */
class TransportBuilder extends \Magento\Framework\Mail\Template\TransportBuilder
{
    /**
     * @param string $pdfString
     * @param string $filename
     * @return mixed
     */
    public function addAttachment($pdfString, $filename)
    {
        If ($filename == '') {
            $filename="attachment";
        }
        $this->message->createAttachment(
            $pdfString,
            'application/pdf',
            \Zend_Mime::DISPOSITION_ATTACHMENT,
            \Zend_Mime::ENCODING_BASE64,
            $filename.'.pdf'
        );
        return $this;
    }
}
