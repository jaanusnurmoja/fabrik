<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\Wireless;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class RatePlanOptions
{
    /**
     * @param string $uniqueName The unique_name
     * @param string $friendlyName The friendly_name
     * @param boolean $dataEnabled The data_enabled
     * @param integer $dataLimit The data_limit
     * @param string $dataMetering The data_metering
     * @param boolean $messagingEnabled The messaging_enabled
     * @param boolean $voiceEnabled The voice_enabled
     * @param boolean $commandsEnabled The commands_enabled
     * @param boolean $nationalRoamingEnabled The national_roaming_enabled
     * @param string $internationalRoaming The international_roaming
     * @return CreateRatePlanOptions Options builder
     */
    public static function create($uniqueName = Values::NONE, $friendlyName = Values::NONE, $dataEnabled = Values::NONE, $dataLimit = Values::NONE, $dataMetering = Values::NONE, $messagingEnabled = Values::NONE, $voiceEnabled = Values::NONE, $commandsEnabled = Values::NONE, $nationalRoamingEnabled = Values::NONE, $internationalRoaming = Values::NONE)
    {
        return new CreateRatePlanOptions($uniqueName, $friendlyName, $dataEnabled, $dataLimit, $dataMetering,
            $messagingEnabled, $voiceEnabled, $commandsEnabled, $nationalRoamingEnabled, $internationalRoaming);
    }

    /**
     * @param string $uniqueName The unique_name
     * @param string $friendlyName The friendly_name
     * @return UpdateRatePlanOptions Options builder
     */
    public static function update($uniqueName = Values::NONE, $friendlyName = Values::NONE)
    {
        return new UpdateRatePlanOptions($uniqueName, $friendlyName);
    }
}

class CreateRatePlanOptions extends Options
{
    /**
     * @param string $uniqueName The unique_name
     * @param string $friendlyName The friendly_name
     * @param boolean $dataEnabled The data_enabled
     * @param integer $dataLimit The data_limit
     * @param string $dataMetering The data_metering
     * @param boolean $messagingEnabled The messaging_enabled
     * @param boolean $voiceEnabled The voice_enabled
     * @param boolean $commandsEnabled The commands_enabled
     * @param boolean $nationalRoamingEnabled The national_roaming_enabled
     * @param string $internationalRoaming The international_roaming
     */
    public function __construct($uniqueName = Values::NONE, $friendlyName = Values::NONE, $dataEnabled = Values::NONE, $dataLimit = Values::NONE, $dataMetering = Values::NONE, $messagingEnabled = Values::NONE, $voiceEnabled = Values::NONE, $commandsEnabled = Values::NONE, $nationalRoamingEnabled = Values::NONE, $internationalRoaming = Values::NONE)
    {
        $this->options['uniqueName'] = $uniqueName;
        $this->options['friendlyName'] = $friendlyName;
        $this->options['dataEnabled'] = $dataEnabled;
        $this->options['dataLimit'] = $dataLimit;
        $this->options['dataMetering'] = $dataMetering;
        $this->options['messagingEnabled'] = $messagingEnabled;
        $this->options['voiceEnabled'] = $voiceEnabled;
        $this->options['commandsEnabled'] = $commandsEnabled;
        $this->options['nationalRoamingEnabled'] = $nationalRoamingEnabled;
        $this->options['internationalRoaming'] = $internationalRoaming;
    }

    /**
     * The unique_name
     *
     * @param string $uniqueName The unique_name
     * @return $this Fluent Builder
     */
    public function setUniqueName($uniqueName)
    {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }

    /**
     * The friendly_name
     *
     * @param string $friendlyName The friendly_name
     * @return $this Fluent Builder
     */
    public function setFriendlyName($friendlyName)
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * The data_enabled
     *
     * @param boolean $dataEnabled The data_enabled
     * @return $this Fluent Builder
     */
    public function setDataEnabled($dataEnabled)
    {
        $this->options['dataEnabled'] = $dataEnabled;
        return $this;
    }

    /**
     * The data_limit
     *
     * @param integer $dataLimit The data_limit
     * @return $this Fluent Builder
     */
    public function setDataLimit($dataLimit)
    {
        $this->options['dataLimit'] = $dataLimit;
        return $this;
    }

    /**
     * The data_metering
     *
     * @param string $dataMetering The data_metering
     * @return $this Fluent Builder
     */
    public function setDataMetering($dataMetering)
    {
        $this->options['dataMetering'] = $dataMetering;
        return $this;
    }

    /**
     * The messaging_enabled
     *
     * @param boolean $messagingEnabled The messaging_enabled
     * @return $this Fluent Builder
     */
    public function setMessagingEnabled($messagingEnabled)
    {
        $this->options['messagingEnabled'] = $messagingEnabled;
        return $this;
    }

    /**
     * The voice_enabled
     *
     * @param boolean $voiceEnabled The voice_enabled
     * @return $this Fluent Builder
     */
    public function setVoiceEnabled($voiceEnabled)
    {
        $this->options['voiceEnabled'] = $voiceEnabled;
        return $this;
    }

    /**
     * The commands_enabled
     *
     * @param boolean $commandsEnabled The commands_enabled
     * @return $this Fluent Builder
     */
    public function setCommandsEnabled($commandsEnabled)
    {
        $this->options['commandsEnabled'] = $commandsEnabled;
        return $this;
    }

    /**
     * The national_roaming_enabled
     *
     * @param boolean $nationalRoamingEnabled The national_roaming_enabled
     * @return $this Fluent Builder
     */
    public function setNationalRoamingEnabled($nationalRoamingEnabled)
    {
        $this->options['nationalRoamingEnabled'] = $nationalRoamingEnabled;
        return $this;
    }

    /**
     * The international_roaming
     *
     * @param string $internationalRoaming The international_roaming
     * @return $this Fluent Builder
     */
    public function setInternationalRoaming($internationalRoaming)
    {
        $this->options['internationalRoaming'] = $internationalRoaming;
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
        return '[Twilio.Preview.Wireless.CreateRatePlanOptions ' . implode(' ', $options) . ']';
    }
}

class UpdateRatePlanOptions extends Options
{
    /**
     * @param string $uniqueName The unique_name
     * @param string $friendlyName The friendly_name
     */
    public function __construct($uniqueName = Values::NONE, $friendlyName = Values::NONE)
    {
        $this->options['uniqueName'] = $uniqueName;
        $this->options['friendlyName'] = $friendlyName;
    }

    /**
     * The unique_name
     *
     * @param string $uniqueName The unique_name
     * @return $this Fluent Builder
     */
    public function setUniqueName($uniqueName)
    {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }

    /**
     * The friendly_name
     *
     * @param string $friendlyName The friendly_name
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
        return '[Twilio.Preview.Wireless.UpdateRatePlanOptions ' . implode(' ', $options) . ']';
    }
}
