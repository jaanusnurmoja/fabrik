<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\IpMessaging\V2\Service\Channel;

use Twilio\Options;
use Twilio\Values;

abstract class WebhookOptions
{
    /**
     * @param string $configurationUrl The configuration.url
     * @param string $configurationMethod The configuration.method
     * @param string $configurationFilters The configuration.filters
     * @param string $configurationTriggers The configuration.triggers
     * @param string $configurationFlowSid The configuration.flow_sid
     * @param integer $configurationRetryCount The configuration.retry_count
     * @return CreateWebhookOptions Options builder
     */
    public static function create($configurationUrl = Values::NONE, $configurationMethod = Values::NONE, $configurationFilters = Values::NONE, $configurationTriggers = Values::NONE, $configurationFlowSid = Values::NONE, $configurationRetryCount = Values::NONE)
    {
        return new CreateWebhookOptions($configurationUrl, $configurationMethod, $configurationFilters,
            $configurationTriggers, $configurationFlowSid, $configurationRetryCount);
    }

    /**
     * @param string $configurationUrl The configuration.url
     * @param string $configurationMethod The configuration.method
     * @param string $configurationFilters The configuration.filters
     * @param string $configurationTriggers The configuration.triggers
     * @param string $configurationFlowSid The configuration.flow_sid
     * @param integer $configurationRetryCount The configuration.retry_count
     * @return UpdateWebhookOptions Options builder
     */
    public static function update($configurationUrl = Values::NONE, $configurationMethod = Values::NONE, $configurationFilters = Values::NONE, $configurationTriggers = Values::NONE, $configurationFlowSid = Values::NONE, $configurationRetryCount = Values::NONE)
    {
        return new UpdateWebhookOptions($configurationUrl, $configurationMethod, $configurationFilters,
            $configurationTriggers, $configurationFlowSid, $configurationRetryCount);
    }
}

class CreateWebhookOptions extends Options
{
    /**
     * @param string $configurationUrl The configuration.url
     * @param string $configurationMethod The configuration.method
     * @param string $configurationFilters The configuration.filters
     * @param string $configurationTriggers The configuration.triggers
     * @param string $configurationFlowSid The configuration.flow_sid
     * @param integer $configurationRetryCount The configuration.retry_count
     */
    public function __construct($configurationUrl = Values::NONE, $configurationMethod = Values::NONE, $configurationFilters = Values::NONE, $configurationTriggers = Values::NONE, $configurationFlowSid = Values::NONE, $configurationRetryCount = Values::NONE)
    {
        $this->options['configurationUrl'] = $configurationUrl;
        $this->options['configurationMethod'] = $configurationMethod;
        $this->options['configurationFilters'] = $configurationFilters;
        $this->options['configurationTriggers'] = $configurationTriggers;
        $this->options['configurationFlowSid'] = $configurationFlowSid;
        $this->options['configurationRetryCount'] = $configurationRetryCount;
    }

    /**
     * The configuration.url
     *
     * @param string $configurationUrl The configuration.url
     * @return $this Fluent Builder
     */
    public function setConfigurationUrl($configurationUrl)
    {
        $this->options['configurationUrl'] = $configurationUrl;
        return $this;
    }

    /**
     * The configuration.method
     *
     * @param string $configurationMethod The configuration.method
     * @return $this Fluent Builder
     */
    public function setConfigurationMethod($configurationMethod)
    {
        $this->options['configurationMethod'] = $configurationMethod;
        return $this;
    }

    /**
     * The configuration.filters
     *
     * @param string $configurationFilters The configuration.filters
     * @return $this Fluent Builder
     */
    public function setConfigurationFilters($configurationFilters)
    {
        $this->options['configurationFilters'] = $configurationFilters;
        return $this;
    }

    /**
     * The configuration.triggers
     *
     * @param string $configurationTriggers The configuration.triggers
     * @return $this Fluent Builder
     */
    public function setConfigurationTriggers($configurationTriggers)
    {
        $this->options['configurationTriggers'] = $configurationTriggers;
        return $this;
    }

    /**
     * The configuration.flow_sid
     *
     * @param string $configurationFlowSid The configuration.flow_sid
     * @return $this Fluent Builder
     */
    public function setConfigurationFlowSid($configurationFlowSid)
    {
        $this->options['configurationFlowSid'] = $configurationFlowSid;
        return $this;
    }

    /**
     * The configuration.retry_count
     *
     * @param integer $configurationRetryCount The configuration.retry_count
     * @return $this Fluent Builder
     */
    public function setConfigurationRetryCount($configurationRetryCount)
    {
        $this->options['configurationRetryCount'] = $configurationRetryCount;
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
        return '[Twilio.IpMessaging.V2.CreateWebhookOptions ' . implode(' ', $options) . ']';
    }
}

class UpdateWebhookOptions extends Options
{
    /**
     * @param string $configurationUrl The configuration.url
     * @param string $configurationMethod The configuration.method
     * @param string $configurationFilters The configuration.filters
     * @param string $configurationTriggers The configuration.triggers
     * @param string $configurationFlowSid The configuration.flow_sid
     * @param integer $configurationRetryCount The configuration.retry_count
     */
    public function __construct($configurationUrl = Values::NONE, $configurationMethod = Values::NONE, $configurationFilters = Values::NONE, $configurationTriggers = Values::NONE, $configurationFlowSid = Values::NONE, $configurationRetryCount = Values::NONE)
    {
        $this->options['configurationUrl'] = $configurationUrl;
        $this->options['configurationMethod'] = $configurationMethod;
        $this->options['configurationFilters'] = $configurationFilters;
        $this->options['configurationTriggers'] = $configurationTriggers;
        $this->options['configurationFlowSid'] = $configurationFlowSid;
        $this->options['configurationRetryCount'] = $configurationRetryCount;
    }

    /**
     * The configuration.url
     *
     * @param string $configurationUrl The configuration.url
     * @return $this Fluent Builder
     */
    public function setConfigurationUrl($configurationUrl)
    {
        $this->options['configurationUrl'] = $configurationUrl;
        return $this;
    }

    /**
     * The configuration.method
     *
     * @param string $configurationMethod The configuration.method
     * @return $this Fluent Builder
     */
    public function setConfigurationMethod($configurationMethod)
    {
        $this->options['configurationMethod'] = $configurationMethod;
        return $this;
    }

    /**
     * The configuration.filters
     *
     * @param string $configurationFilters The configuration.filters
     * @return $this Fluent Builder
     */
    public function setConfigurationFilters($configurationFilters)
    {
        $this->options['configurationFilters'] = $configurationFilters;
        return $this;
    }

    /**
     * The configuration.triggers
     *
     * @param string $configurationTriggers The configuration.triggers
     * @return $this Fluent Builder
     */
    public function setConfigurationTriggers($configurationTriggers)
    {
        $this->options['configurationTriggers'] = $configurationTriggers;
        return $this;
    }

    /**
     * The configuration.flow_sid
     *
     * @param string $configurationFlowSid The configuration.flow_sid
     * @return $this Fluent Builder
     */
    public function setConfigurationFlowSid($configurationFlowSid)
    {
        $this->options['configurationFlowSid'] = $configurationFlowSid;
        return $this;
    }

    /**
     * The configuration.retry_count
     *
     * @param integer $configurationRetryCount The configuration.retry_count
     * @return $this Fluent Builder
     */
    public function setConfigurationRetryCount($configurationRetryCount)
    {
        $this->options['configurationRetryCount'] = $configurationRetryCount;
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
        return '[Twilio.IpMessaging.V2.UpdateWebhookOptions ' . implode(' ', $options) . ']';
    }
}
