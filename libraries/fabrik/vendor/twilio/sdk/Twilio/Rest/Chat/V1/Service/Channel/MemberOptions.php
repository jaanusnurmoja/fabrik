<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Chat\V1\Service\Channel;

use Twilio\Options;
use Twilio\Values;

abstract class MemberOptions
{
    /**
     * @param string $roleSid The Role assigned to this member.
     * @return CreateMemberOptions Options builder
     */
    public static function create($roleSid = Values::NONE)
    {
        return new CreateMemberOptions($roleSid);
    }

    /**
     * @param string $identity A unique string identifier for this User in this
     *                         Service.
     * @return ReadMemberOptions Options builder
     */
    public static function read($identity = Values::NONE)
    {
        return new ReadMemberOptions($identity);
    }

    /**
     * @param string $roleSid The Role assigned to this member.
     * @param integer $lastConsumedMessageIndex An Integer representing index of
     *                                          the last Message this Member has
     *                                          read within this Channel
     * @return UpdateMemberOptions Options builder
     */
    public static function update($roleSid = Values::NONE, $lastConsumedMessageIndex = Values::NONE)
    {
        return new UpdateMemberOptions($roleSid, $lastConsumedMessageIndex);
    }
}

class CreateMemberOptions extends Options
{
    /**
     * @param string $roleSid The Role assigned to this member.
     */
    public function __construct($roleSid = Values::NONE)
    {
        $this->options['roleSid'] = $roleSid;
    }

    /**
     * The [Role](https://www.twilio.com/docs/api/chat/rest/v1/roles) assigned to this member.
     *
     * @param string $roleSid The Role assigned to this member.
     * @return $this Fluent Builder
     */
    public function setRoleSid($roleSid)
    {
        $this->options['roleSid'] = $roleSid;
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
        return '[Twilio.Chat.V1.CreateMemberOptions ' . implode(' ', $options) . ']';
    }
}

class ReadMemberOptions extends Options
{
    /**
     * @param string $identity A unique string identifier for this User in this
     *                         Service.
     */
    public function __construct($identity = Values::NONE)
    {
        $this->options['identity'] = $identity;
    }

    /**
     * A unique string identifier for this [User](https://www.twilio.com/docs/api/chat/rest/v1/users) in this [Service](https://www.twilio.com/docs/api/chat/rest/v1/services). See the [access tokens](https://www.twilio.com/docs/api/chat/guides/create-tokens)[/docs/api/chat/guides/create-tokens] docs for more details.
     *
     * @param string $identity A unique string identifier for this User in this
     *                         Service.
     * @return $this Fluent Builder
     */
    public function setIdentity($identity)
    {
        $this->options['identity'] = $identity;
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
        return '[Twilio.Chat.V1.ReadMemberOptions ' . implode(' ', $options) . ']';
    }
}

class UpdateMemberOptions extends Options
{
    /**
     * @param string $roleSid The Role assigned to this member.
     * @param integer $lastConsumedMessageIndex An Integer representing index of
     *                                          the last Message this Member has
     *                                          read within this Channel
     */
    public function __construct($roleSid = Values::NONE, $lastConsumedMessageIndex = Values::NONE)
    {
        $this->options['roleSid'] = $roleSid;
        $this->options['lastConsumedMessageIndex'] = $lastConsumedMessageIndex;
    }

    /**
     * The [Role](https://www.twilio.com/docs/api/chat/rest/v1/roles) assigned to this member.
     *
     * @param string $roleSid The Role assigned to this member.
     * @return $this Fluent Builder
     */
    public function setRoleSid($roleSid)
    {
        $this->options['roleSid'] = $roleSid;
        return $this;
    }

    /**
     * An Integer representing index of the last [Message](https://www.twilio.com/docs/api/chat/rest/v1/messages) this Member has read within this [Channel](https://www.twilio.com/docs/api/chat/rest/v1/channels)
     *
     * @param integer $lastConsumedMessageIndex An Integer representing index of
     *                                          the last Message this Member has
     *                                          read within this Channel
     * @return $this Fluent Builder
     */
    public function setLastConsumedMessageIndex($lastConsumedMessageIndex)
    {
        $this->options['lastConsumedMessageIndex'] = $lastConsumedMessageIndex;
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
        return '[Twilio.Chat.V1.UpdateMemberOptions ' . implode(' ', $options) . ']';
    }
}
