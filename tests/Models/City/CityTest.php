<?php

namespace BookingCom\Tests\Models\City;


use BookingCom\Models\City\City;
use BookingCom\Models\Location\Location;
use BookingCom\Models\City\Timezone;
use PHPUnit\Framework\TestCase;

class CityTest extends TestCase
{
    public function testFromArray(): void
    {
        $city = $this->createCityDefaultArray();

        $this->assertEquals(1, $city->getNumberOfHotels());
        $this->assertEquals(-3875419, $city->getId());
        $this->assertEquals('Pedro Gonzalez', $city->getName());
        $this->assertEquals('ve', $city->getCountry());
    }

    public function testLocation(): void
    {
        $city = $this->createCityDefaultArray([
            'location' => [
                'latitude'  => '11.116700172424316',
                'longitude' => '-63.91669845581055',
            ],
        ]);

        $this->assertInstanceOf(Location::class, $city->getLocation());
    }

    public function testTimezone(): void
    {
        $city = $this->createCityDefaultArray([
            'timezone' => [
                'offset' => 2,
                'name'   => 'Europe/Amsterdam',
            ],
        ]);

        $this->assertInstanceOf(Timezone::class, $city->getTimezone());
    }

    /**
     * @param array $additionalArray
     * @return City
     */
    public function createCityDefaultArray(array $additionalArray = []): City
    {
        $basicArray = [
            'nr_hotels' => 1,
            'city_id'   => -3875419,
            'name'      => 'Pedro Gonzalez',
            'country'   => 've',
        ];

        $array = array_merge($basicArray, $additionalArray);

        return City::fromArray($array);
    }


}