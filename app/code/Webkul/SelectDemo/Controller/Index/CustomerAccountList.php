<?php
/**
* Webkul Software.
*
* @category  Webkul
* @package   Webkul_SelectDemo
* @author    Webkul
* @copyright Webkul Software Private Limited (https://webkul.com)
* @license   https://store.webkul.com/license.html
*/

namespace Webkul\SelectDemo\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;

class CustomerAccountList extends \Magento\Framework\App\Action\Action
{
    /**
     * @var ResultFactory
     */
    protected $_resultFactory;

    /**
     * @var array
     */
    protected $results = [];

    /**
     * @var int
     */
    private $resultsCount;

    /**
     * Object initialization.
     *
     * @param Context $context
     * @param \Magento\Customer\Model\CustomerFactory $customerFactory
     * @param \Magento\Framework\Controller\ResultFactory $resultFactory
     */
    public function __construct(
        Context $context,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Framework\Controller\ResultFactory $resultFactory
    ) {
        $this->_resultFactory  = $resultFactory;
        $this->customerFactory = $customerFactory;
        parent::__construct($context);
    }

    /**
     * Executes request and return json data
     * @return json
     */
    public function execute()
    {
        $returnArray            = [];
        $returnArray["success"] = false;
        $returnArray["message"] = "";
        $resultJson             = $this->_resultFactory->create(ResultFactory::TYPE_JSON);
        $wholeData              = $this->getRequest()->getParams();

        if ($wholeData) {
            try {
                $query       = "";
                $pageSize    = 10;
                $pageNumber  = $wholeData["page"] ?? 1;
                $query       = trim($wholeData["q"] ?? "");
                    
                $customerList = [];
                $customerList = $this->getCustomers($query, $pageSize, $pageNumber);
                        
                $returnArray["success"]    = true;
                $returnArray["results"]    = $customerList;
                $returnArray["totalCount"] = $this->resultsCount;
                $noOfPages = ($this->resultsCount > 0)?$this->resultsCount/$pageSize : 1;
                $returnArray["noOfPages"]  = ceil($noOfPages);
                    
                $resultJson->setData($returnArray);
                return $resultJson;
            } catch (\Exception $e) {
                $returnArray["message"] = $e->getMessage();
                $resultJson->setData($returnArray);
                return $resultJson;
            }
        } else {
            $returnArray["message"] = __("Invalid Request");
            $resultJson->setData($returnArray);
            return $resultJson;
        }
    }

    /**
     * get customers
     * @param string $query
     * @param int $pageSize
     * @param int $pageNumber
     * @return array
     */
    public function getCustomers($query = "", $pageSize = 20, $pageNumber = 1)
    {
        try {
            $customers = $this->customerFactory->create()
                ->getCollection()
                ->addAttributeToSelect('*');
                
            if (!empty($query)) {
                $customers->addAttributeToFilter(
                    [
                        ["attribute"=>"firstname", "like"=>'%'.$query.'%'],
                        ["attribute"=>"email",  "like"=>'%'.$query.'%'],
                        ["attribute"=>"lastname",  "like"=>'%'.$query.'%']
                    ]
                );
            }
            $this->resultsCount = $customers->count();
            if ($customers) {
                $customers->setPageSize($pageSize)->setCurPage($pageNumber);
            }
            $customers->getSelect()
                ->reset(\Zend_Db_Select::COLUMNS)
                ->columns(['entity_id', 'email', 'firstname', 'lastname']);
            $customers->getSelect()->reset(\Zend_Db_Select::ORDER);
            $customers->getSelect()->order("email", "DESC");
            
            $data = (!empty($customers)) ? $customers->getData() : [];

            if (!empty($data)) {
                foreach ($data as $index => $value) {
                    $result          = [];
                    $fullname = ($value["firstname"] ?? "")." ".($value["lastname"] ?? "");
                    $result["id"]    = $value["email"] ?? "";
                    $result["text"]  = $fullname.' ('. $result["id"] .')';
                    $this->results[] = $result;
                }
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            die("Exception Occurred");
        }
        
        return $this->results;
    }
}
