<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Call;

use Twilio\ListResource;
use Twilio\Version;

class FeedbackList extends ListResource
{
    /**
     * Construct the FeedbackList
     *
     * @param Version $version Version that contains the resource
     * @param string $accountSid The unique sid that identifies this account
     * @param string $callSid A 34-character string that uniquely identifies the
     *                        Call resource.
     * @return \Twilio\Rest\Api\V2010\Account\Call\FeedbackList
     */
    public function __construct(Version $version, $accountSid, $callSid)
    {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['accountSid' => $accountSid, 'callSid' => $callSid,];
    }

    /**
     * Constructs a FeedbackContext
     *
     * @return \Twilio\Rest\Api\V2010\Account\Call\FeedbackContext
     */
    public function getContext()
    {
        return new FeedbackContext(
            $this->version,
            $this->solution['accountSid'],
            $this->solution['callSid']
        );
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString()
    {
        return '[Twilio.Api.V2010.FeedbackList]';
    }
}
