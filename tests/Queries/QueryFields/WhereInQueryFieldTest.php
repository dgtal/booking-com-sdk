<?php

namespace Queries\QueryFields;

use BookingCom\Queries\QueryFields\WhereInQueryField;
use BookingCom\Queries\Validators\IntegerValidator;
use PHPUnit\Framework\TestCase;

class WhereInQueryFieldTest extends TestCase
{
    public function testMatchMethod(): void
    {
        $rule = new WhereInQueryField('cities_ids');
        $this->assertEquals('cities_ids', $rule->getFieldName());
        $this->assertTrue($rule->matchMethod('whereCitiesIdsIn'));
    }

    public function testValue(): void
    {
        $rule = new WhereInQueryField('cities_ids');
        $rule->setValue([1, 2, 3], 'withCitiesIdsIn');
        $this->assertEquals('1,2,3', $rule->getValue());
    }

    public function testValidator(): void
    {
        $rule = new WhereInQueryField('cities_ids', new IntegerValidator());
        $this->expectException(\InvalidArgumentException::class);
        $rule->setValue([1, 'aaa', 3], 'withCitiesIdsIn');
    }
}