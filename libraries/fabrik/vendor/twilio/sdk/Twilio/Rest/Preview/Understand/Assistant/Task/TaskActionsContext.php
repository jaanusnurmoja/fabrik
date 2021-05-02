<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\Understand\Assistant\Task;

use Twilio\InstanceContext;
use Twilio\Options;
use Twilio\Serialize;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class TaskActionsContext extends InstanceContext
{
    /**
     * Initialize the TaskActionsContext
     *
     * @param \Twilio\Version $version Version that contains the resource
     * @param string $assistantSid The unique ID of the parent Assistant.
     * @param string $taskSid The unique ID of the Task.
     * @return \Twilio\Rest\Preview\Understand\Assistant\Task\TaskActionsContext
     */
    public function __construct(Version $version, $assistantSid, $taskSid)
    {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['assistantSid' => $assistantSid, 'taskSid' => $taskSid,];

        $this->uri = '/Assistants/' . rawurlencode($assistantSid) . '/Tasks/' . rawurlencode($taskSid) . '/Actions';
    }

    /**
     * Fetch a TaskActionsInstance
     *
     * @return TaskActionsInstance Fetched TaskActionsInstance
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

        return new TaskActionsInstance(
            $this->version,
            $payload,
            $this->solution['assistantSid'],
            $this->solution['taskSid']
        );
    }

    /**
     * Update the TaskActionsInstance
     *
     * @param array|Options $options Optional Arguments
     * @return TaskActionsInstance Updated TaskActionsInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update($options = [])
    {
        $options = new Values($options);

        $data = Values::of(['Actions' => Serialize::jsonObject($options['actions']),]);

        $payload = $this->version->update(
            'POST',
            $this->uri,
            [],
            $data
        );

        return new TaskActionsInstance(
            $this->version,
            $payload,
            $this->solution['assistantSid'],
            $this->solution['taskSid']
        );
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
        return '[Twilio.Preview.Understand.TaskActionsContext ' . implode(' ', $context) . ']';
    }
}
