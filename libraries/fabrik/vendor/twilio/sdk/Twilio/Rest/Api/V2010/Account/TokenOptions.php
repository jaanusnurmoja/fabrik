<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account;

use Twilio\Options;
use Twilio\Values;

abstract class TokenOptions
{
    /**
     * @param integer $ttl The duration in seconds the credentials are valid
     * @return CreateTokenOptions Options builder
     */
    public static function create($ttl = Values::NONE)
    {
        return new CreateTokenOptions($ttl);
    }
}

class CreateTokenOptions extends Options
{
    /**
     * @param integer $ttl The duration in seconds the credentials are valid
     */
    public function __construct($ttl = Values::NONE)
    {
        $this->options['ttl'] = $ttl;
    }

    /**
     * The duration in seconds for which the generated credentials are valid, the default value is 86400 (24 hours).
     *
     * @param integer $ttl The duration in seconds the credentials are valid
     * @return $this Fluent Builder
     */
    public function setTtl($ttl)
    {
        $this->options['ttl'] = $ttl;
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
        return '[Twilio.Api.V2010.CreateTokenOptions ' . implode(' ', $options) . ']';
    }
}
