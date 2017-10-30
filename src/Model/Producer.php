<?php

namespace IsysRestClient\Model;

use JsonSerializable;

class Producer implements JsonSerializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $siteUrl;

    /**
     * @var string
     */
    private $logoFilename;

    /**
     * @var int
     */
    private $ordering;

    /**
     * @var int
     */
    private $sourceId;

    public static function createByArray(array $data)
    {
        $producer = new self;
        $producer->id = $data['id'];
        $producer->name = $data['name'];
        $producer->siteUrl = $data['site_url'];
        $producer->logoFilename = $data['logo_filename'];
        $producer->ordering = $data['ordering'];
        $producer->sourceId = $data['source_id'];

        return $producer;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSiteUrl(): string
    {
        return $this->siteUrl;
    }

    public function getLogoFilename(): string
    {
        return $this->logoFilename;
    }

    public function getOrdering(): int
    {
        return $this->ordering;
    }

    public function getSourceId(): int
    {
        return $this->sourceId;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'site_url'      => $this->siteUrl,
            'logo_filename' => $this->logoFilename,
            'ordering'      => $this->ordering,
            'source_id'     => $this->sourceId,
        ];
    }
}
