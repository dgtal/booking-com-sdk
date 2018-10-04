<?php

namespace BookingCom\Models\Hotel;


use BookingCom\BookingObject;
use BookingCom\Models\Room\RoomData;

class Hotel extends BookingObject
{
    /** @var  integer */
    private $id;

    /** @var  HotelData|null */
    private $hotelData;

    /** @var  RoomData[]|null */
    private $roomData;

    /**
     * Hotel constructor.
     *
     * @param int             $id
     * @param HotelData|null  $hotelData
     * @param RoomData[]|null $roomData
     */
    public function __construct(int $id,
        ? HotelData $hotelData,
        ? array $roomData)
    {
        $this->id        = $id;
        $this->hotelData = $hotelData;
        $this->roomData  = $roomData;
    }

    public static function fromArray(array $array): Hotel
    {
        $hotelData = isset($array['hotel_data'])
            ? HotelData::fromArray($array['hotel_data']) : null;

        $roomData = self::getObjectsArray($array, RoomData::class, 'room_data');

        return new self($array['hotel_id'], $hotelData, $roomData);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return HotelData|null
     */
    public function getHotelData():? HotelData
    {
        return $this->hotelData;
    }

    /**
     * @return RoomData[]|null
     */
    public function getRoomData():? array
    {
        return $this->roomData;
    }
}