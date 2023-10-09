<?php

namespace App\Modules\ScheduleImporter\Providers;

use App\Modules\ScheduleImporter\Services\EcoHarmonogramPlService;

class EcoHarmonogramProvider extends ImportProvider
{
    public $title = 'Ecoharmonogram';
    public $description = 'Source for ecoharmonogram.pl';
    protected string $url = 'https://ecoharmonogram.pl';
    protected string $town = '';
    protected string $street = '';
    protected string $house_number = '';
    protected string $district = '';
    protected string $additional_sides_matcher = '';
    protected string $community = '';

    //towns_url = 'https://ecoharmonogram.pl/api/api.php?action=getTowns'
    //community_towns_url = 'https://ecoharmonogram.pl/api/api.php?action=getTownsForCommunity'
    //scheduled_periods_url = 'https://ecoharmonogram.pl/api/api.php?action=getSchedulePeriods'
    //streets_url = 'https://ecoharmonogram.pl/api/api.php?action=getStreets'
    //schedules_url = 'https://ecoharmonogram.pl/api/api.php?action=getSchedules'
    //
    //headers = {
    //'Content-Type': 'application/json; charset=utf-8',
    //'Accept': 'application/json',
    //}

    //https://github.com/mampfes/hacs_waste_collection_schedule/blob/master/custom_components/waste_collection_schedule/waste_collection_schedule/service/EcoHarmonogramPL.py
    //https://github.com/mampfes/hacs_waste_collection_schedule/blob/master/doc/source/ecoharmonogram_pl.md
    //    https://github.com/mampfes/hacs_waste_collection_schedule/blob/master/custom_components/waste_collection_schedule/waste_collection_schedule/source/ecoharmonogram_pl.py
    //https://github.com/mampfes/hacs_waste_collection_schedule/blob/master/custom_components/waste_collection_schedule/waste_collection_schedule/source/ekosystem_wroc_pl.py
    public function __construct(protected EcoHarmonogramPlService $ecoHarmonogramPlService)
    {
    }

    public function import(): void
    {
        $towns = $this->ecoHarmonogramPlService->fetchTowns();

        dd($towns);

        //        matching_towns = filter(lambda x: self . town_input . lower() in x . get('name') . lower(), town_data . get('towns'))
        //        matching_towns_district = filter(lambda x: self . district_input . lower() in x . get('district') . lower(),
        //                                         matching_towns)
        //
        //        town = list(matching_towns_district)[0]
        //
        //        schedule_periods_data = Ecoharmonogram . fetch_scheduled_periods(town)
        //        schedule_periods = schedule_periods_data . get('schedulePeriods')
        //
        //        entries = []
        //        for sp in schedule_periods:
        //            entries . extend(self . _create_entries(sp, town))
        //        return entries
    }
}
