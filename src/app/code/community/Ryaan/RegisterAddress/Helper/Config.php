<?php

class Ryaan_RegisterAddress_Helper_Config
{
    /**
     * @var string
     */
    const REQUIRE_ADDRESS = 'customer/create_account/require_address';

    /**
     * @return bool
     */
    public function isAddressRequired()
    {
        return Mage::getStoreConfigFlag(self::REQUIRE_ADDRESS);
    }

}
