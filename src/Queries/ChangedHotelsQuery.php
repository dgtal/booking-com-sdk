<?php

namespace BookingCom\Queries;

use BookingCom\Queries\QueryFields\WhereInQueryField;
use BookingCom\Queries\Validators\IntegerValidator;
use BookingCom\Queries\Validators\StringValidator;

/**
 * @method $this whereCityIdsIn(array $values)
 * @method $this whereCountriesIn(array $values)
 * @method $this whereRegionIdsIn(array $values)
 */
class ChangedHotelsQuery extends AbstractQuery
{
    /**
     * @var \DateTime
     */
    private $lastChange;

    /**
     * ChangedHotelsQuery constructor.
     *
     * @param \DateTime $lastChange
     */
    public function __construct(\DateTime $lastChange)
    {
        parent::__construct();
        $this->setLastChange($lastChange);
    }

    /**
     * @return array
     */
    protected function fields(): array
    {
        return [
            'city_ids' => [
                'operation' => [WhereInQueryField::class],
                'validator' => [IntegerValidator::class],
            ],
            'countries' => [
                'operation' => [WhereInQueryField::class],
                'validator' => [StringValidator::class, ['length' => 2]],
            ],
            'region_ids' => [
                'operation' => [WhereInQueryField::class],
                'validator' => [IntegerValidator::class],
            ],
        ];
    }

    public function setLastChange(\DateTime $lastChange): self
    {
        $this->lastChange = $lastChange;
        return $this;
    }

    public function toArray(): array
    {
        return array_merge(['last_change' => $this->lastChange->format('Y-m-d H:i:s')], parent::toArray());
    }
}
