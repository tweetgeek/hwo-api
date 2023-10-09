<?php

namespace App\Modules\ScheduleImporter\Services;

use App\Modules\ScheduleImporter\Dtos\TownDto;
use Illuminate\Support\Collection;

class EcoHarmonogramPlService
{
    protected string $towns_url = 'https://ecoharmonogram.pl/api/api.php?action=getTowns';
    protected string $community_towns_url = 'https://ecoharmonogram.pl/api/api.php?action=getTownsForCommunity';
    protected string $scheduled_periods_url = 'https://ecoharmonogram.pl/api/api.php?action=getSchedulePeriods';
    protected string $streets_url = 'https://ecoharmonogram.pl/api/api.php?action=getStreets';
    protected string $schedules_url = 'https://ecoharmonogram.pl/api/api.php?action=getSchedules';
    protected const HEADERS = [
        'Content-Type' => 'application/json; charset=utf-8-sig',
        'Accept' => 'application/json',
        'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36',
    ];


    public function __construct(protected HttpCacherService $httpCacherService)
    {
    }

    public function fetchTowns(): Collection
    {
        $towns = $this->httpCacherService
            ->get(
                $this->towns_url,
                null,
                self::HEADERS
            )->get('towns');

        return collect($towns)->map(fn ($town) => TownDto::fromResponse($town));
    }

    public function fetchTownWithCommunity(string $communityId)
    {
        return $this->httpCacherService
            ->get(
                $this->community_towns_url,
                ['communityId' => $communityId],
                self::HEADERS
            );
    }

    public function fetchSchedules(string $schedulePeriodId, string $streetId)
    {
        return $this->httpCacherService
            ->get(
                $this->schedules_url,
                ['streetId' => $streetId, 'schedulePeriodId' => $schedulePeriodId],
                self::HEADERS
            );
    }

    public function fetchStreets(string $schedulePeriodId, string $townId, string $streetName, string $houseNumber)
    {
        return $this->httpCacherService
            ->get(
                $this->streets_url,
                ['streetName' => $streetName, 'schedulePeriodId' => $schedulePeriodId, 'number' => $houseNumber, 'townId' => $townId],
                self::HEADERS
            );
        //            ->json('streets');
    }

    public function fetchScheduledPeriods(string $townId)
    {
        return $this->httpCacherService
            ->get(
                $this->scheduled_periods_url,
                ['townId' => $townId],
                self::HEADERS
            );
    }

    public function printPossibleSides(string $townId, string $districtId, string $streetId, string $houseNumberId)
    { //town_input, district_input, street_input, house_number_input):
        //        town_data = Ecoharmonogram.fetch_town()
        //        matching_towns = filter(lambda x: town_input.lower() in x.get('name').lower(), town_data.get('towns'))
        //        matching_towns_district = filter(lambda x: district_input.lower() in x.get('district').lower(), matching_towns)
        //
        //        town = list(matching_towns_district)[0]
        //
        //        schedule_periods_data = Ecoharmonogram.fetch_scheduled_periods(town)
        //        schedule_periods = schedule_periods_data.get('schedulePeriods')
        //
        //        for sp in schedule_periods:
        //            streets = Ecoharmonogram.fetch_streets(sp, town, street_input, house_number_input)
        //            for street in streets:
        //                print(street.get('sides'))
    }
}
