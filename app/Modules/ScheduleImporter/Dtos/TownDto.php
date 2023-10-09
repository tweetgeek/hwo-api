<?php

namespace App\Modules\ScheduleImporter\Dtos;

class TownDto
{
    // {'id':'14','communityId':'8','name':'Adamowice','district':'Lyski','province':'\u015al\u0105skie','icon':null,'isStrNmrReq':null,'schedulePeriodId':1}
    public function __construct(
        public int    $id,
        public int    $communityId,
        public string $name,
        public string $district,
        public string $province,
        public string $icon,
        public string $isStrNmrReq,
        public int    $schedulePeriodId,
    ) {
    }

    public static function fromResponse(array $response): self
    {
        return new self(
            (int)$response['id'],
            (int)$response['communityId'],
            $response['name'],
            $response['district'],
            $response['province'],
            $response['icon'],
            $response['isStrNmrReq'],
            (int)$response['schedulePeriodId'],
        );
    }
}
