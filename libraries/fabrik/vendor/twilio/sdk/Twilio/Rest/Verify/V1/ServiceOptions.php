<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Verify\V1;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
abstract class ServiceOptions
{
    /**
     * @param integer $codeLength Length of verification code. Valid values are 4-10
     * @param boolean $lookupEnabled Indicates whether or not to perform a lookup
     *                               with each verification started
     * @param boolean $skipSmsToLandlines Indicates whether or not to ignore SMS
     *                                    verifications for landlines
     * @param boolean $dtmfInputRequired Indicates whether or not to require a
     *                                   random number input to deliver the verify
     *                                   code via phone calls
     * @param string $ttsName Alternative to be used as Service friendly name in
     *                        phone calls
     * @return CreateServiceOptions Options builder
     */
    public static function create($codeLength = Values::NONE, $lookupEnabled = Values::NONE, $skipSmsToLandlines = Values::NONE, $dtmfInputRequired = Values::NONE, $ttsName = Values::NONE)
    {
        return new CreateServiceOptions($codeLength, $lookupEnabled, $skipSmsToLandlines, $dtmfInputRequired, $ttsName);
    }

    /**
     * @param string $friendlyName Friendly name of the service
     * @param integer $codeLength Length of verification code. Valid values are 4-10
     * @param boolean $lookupEnabled Indicates whether or not to perform a lookup
     *                               with each verification started
     * @param boolean $skipSmsToLandlines Indicates whether or not to ignore SMS
     *                                    verifications for landlines
     * @param boolean $dtmfInputRequired Indicates whether or not to require a
     *                                   random number input to deliver the verify
     *                                   code via phone calls
     * @param string $ttsName Alternative to be used as Service friendly name in
     *                        phone calls
     * @return UpdateServiceOptions Options builder
     */
    public static function update($friendlyName = Values::NONE, $codeLength = Values::NONE, $lookupEnabled = Values::NONE, $skipSmsToLandlines = Values::NONE, $dtmfInputRequired = Values::NONE, $ttsName = Values::NONE)
    {
        return new UpdateServiceOptions($friendlyName, $codeLength, $lookupEnabled, $skipSmsToLandlines,
            $dtmfInputRequired, $ttsName);
    }
}

class CreateServiceOptions extends Options
{
    /**
     * @param integer $codeLength Length of verification code. Valid values are 4-10
     * @param boolean $lookupEnabled Indicates whether or not to perform a lookup
     *                               with each verification started
     * @param boolean $skipSmsToLandlines Indicates whether or not to ignore SMS
     *                                    verifications for landlines
     * @param boolean $dtmfInputRequired Indicates whether or not to require a
     *                                   random number input to deliver the verify
     *                                   code via phone calls
     * @param string $ttsName Alternative to be used as Service friendly name in
     *                        phone calls
     */
    public function __construct($codeLength = Values::NONE, $lookupEnabled = Values::NONE, $skipSmsToLandlines = Values::NONE, $dtmfInputRequired = Values::NONE, $ttsName = Values::NONE)
    {
        $this->options['codeLength'] = $codeLength;
        $this->options['lookupEnabled'] = $lookupEnabled;
        $this->options['skipSmsToLandlines'] = $skipSmsToLandlines;
        $this->options['dtmfInputRequired'] = $dtmfInputRequired;
        $this->options['ttsName'] = $ttsName;
    }

    /**
     * The length of the verification code to be generated. Must be an integer value between 4-10
     *
     * @param integer $codeLength Length of verification code. Valid values are 4-10
     * @return $this Fluent Builder
     */
    public function setCodeLength($codeLength)
    {
        $this->options['codeLength'] = $codeLength;
        return $this;
    }

    /**
     * Boolean value that indicates if a lookup should be performed with each verification started and associated info returned
     *
     * @param boolean $lookupEnabled Indicates whether or not to perform a lookup
     *                               with each verification started
     * @return $this Fluent Builder
     */
    public function setLookupEnabled($lookupEnabled)
    {
        $this->options['lookupEnabled'] = $lookupEnabled;
        return $this;
    }

    /**
     * Boolean value that indicates whether or not to ignore SMS verifications for landlines, depends on lookup_enabled flag
     *
     * @param boolean $skipSmsToLandlines Indicates whether or not to ignore SMS
     *                                    verifications for landlines
     * @return $this Fluent Builder
     */
    public function setSkipSmsToLandlines($skipSmsToLandlines)
    {
        $this->options['skipSmsToLandlines'] = $skipSmsToLandlines;
        return $this;
    }

