<?php
/**
 * The Clickatell SMS Library provides a standardised way of talking to and
 * receiving replies from the Clickatell API's.
 *
 * PHP Version 5.3
 *
 * @package  Clickatell
 * @author   Chris Brand <chris@cainsvault.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/arcturial
 */

namespace Clickatell;

/**
 * This interface defines the required function for Transport handlers.
 * It also specifies the supported API calls.
 *
 * @package  Clickatell
 * @author   Chris Brand <chris@cainsvault.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/arcturial
 */
interface TransportInterface
{
    /**
     * API call for "sendMessage".
     *
     * Response format:
     *      id      => string|false
     *      to      => string
     *      error   => string|false
     *      code    => string|false
     *
     * @param array $to The recipient list
     * @param string $message Message
     * @param array $extra Extra parameters (based on Clickatell documents)
     *
     * @return array
     */
    public function sendMessage($to, $message, $extra = []);

    /**
     * API call for "getBalance".
     *
     * Response format:
     *      balance => int
     *
     * @return int
     * @throws Exception
     *
     */
    public function getBalance();

    /**
     * API call for "stop message".
     *
     * @param string $apiMsgId ApiMsgId to query
     *
     * @return mixed
     * @throws Exception
     *
     */
    public function stopMessage($apiMsgId);

    /**
     * API call for "queryMsg".
     *
     * @param string $apiMsgId ApiMsgId to query
     *
     * @return mixed
     * @throws Exception
     *
     */
    public function queryMessage($apiMsgId);

    /**
     * API call for "routeCoverage".
     *
     * @param int $msisdn Number to check for coverage
     *
     * @return mixed
     * @throws Exception
     *
     */
    public function routeCoverage($msisdn);

    /**
     * API call for "getMsgCharge".
     *
     * @param string $apiMsgId ApiMsgId to query
     *
     * @return mixed
     * @throws Exception
     *
     */
    public function getMessageCharge($apiMsgId);
}
