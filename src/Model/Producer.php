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

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->siteUrl = $data['site_url'];
        $this->logoFilename = $data['logo_filename'];
        $this->ordering = $data['ordering'];
        $this->sourceId = $data['source_id'];
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
