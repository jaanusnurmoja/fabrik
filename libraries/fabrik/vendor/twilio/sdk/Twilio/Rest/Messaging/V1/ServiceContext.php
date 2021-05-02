<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Messaging\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Options;
use Twilio\Rest\Messaging\V1\Service\AlphaSenderList;
use Twilio\Rest\Messaging\V1\Service\PhoneNumberList;
use Twilio\Rest\Messaging\V1\Service\ShortCodeList;
use Twilio\Serialize;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 *
 * @property \Twilio\Rest\Messaging\V1\Service\PhoneNumberList phoneNumbers
 * @property \Twilio\Rest\Messaging\V1\Service\ShortCodeList shortCodes
 * @property \Twilio\Rest\Messaging\V1\Service\AlphaSenderList alphaSenders
 * @method \Twilio\Rest\Messaging\V1\Service\PhoneNumberContext phoneNumbers(string $sid)
 * @method \Twilio\Rest\Messaging\V1\Service\ShortCodeContext shortCodes(string $sid)
 * @method \Twilio\Rest\Messaging\V1\Service\AlphaSenderContext alphaSenders(string $sid)
 */
class ServiceContext extends InstanceContext
{
    protected $_phoneNumbers = null;
    protected $_shortCodes   = null;
    protected $_alphaSenders = null;

    /**
     * Initialize the ServiceContext
     *
     * @param \Twilio\Version $version Version that contains the resource
     * @param string $sid The sid
     * @return \Twilio\Rest\Messaging\V1\ServiceContext
     */
    public function __construct(Version $version, $sid)
    {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['sid' => $sid,];

        $this->uri = '/Services/' . rawurlencode($sid) . '';
    }

    /**
     * Update the ServiceInstance
     *
     * @param array|Options $options Optional Arguments
     * @return ServiceInstance Updated ServiceInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update($options = [])
    {
        $options = new Values($options);

        $data = Values::of([
            'FriendlyName'          => $options['friendlyName'],
            'InboundRequestUrl'     => $options['inboundRequestUrl'],
            'InboundMethod'         => $options['inboundMethod'],
            'FallbackUrl'           => $options['fallbackUrl'],
            'FallbackMethod'        => $options['fallbackMethod'],
            'StatusCallback'        => $options['statusCallback'],
            'StickySender'          => Serialize::booleanToString($options['stickySender']),
            'MmsConverter'          => Serialize::booleanToString($options['mmsConverter']),
            'SmartEncoding'         => Serialize::booleanToString($options['smartEncoding']),
            'ScanMessageContent'    => $options['scanMessageContent'],
            'FallbackToLongCode'    => Serialize::booleanToString($options['fallbackToLongCode']),
            'AreaCodeGeomatch'      => Serialize::booleanToString($options['areaCodeGeomatch']),
            'ValidityPeriod'        => $options['validityPeriod'],
            'SynchronousValidation' => Serialize::booleanToString($options['synchronousValidation']),
        ]);

        $payload = $this->version->update(
            'POST',
            $this->uri,
            [],
            $data
        );

        return new ServiceInstance($this->version, $payload, $this->solution['sid']);
    }

    /**
     * Fetch a ServiceInstance
     *
     * @return ServiceInstance Fetched ServiceInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch()
    {
        $params = Values::of([]);

        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );

        return new ServiceInstance($this->version, $payload, $this->solution['sid']);
    }

    /**
     * Deletes the ServiceInstance
     *
     * @return boolean True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete()
    {
        return $this->version->delete('delete', $this->uri);
    }

    /**
     * Access the phoneNumbers
     *
     * @return \Twilio\Rest\Messaging\V1\Service\PhoneNumberList
     */
    protected function getPhoneNumbers()
    {
        if (!$this->_phoneNumbers)
        {
            $this->_phoneNumbers = new PhoneNumberList($this->version, $this->solution['sid']);
        }

        return $this->_phoneNumbers;
    }

    /**
     * Access the shortCodes
     *
     * @return \Twilio\Rest\Messaging\V1\Service\ShortCodeList
     */
    protected function getShortCodes()
    {
        if (!$this->_shortCodes)
        {
            $this->_shortCodes = new ShortCodeList($this->version, $this->solution['sid']);
        }

        return $this->_shortCodes;
    }

    /**
     * Access the alphaSenders
     *
     * @return \Twilio\Rest\Messaging\V1\Service\AlphaSenderList
     */
    protected function getAlphaSenders()
    {
        if (!$this->_alphaSenders)
        {
            $this->_alphaSenders = new AlphaSenderList($this->version, $this->solution['sid']);
        }

        return $this->_alphaSenders;
    }

    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     * @return \Twilio\ListResource The requested subresource
     * @throws \Twilio\Exceptions\TwilioException For unknown subresources
     */
    public function __get($name)
    {
        if (property_exists($this, '_' . $name))
        {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return \Twilio\InstanceContext The requested resource context
     * @throws \Twilio\Exceptions\TwilioException For unknown resource
     */
    public function __call($name, $arguments)
    {
        $property = $this->$name;
        if (method_exists($property, 'getContext'))
        {
            return call_user_func_array([$property, 'getContext'], $arguments);
        }

        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString()
    {
        $context = [];
        foreach ($this->solution as $key => $value)
        {
            $context[] = "$key=$value";
        }
        return '[Twilio.Messaging.V1.ServiceContext ' . implode(' ', $context) . ']';
    }
}
