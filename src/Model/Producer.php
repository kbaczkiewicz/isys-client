<?php

namespace IsysRestClient\Model;

use JsonSerializable;

class Producer implements JsonSerializable
{
    private $id;

    private $name;

    private $siteUrl;

    private $logoFilename;

    private $ordering;

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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSiteUrl()
    {
        return $this->siteUrl;
    }

    /**
     * @return mixed
     */
    public function getLogoFilename()
    {
        return $this->logoFilename;
    }

    /**
     * @return mixed
     */
    public function getOrdering()
    {
        return $this->ordering;
    }

    /**
     * @return mixed
     */
    public function getSourceId()
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
