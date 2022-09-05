<?php
namespace Pdf\Attachment\Helper;

use Magento\Framework\App\Area;

/**
 * Class Emailreport
 * @package Pdf\Attachment\Helper
 */
class Emailreport extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var \Magento\Framework\Translate\Inline\StateInterface
     */
    private $inlineTranslation;
    /**
     * @var \Magento\Framework\Mail\Template\TransportBuilder
     */
    private $transportBuilder;
    /**
     * @var \Magento\Framework\Filesystem\Directory\Read
     */
    private $reader;

    /**
     * Emailreport constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
     * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
     * @param \Magento\Framework\Filesystem\Driver\File $reader
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Filesystem\Driver\File $reader
    ) {
        parent::__construct($context);
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $inlineTranslation;
        $this->transportBuilder = $transportBuilder;
        $this->reader = $reader;
    }

    /**
     * @param $path
     * @param $storeId
     * @return mixed
     */
    public function getConfigValue($path, $storeId)
    {
        return $this->scopeConfig->getValue(
            $path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @return \Magento\Store\Api\Data\StoreInterface
     */
    public function getStore()
    {
        return $this->storeManager->getStore();
    }

    /**
     * @param $template
     * @param $senderInfo
     * @param $receiverInfo
     * @param array $templateParams
     * @param null $pdfFile
     * @return $this
     */
    public function sendEmailReport(
        $template,
        $senderInfo,
        $receiverInfo,
        $templateParams = [],
        $pdfFile = null
    ) {
        $this->inlineTranslation->suspend();
        $templateId = $this->getConfigValue($template, $this->getStore()->getStoreId());
        if ($pdfFile) {
            $transport = $this->transportBuilder->setTemplateIdentifier($templateId)
                ->setTemplateOptions(
                    [
                        'area' => Area::AREA_FRONTEND,
                        'store' => $this->getStore()->getId(),
                    ]
                )
                ->setTemplateVars($templateParams)
                ->setFrom($senderInfo)
                ->addTo($receiverInfo['email'], $receiverInfo['name'])
                ->addAttachment($this->reader->fileGetContents($pdfFile), 'Credit Application')
                ->getTransport();
        } else {
            $transport = $this->_transportBuilder->setTemplateIdentifier($templateId)
                ->setTemplateOptions(
                    [
                        'area' => Area::AREA_FRONTEND,
                        'store' => $this->getStore()->getId(),
                    ]
                )
                ->setTemplateVars($templateParams)
                ->setFrom($senderInfo)
                ->addTo($receiverInfo['email'], $receiverInfo['name'])
                ->getTransport();
        }
        $transport->sendMessage();
        $this->inlineTranslation->resume();

        return $this;
    }
}