    /**
     * Boolean value that indicates whether or not to require a random number input to deliver the verify code via phone calls
     *
     * @param boolean $dtmfInputRequired Indicates whether or not to require a
     *                                   random number input to deliver the verify
     *                                   code via phone calls
     * @return $this Fluent Builder
     */
    public function setDtmfInputRequired($dtmfInputRequired)
    {
        $this->options['dtmfInputRequired'] = $dtmfInputRequired;
        return $this;
    }

    /**
     * Alternative to be used as Service friendly name in phone calls, only applies to TTS languages
     *
     * @param string $ttsName Alternative to be used as Service friendly name in
     *                        phone calls
     * @return $this Fluent Builder
     */
    public function setTtsName($ttsName)
    {
        $this->options['ttsName'] = $ttsName;
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
        return '[Twilio.Verify.V1.CreateServiceOptions ' . implode(' ', $options) . ']';
    }
}

class UpdateServiceOptions extends Options
{
    /**
     * @param string $friendlyName Friendly name of the service
     * @param integer $codeLength Length of verification code. Valid values are 4-10
     * @param boolean $lookupEnabled Indicates whether or not to perform a lookup
     *                               with each verification started
     * @param boolean $skipSmsToLandlines Indicates whether or not to ignore SMS
     *                                    verifications for landlines
     * @param boolean $dtmfInputRequired Indicates whether or not to require a
     *                                   random number input to deliver the verify
     *                                   code via phone calls
     * @param string $ttsName Alternative to be used as Service friendly name in
     *                        phone calls
     */
    public function __construct($friendlyName = Values::NONE, $codeLength = Values::NONE, $lookupEnabled = Values::NONE, $skipSmsToLandlines = Values::NONE, $dtmfInputRequired = Values::NONE, $ttsName = Values::NONE)
    {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['codeLength'] = $codeLength;
        $this->options['lookupEnabled'] = $lookupEnabled;
        $this->options['skipSmsToLandlines'] = $skipSmsToLandlines;
        $this->options['dtmfInputRequired'] = $dtmfInputRequired;
        $this->options['ttsName'] = $ttsName;
    }

    /**
     * A 1-64 character string with friendly name of service
     *
     * @param string $friendlyName Friendly name of the service
     * @return $this Fluent Builder
     */
    public function setFriendlyName($friendlyName)
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * The length of the verification code to be generated. Must be an integer value between 4-10
     *
     * @param integer $codeLength Length of verification code. Valid values are 4-10
     * @return $this Fluent Builder
     */
    public function setCodeLength($codeLength)
    {
        $this->options['codeLength'] = $codeLength;
        return $this;
    }

    /**
     * Boolean value that indicates if a lookup should be performed with each verification started and associated info returned
     *
     * @param boolean $lookupEnabled Indicates whether or not to perform a lookup
     *                               with each verification started
     * @return $this Fluent Builder
     */
    public function setLookupEnabled($lookupEnabled)
    {
        $this->options['lookupEnabled'] = $lookupEnabled;
        return $this;
    }

    /**
     * Boolean value that indicates whether or not to ignore SMS verifications for landlines, depends on lookup_enabled flag
     *
     * @param boolean $skipSmsToLandlines Indicates whether or not to ignore SMS
     *                                    verifications for landlines
     * @return $this Fluent Builder
     */
    public function setSkipSmsToLandlines($skipSmsToLandlines)
    {
        $this->options['skipSmsToLandlines'] = $skipSmsToLandlines;
        return $this;
    }

    /**
     * Boolean value that indicates whether or not to require a random number input to deliver the verify code via phone calls
     *
     * @param boolean $dtmfInputRequired Indicates whether or not to require a
     *                                   random number input to deliver the verify
     *                                   code via phone calls
     * @return $this Fluent Builder
     */
    public function setDtmfInputRequired($dtmfInputRequired)
    {
        $this->options['dtmfInputRequired'] = $dtmfInputRequired;
        return $this;
    }

    /**
     * Alternative to be used as Service friendly name in phone calls, only applies to TTS languages
     *
     * @param string $ttsName Alternative to be used as Service friendly name in
     *                        phone calls
     * @return $this Fluent Builder
     */
    public function setTtsName($ttsName)
    {
        $this->options['ttsName'] = $ttsName;
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
        return '[Twilio.Verify.V1.UpdateServiceOptions ' . implode(' ', $options) . ']';
    }
}
