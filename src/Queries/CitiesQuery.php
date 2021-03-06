<?php

namespace BookingCom\Queries;

use BookingCom\Queries\QueryFields\SetQueryField;
use BookingCom\Queries\QueryFields\WhereInQueryField;
use BookingCom\Queries\QueryFields\WithArrayQueryField;
use BookingCom\Queries\QueryFields\WithQueryField;
use BookingCom\Queries\Validators\IntegerValidator;
use BookingCom\Queries\Validators\StringValidator;

/**
 * @method $this whereCityIdsIn(array $values)
 * @method $this whereCountriesIn(array $values)
 * @method $this withLanguages(array $values)
 * @method $this setOffset(int $value)
 * @method $this setRows(int $value)
 * @method $this withLocation()
 * @method $this withTimezone()
 */
class CitiesQuery extends AbstractQuery
{
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
            'languages' => [
                'operation' => [WithArrayQueryField::class],
                'validator' => [StringValidator::class, ['length' => 2]],
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
                'operation' => [WithQueryField::class, ['values' => ['location', 'timezone']]],
            ],
        ];
    }
}
