<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\TwiML\Voice;

use Twilio\TwiML\TwiML;

class Client extends TwiML
{
    /**
     * Client constructor.
     *
     * @param string $identity Client identity
     * @param array $attributes Optional attributes
     */
    public function __construct($identity = null, $attributes = [])
    {
        parent::__construct('Client', $identity, $attributes);
    }

    /**
     * Add Identity child.
     *
     * @param string $clientIdentity Identity of the client to dial
     * @return TwiML Child element.
     */
    public function identity($clientIdentity)
    {
        return $this->nest(new Identity($clientIdentity));
    }

    /**
     * Add Parameter child.
     *
     * @param array $attributes Optional attributes
     * @return TwiML Child element.
     */
    public function parameter($attributes = [])
    {
        return $this->nest(new Parameter($attributes));
    }

    /**
     * Add Url attribute.
     *
     * @param url $url Client URL
     * @return $this
     */
    public function setUrl($url)
    {
        return $this->setAttribute('url', $url);
    }

    /**
     * Add Method attribute.
     *
     * @param httpMethod $method Client URL Method
     * @return $this
     */
    public function setMethod($method)
    {
        return $this->setAttribute('method', $method);
    }

    /**
     * Add StatusCallbackEvent attribute.
     *
     * @param client:Enum:Event $statusCallbackEvent Events to trigger status
     *                                               callback
     * @return $this
     */
    public function setStatusCallbackEvent($statusCallbackEvent)
    {
        return $this->setAttribute('statusCallbackEvent', $statusCallbackEvent);
    }

    /**
     * Add StatusCallback attribute.
     *
     * @param url $statusCallback Status Callback URL
     * @return $this
     */
    public function setStatusCallback($statusCallback)
    {
        return $this->setAttribute('statusCallback', $statusCallback);
    }

    /**
     * Add StatusCallbackMethod attribute.
     *
     * @param httpMethod $statusCallbackMethod Status Callback URL Method
     * @return $this
     */
    public function setStatusCallbackMethod($statusCallbackMethod)
    {
        return $this->setAttribute('statusCallbackMethod', $statusCallbackMethod);
    }
}
