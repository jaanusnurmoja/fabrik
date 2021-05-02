<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Taskrouter\V1\Workspace;

use Twilio\Options;
use Twilio\Values;

abstract class TaskChannelOptions
{
    /**
     * @param string $friendlyName Toggle the FriendlyName for the TaskChannel
     * @return UpdateTaskChannelOptions Options builder
     */
    public static function update($friendlyName = Values::NONE)
    {
        return new UpdateTaskChannelOptions($friendlyName);
    }
}

class UpdateTaskChannelOptions extends Options
{
    /**
     * @param string $friendlyName Toggle the FriendlyName for the TaskChannel
     */
    public function __construct($friendlyName = Values::NONE)
    {
        $this->options['friendlyName'] = $friendlyName;
    }

    /**
     * Toggle the FriendlyName for the TaskChannel
     *
     * @param string $friendlyName Toggle the FriendlyName for the TaskChannel
     * @return $this Fluent Builder
     */
    public function setFriendlyName($friendlyName)
    {
        $this->options['friendlyName'] = $friendlyName;
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
        return '[Twilio.Taskrouter.V1.UpdateTaskChannelOptions ' . implode(' ', $options) . ']';
    }
}
