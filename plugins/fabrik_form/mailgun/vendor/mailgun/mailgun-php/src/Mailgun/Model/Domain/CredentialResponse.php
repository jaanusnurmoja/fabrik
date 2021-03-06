<?php

/*
 * Copyright (C) 2013 Mailgun
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Mailgun\Model\Domain;

use Mailgun\Model\ApiResponse;

/**
 * @author Sean Johnson <sean@mailgun.com>
 */
final class CredentialResponse implements ApiResponse
{
    /**
     * @var int
     */
    private $totalCount;

    /**
     * @var CredentialResponseItem[]
     */
    private $items;

    /**
     * @param array $data
     *
     * @return self
     */
    public static function create(array $data)
    {
        $items = [];
        if (isset($data['items']))
        {
            foreach ($data['items'] as $item)
            {
                $items[] = CredentialResponseItem::create($item);
            }
        }

        if (isset($data['total_count']))
        {
            $count = $data['total_count'];
        }
        else
        {
            $count = count($items);
        }

        return new self($count, $items);
    }

    /**
     * @param int $totalCount
     * @param CredentialResponseItem[] $items
     */
    private function __construct($totalCount, array $items)
    {
        $this->totalCount = $totalCount;
        $this->items = $items;
    }

    /**
     * @return int
     */
    public function getTotalCount()
    {
        return $this->totalCount;
    }

    /**
     * @return CredentialResponseItem[]
     */
    public function getCredentials()
    {
        return $this->items;
    }
}
