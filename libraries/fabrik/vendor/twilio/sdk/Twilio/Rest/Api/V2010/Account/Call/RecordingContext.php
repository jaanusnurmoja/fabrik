<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Call;

use Twilio\InstanceContext;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

class RecordingContext extends InstanceContext
{
    /**
     * Initialize the RecordingContext
     *
     * @param \Twilio\Version $version Version that contains the resource
     * @param string $accountSid The unique sid that identifies this account
     * @param string $callSid Fetch by unique call Sid for the recording
     * @param string $sid Fetch by unique recording Sid
     * @return \Twilio\Rest\Api\V2010\Account\Call\RecordingContext
     */
    public function __construct(Version $version, $accountSid, $callSid, $sid)
    {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['accountSid' => $accountSid, 'callSid' => $callSid, 'sid' => $sid,];

        $this->uri = '/Accounts/' . rawurlencode($accountSid) . '/Calls/' . rawurlencode($callSid) . '/Recordings/' . rawurlencode($sid) . '.json';
    }

    /**
     * Update the RecordingInstance
     *
     * @param string $status The status to change the recording to.
     * @param array|Options $options Optional Arguments
     * @return RecordingInstance Updated RecordingInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update($status, $options = [])
    {
        $options = new Values($options);

        $data = Values::of(['Status' => $status, 'PauseBehavior' => $options['pauseBehavior'],]);

        $payload = $this->version->update(
            'POST',
            $this->uri,
            [],
            $data
        );

        return new RecordingInstance(
            $this->version,
            $payload,
            $this->solution['accountSid'],
            $this->solution['callSid'],
            $this->solution['sid']
        );
    }

    /**
     * Fetch a RecordingInstance
     *
     * @return RecordingInstance Fetched RecordingInstance
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

        return new RecordingInstance(
            $this->version,
            $payload,
            $this->solution['accountSid'],
            $this->solution['callSid'],
            $this->solution['sid']
        );
    }

    /**
     * Deletes the RecordingInstance
     *
     * @return boolean True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete()
    {
        return $this->version->delete('delete', $this->uri);
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
        return '[Twilio.Api.V2010.RecordingContext ' . implode(' ', $context) . ']';
    }
}
