<?php
/**
 * SEPA file generator.
 *
 * @copyright © Digitick <www.digitick.net> 2012-2013
 * @copyright © Blage <www.blage.net> 2013
 * @license GNU Lesser General Public License v3.0
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Lesser Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

class TransferFileFacadeFactory
{
    /**
     * @param string $uniqueMessageIdentification
     * @param string $initiatingPartyName
     * @param string $painFormat
     *
     * @return CustomerDirectDebitFacade
     */
    public static function createDirectDebit($uniqueMessageIdentification, $initiatingPartyName, $painFormat = 'pain.008.002.02')
    {
        $groupHeader = new GroupHeader($uniqueMessageIdentification, $initiatingPartyName);
        $directDebitTransferFile = new CustomerDirectDebitTransferFile($groupHeader);
        $domBuilder = new CustomerDirectDebitTransferDomBuilder($painFormat);

        return new CustomerDirectDebitFacade($directDebitTransferFile, $domBuilder);
    }

    /**
     * @param string $uniqueMessageIdentification
     * @param string $initiatingPartyName
     * @param string $painFormat
     *
     * @return CustomerCreditFacade
     */
    public static function createCustomerCredit($uniqueMessageIdentification, $initiatingPartyName, $painFormat = 'pain.001.002.03')
    {
        $groupHeader = new GroupHeader($uniqueMessageIdentification, $initiatingPartyName);
        $directDebitTransferFile = new CustomerCreditTransferFile($groupHeader);
        $domBuilder = new CustomerCreditTransferDomBuilder($painFormat);

        return new CustomerCreditFacade($directDebitTransferFile, $domBuilder);
    }
}