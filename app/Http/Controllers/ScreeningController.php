<?php

namespace App\Http\Controllers;

use App\Interfaces\ScreeningRepositoryInterface;
use App\Models\Screening;
use App\Http\Requests\UpdateScreeningRequest;
use DateInterval;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScreeningController extends Controller
{
    protected $screeningRepository;

    public function __construct(ScreeningRepositoryInterface $screeningRepository)
    {
        $this->screeningRepository = $screeningRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $assignedTo = $this->assignedTo($request);

        $screeningArr = array(
            'firstname' => $request->firstname,
            'dateOfBirth' => $request->dateOfBirth,
            'headacheFrequency' => $request->headacheFrequency,
            'headacheLevel' => $request->headacheLevel,
            'assignedTo' => $assignedTo
        );
        $this->screeningRepository->createScreening($screeningArr);
        $data = "Participant " .$request->firstname." is assigned to ".$assignedTo;

        return response()->json(['data' => $data]);
    }

    /**
     * Check if the user if over 18.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function checkEligibility(Request  $request): JsonResponse
    {
        $bday = new DateTime($request->dateOfBirth);
        //adds time interval of 18 years to bday
        $bday->add(new DateInterval("P18Y"));
        //compare the added years to the current date

        return response()->json(['data' => $bday < new DateTime() ? "over 18" : "under 18"]);
    }

    /**
     * Assign user to specific program.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function assignedTo(Request $request): string
    {
        return $request->headacheFrequency === 'Daily' ? 'Cohert B' : 'Cohert A';
    }
}
