<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\TwiML\Voice;

use Twilio\TwiML\TwiML;

class Play extends TwiML
{
    /**
     * Play constructor.
     *
     * @param url $url Media URL
     * @param array $attributes Optional attributes
     */
    public function __construct($url = null, $attributes = [])
    {
        parent::__construct('Play', $url, $attributes);
    }

    /**
     * Add Loop attribute.
     *
     * @param integer $loop Times to loop media
     * @return $this
     */
    public function setLoop($loop)
    {
        return $this->setAttribute('loop', $loop);
    }

    /**
     * Add Digits attribute.
     *
     * @param string $digits Play DTMF tones for digits
     * @return $this
     */
    public function setDigits($digits)
    {
        return $this->setAttribute('digits', $digits);
    }
}
