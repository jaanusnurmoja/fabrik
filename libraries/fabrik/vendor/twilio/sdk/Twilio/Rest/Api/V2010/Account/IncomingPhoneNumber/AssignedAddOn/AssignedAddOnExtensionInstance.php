<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\IncomingPhoneNumber\AssignedAddOn;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 *
 * @property string sid
 * @property string accountSid
 * @property string resourceSid
 * @property string assignedAddOnSid
 * @property string friendlyName
 * @property string productName
 * @property string uniqueName
 * @property string uri
 * @property boolean enabled
 */
class AssignedAddOnExtensionInstance extends InstanceResource
{
    /**
     * Initialize the AssignedAddOnExtensionInstance
     *
     * @param \Twilio\Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $accountSid The Account id that has installed this Add-on
     * @param string $resourceSid The Phone Number id that has installed this Add-on
     * @param string $assignedAddOnSid A string that uniquely identifies the
     *                                 assigned Add-on installation
     * @param string $sid The unique Extension Sid
     * @return \Twilio\Rest\Api\V2010\Account\IncomingPhoneNumber\AssignedAddOn\AssignedAddOnExtensionInstance
     */
    public function __construct(Version $version, array $payload, $accountSid, $resourceSid, $assignedAddOnSid, $sid = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'sid'              => Values::array_get($payload, 'sid'),
            'accountSid'       => Values::array_get($payload, 'account_sid'),
            'resourceSid'      => Values::array_get($payload, 'resource_sid'),
            'assignedAddOnSid' => Values::array_get($payload, 'assigned_add_on_sid'),
            'friendlyName'     => Values::array_get($payload, 'friendly_name'),
            'productName'      => Values::array_get($payload, 'product_name'),
            'uniqueName'       => Values::array_get($payload, 'unique_name'),
            'uri'              => Values::array_get($payload, 'uri'),
            'enabled'          => Values::array_get($payload, 'enabled'),
        ];

        $this->solution = [
            'accountSid'       => $accountSid,
            'resourceSid'      => $resourceSid,
            'assignedAddOnSid' => $assignedAddOnSid,
            'sid'              => $sid ?: $this->properties['sid'],
        ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return \Twilio\Rest\Api\V2010\Account\IncomingPhoneNumber\AssignedAddOn\AssignedAddOnExtensionContext Context for this
     *                                                                                                        AssignedAddOnExtensionInstance
     */
    protected function proxy()
    {
        if (!$this->context)
        {
            $this->context = new AssignedAddOnExtensionContext(
                $this->version,
                $this->solution['accountSid'],
                $this->solution['resourceSid'],
                $this->solution['assignedAddOnSid'],
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch a AssignedAddOnExtensionInstance
     *
     * @return AssignedAddOnExtensionInstance Fetched AssignedAddOnExtensionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch()
    {
        return $this->proxy()->fetch();
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->properties))
        {
            return $this->properties[$name];
        }

        if (property_exists($this, '_' . $name))
        {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
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
        return '[Twilio.Api.V2010.AssignedAddOnExtensionInstance ' . implode(' ', $context) . ']';
    }
}
