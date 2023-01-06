<?php

namespace SamedayCourier\Shipping\Block\Sales\Order;

use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Template;
use SamedayCourier\Shipping\Helper\StoredDataHelper;

class Fee extends Template
{
    private ?StoredDataHelper $storedDataHelper;

    public function __construct(
        StoredDataHelper $storedDataHelper,
        Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);

        $this->storedDataHelper = $storedDataHelper;
    }

    public function initTotals(): self
    {
        $parent = $this->getParentBlock();
        $order = $parent->getOrder();

        $fee = new DataObject(
            [
                'code'=> 'fee',
                'strong'=> false,
                'value'=> $order->getSamedaycourierFee(),
                'label'=> __($this->storedDataHelper->getRepaymentFeeLabel()),
            ]
        );

        $parent->addTotal($fee, 'fee');

        return $this;
    }
}
