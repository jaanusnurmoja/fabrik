<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Studio\V1;

use Twilio\ListResource;
use Twilio\Values;
use Twilio\Version;

class FlowList extends ListResource
{
    /**
     * Construct the FlowList
     *
     * @param Version $version Version that contains the resource
     * @return \Twilio\Rest\Studio\V1\FlowList
     */
    public function __construct(Version $version)
    {
        parent::__construct($version);

        // Path Solution
        $this->solution = [];

        $this->uri = '/Flows';
    }

    /**
     * Streams FlowInstance records from the API as a generator stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     *
     * @param int $limit Upper limit for the number of records to return. stream()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, stream()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return \Twilio\Stream stream of results
     */
    public function stream($limit = null, $pageSize = null)
    {
        $limits = $this->version->readLimits($limit, $pageSize);

        $page = $this->page($limits['pageSize']);

        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }

    /**
     * Reads FlowInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     *
     * @param int $limit Upper limit for the number of records to return. read()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, read()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return FlowInstance[] Array of results
     */
    public function read($limit = null, $pageSize = null)
    {
        return iterator_to_array($this->stream($limit, $pageSize), false);
    }

    /**
     * Retrieve a single page of FlowInstance records from the API.
     * Request is executed immediately
     *
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return \Twilio\Page Page of FlowInstance
     */
    public function page($pageSize = Values::NONE, $pageToken = Values::NONE, $pageNumber = Values::NONE)
    {
        $params = Values::of([
            'PageToken' => $pageToken,
            'Page'      => $pageNumber,
            'PageSize'  => $pageSize,
        ]);

        $response = $this->version->page(
            'GET',
            $this->uri,
            $params
        );

        return new FlowPage($this->version, $response, $this->solution);
    }

    /**
     * Retrieve a specific page of FlowInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return \Twilio\Page Page of FlowInstance
     */
    public function getPage($targetUrl)
    {
        $response = $this->version->getDomain()->getClient()->request(
            'GET',
            $targetUrl
        );

        return new FlowPage($this->version, $response, $this->solution);
    }

    /**
     * Constructs a FlowContext
     *
     * @param string $sid A string that uniquely identifies this Flow.
     * @return \Twilio\Rest\Studio\V1\FlowContext
     */
    public function getContext($sid)
    {
        return new FlowContext($this->version, $sid);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString()
    {
        return '[Twilio.Studio.V1.FlowList]';
    }
}
