<?php
/**
 * Created by Andrew Ivchenkov <and.ivchenkov@gmail.com>
 * Date: 08.10.18
 */

namespace BookingCom\Queries;

use BookingCom\QueryObject;

class CitiesQuery extends QueryObject
{
    /** @var  array */
    protected $idIn;

    /** @var  array */
    protected $countryIn;

    /** @var  array */
    protected $extras = [];

    /**
     * @return array
     */
    public function toArray(): array
    {
        $result = [];
        if ($this->idIn) {
            $result['city_ids'] = implode(',', $this->idIn);
        }
        if ($this->countryIn) {
            $result['countries'] = implode(',', $this->countryIn);
        }
        if ($this->extras) {
            $result['extras'] = implode(',', $this->extras);
        }

        return $result;
    }

    /**
     * @param array $values
     * @return CitiesQuery
     */
    public function whereIdIn(array $values): self
    {
        $this->where('idIn', $values);

        return $this;
    }

    /**
     * @param array $values
     * @return CitiesQuery
     */
    public function whereCountryIn(array $values): self
    {
        $this->where('countryIn', $values);

        return $this;
    }

    /**
     * @return CitiesQuery
     */
    public function withLocation(): self
    {
        $this->addToExtras('location', $this);

        return $this;
    }

    /**
     * @return CitiesQuery
     */
    public function withTimezone(): self
    {
        $this->addToExtras('timezone', $this);

        return $this;
    }

    /**
     * @return array
     */
    public function getAsserts(): array
    {
        return [
            'idIn'      => [
                'type' => self::ASSERT_ID,
            ],
            'countryIn' => [
                'type' => self::ASSERT_COUNTRY,
            ],
        ];
    }
}