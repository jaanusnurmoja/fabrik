<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\IpMessaging\V2\Service;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Options;
use Twilio\Rest\IpMessaging\V2\Service\User\UserBindingList;
use Twilio\Rest\IpMessaging\V2\Service\User\UserChannelList;
use Twilio\Values;
use Twilio\Version;

/**
 * @property \Twilio\Rest\IpMessaging\V2\Service\User\UserChannelList userChannels
 * @property \Twilio\Rest\IpMessaging\V2\Service\User\UserBindingList userBindings
 * @method \Twilio\Rest\IpMessaging\V2\Service\User\UserChannelContext userChannels(string $channelSid)
 * @method \Twilio\Rest\IpMessaging\V2\Service\User\UserBindingContext userBindings(string $sid)
 */
class UserContext extends InstanceContext
{
    protected $_userChannels = null;
    protected $_userBindings = null;

    /**
     * Initialize the UserContext
     *
     * @param \Twilio\Version $version Version that contains the resource
     * @param string $serviceSid Sid of the Service this user belongs to.
     * @param string $sid Key that uniquely defines the user to fetch.
     * @return \Twilio\Rest\IpMessaging\V2\Service\UserContext
     */
    public function __construct(Version $version, $serviceSid, $sid)
    {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['serviceSid' => $serviceSid, 'sid' => $sid,];

        $this->uri = '/Services/' . rawurlencode($serviceSid) . '/Users/' . rawurlencode($sid) . '';
    }

    /**
     * Fetch a UserInstance
     *
     * @return UserInstance Fetched UserInstance
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

        return new UserInstance(
            $this->version,
            $payload,
            $this->solution['serviceSid'],
            $this->solution['sid']
        );
    }

    /**
     * Deletes the UserInstance
     *
     * @return boolean True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete()
    {
        return $this->version->delete('delete', $this->uri);
    }

    /**
     * Update the UserInstance
     *
     * @param array|Options $options Optional Arguments
     * @return UserInstance Updated UserInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update($options = [])
    {
        $options = new Values($options);

        $data = Values::of([
            'RoleSid'      => $options['roleSid'],
            'Attributes'   => $options['attributes'],
            'FriendlyName' => $options['friendlyName'],
        ]);

        $payload = $this->version->update(
            'POST',
            $this->uri,
            [],
            $data
        );

        return new UserInstance(
            $this->version,
            $payload,
            $this->solution['serviceSid'],
            $this->solution['sid']
        );
    }

    /**
     * Access the userChannels
     *
     * @return \Twilio\Rest\IpMessaging\V2\Service\User\UserChannelList
     */
    protected function getUserChannels()
    {
        if (!$this->_userChannels)
        {
            $this->_userChannels = new UserChannelList(
                $this->version,
                $this->solution['serviceSid'],
                $this->solution['sid']
            );
        }

        return $this->_userChannels;
    }

    /**
     * Access the userBindings
     *
     * @return \Twilio\Rest\IpMessaging\V2\Service\User\UserBindingList
     */
    protected function getUserBindings()
    {
        if (!$this->_userBindings)
        {
            $this->_userBindings = new UserBindingList(
                $this->version,
                $this->solution['serviceSid'],
                $this->solution['sid']
            );
        }

        return $this->_userBindings;
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
        return '[Twilio.IpMessaging.V2.UserContext ' . implode(' ', $context) . ']';
    }
}
