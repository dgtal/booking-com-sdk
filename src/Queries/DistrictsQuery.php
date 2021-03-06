<?php

namespace BookingCom\Queries;

use BookingCom\Queries\QueryFields\SetQueryField;
use BookingCom\Queries\QueryFields\WhereInQueryField;
use BookingCom\Queries\QueryFields\WithArrayQueryField;
use BookingCom\Queries\QueryFields\WithQueryField;
use BookingCom\Queries\Validators\IntegerValidator;
use BookingCom\Queries\Validators\OneOfValidator;
use BookingCom\Queries\Validators\StringValidator;

/**
 * @method $this whereDistrictIdsIn(array $values)
 * @method $this whereDistrictTypesIn(array $values)
 * @method $this whereCityIdsIn(array $values)
 * @method $this whereCountriesIn(array $values)
 * @method $this setOffset(int $value)
 * @method $this setRows(int $value)
 * @method $this withLocation()
 * @method $this withLanguages(array $values)
 */
class DistrictsQuery extends AbstractQuery
{
    public const DISTRICT_TYPES = ['free', 'official'];

    /**
     * @return array
     */
    protected function fields(): array
    {
        return [
            'district_ids' => [
                'operation' => [WhereInQueryField::class],
                'validator' => [IntegerValidator::class],
            ],
            'city_ids' => [
                'operation' => [WhereInQueryField::class],
                'validator' => [IntegerValidator::class],
            ],
            'countries' => [
                'operation' => [WhereInQueryField::class],
                'validator' => [StringValidator::class, ['length' => 2]],
            ],
            'district_types' => [
                'operation' => [WhereInQueryField::class],
                'validator' => [OneOfValidator::class, ['values' => self::DISTRICT_TYPES]],
            ],
            'offset' => [
                'operation' => [SetQueryField::class],
                'validator' => [IntegerValidator::class],
            ],
            'rows' => [
                'operation' => [SetQueryField::class],
                'validator' => [IntegerValidator::class],
            ],
            'extras' => [
                'operation' => [WithQueryField::class, ['values' => ['location']]],
            ],
            'languages' => [
                'operation' => [WithArrayQueryField::class],
                'validator' => [StringValidator::class, ['length' => 2]],
            ],
        ];
    }
}
