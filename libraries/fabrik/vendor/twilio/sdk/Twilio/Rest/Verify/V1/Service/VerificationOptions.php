<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Verify\V1\Service;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
abstract class VerificationOptions
{
    /**
     * @param string $customMessage A custom message for this verification
     * @param string $sendDigits Digits to send when a phone call is started
     * @param string $locale Locale used in the sms or call.
     * @param string $customCode A pre-generated code
     * @return CreateVerificationOptions Options builder
     */
    public static function create($customMessage = Values::NONE, $sendDigits = Values::NONE, $locale = Values::NONE, $customCode = Values::NONE)
    {
        return new CreateVerificationOptions($customMessage, $sendDigits, $locale, $customCode);
    }
}

class CreateVerificationOptions extends Options
{
    /**
     * @param string $customMessage A custom message for this verification
     * @param string $sendDigits Digits to send when a phone call is started
     * @param string $locale Locale used in the sms or call.
     * @param string $customCode A pre-generated code
     */
    public function __construct($customMessage = Values::NONE, $sendDigits = Values::NONE, $locale = Values::NONE, $customCode = Values::NONE)
    {
        $this->options['customMessage'] = $customMessage;
        $this->options['sendDigits'] = $sendDigits;
        $this->options['locale'] = $locale;
        $this->options['customCode'] = $customCode;
    }

    /**
     * A character string containing a custom message for this verification
     *
     * @param string $customMessage A custom message for this verification
     * @return $this Fluent Builder
     */
    public function setCustomMessage($customMessage)
    {
        $this->options['customMessage'] = $customMessage;
        return $this;
    }

    /**
     * Digits to send when a phone call is started, same parameters as in Programmable Voice are supported
     *
     * @param string $sendDigits Digits to send when a phone call is started
     * @return $this Fluent Builder
     */
    public function setSendDigits($sendDigits)
    {
        $this->options['sendDigits'] = $sendDigits;
        return $this;
    }

    /**
     * Supported values are af, ar, ca, cs, da, de, el, en, es, fi, fr, he, hi, hr, hu, id, it, ja, ko, ms, nb, nl, pl, pt, pr-BR, ro, ru, sv, th, tl, tr, vi, zh, zh-CN, zh-HK
     *
     * @param string $locale Locale used in the sms or call.
     * @return $this Fluent Builder
     */
    public function setLocale($locale)
    {
        $this->options['locale'] = $locale;
        return $this;
    }

    /**
     * Pass in a pre-generated code. Code length can be between 4-10 characters.
     *
     * @param string $customCode A pre-generated code
     * @return $this Fluent Builder
     */
    public function setCustomCode($customCode)
    {
        $this->options['customCode'] = $customCode;
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
        return '[Twilio.Verify.V1.CreateVerificationOptions ' . implode(' ', $options) . ']';
    }
}
