<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\IpMessaging\V2\Service;

use Twilio\Options;
use Twilio\Values;

abstract class BindingOptions
{
    /**
     * @param string $bindingType The push technology used for the bindings
     *                            returned.
     * @param string $identity The identity
     * @return ReadBindingOptions Options builder
     */
    public static function read($bindingType = Values::NONE, $identity = Values::NONE)
    {
        return new ReadBindingOptions($bindingType, $identity);
    }
}

class ReadBindingOptions extends Options
{
    /**
     * @param string $bindingType The push technology used for the bindings
     *                            returned.
     * @param string $identity The identity
     */
    public function __construct($bindingType = Values::NONE, $identity = Values::NONE)
    {
        $this->options['bindingType'] = $bindingType;
        $this->options['identity'] = $identity;
    }

    /**
     * The push technology used for the returned Bindings.  Supported values are apn, gcm and fcm.  See [push notification configuration](https://www.twilio.com/docs/chat/push-notification-configuration) for more information.
     *
     * @param string $bindingType The push technology used for the bindings
     *                            returned.
     * @return $this Fluent Builder
     */
    public function setBindingType($bindingType)
    {
        $this->options['bindingType'] = $bindingType;
        return $this;
    }

    /**
     * The identity
     *
     * @param string $identity The identity
     * @return $this Fluent Builder
     */
    public function setIdentity($identity)
    {
        $this->options['identity'] = $identity;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString()
    {
        $options = [];
        foreach ($this->options as $key => $value)
        {
            if ($value != Values::NONE)
            {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.IpMessaging.V2.ReadBindingOptions ' . implode(' ', $options) . ']';
    }
}
