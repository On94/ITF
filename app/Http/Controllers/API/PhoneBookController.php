<?php

namespace App\Http\Controllers\API;

use App\Facades\PhoneBookingServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\PhoneBook\CreateOrUpdateRequest;
use App\Http\Requests\API\PhoneBook\DeleteRequest;
use App\Http\Requests\API\PhoneBook\GetRequest;
use App\Http\Resources\ApiResponse;
use Illuminate\Support\Facades\Auth;

class PhoneBookController extends Controller
{
    /**
     * @param CreateOrUpdateRequest $request
     * @return ApiResponse
     */
    public function create(CreateOrUpdateRequest $request): ApiResponse
    {
        return ApiResponse::make([
            'data' => PhoneBookingServiceFacade::create(Auth::id(), $request->validated())
        ]);
    }

    /**
     * @param CreateOrUpdateRequest $request
     * @return ApiResponse
     */
    public function update(CreateOrUpdateRequest $request): ApiResponse
    {
        return ApiResponse::make([
            'data' => PhoneBookingServiceFacade::update(Auth::id(),$request->validated())
        ]);

    }

    /**
     * @param GetRequest $request
     * @return ApiResponse
     */
    public function get(GetRequest $request): ApiResponse
    {
        return ApiResponse::make([
            'data' => PhoneBookingServiceFacade::get(Auth::id(),$request->search_term)
        ]);
    }

    /**
     * @param DeleteRequest $request
     * @return ApiResponse
     */
    public function delete(DeleteRequest $request): ApiResponse
    {
        return ApiResponse::make([
            'data' => PhoneBookingServiceFacade::delete(Auth::id(),$request->id)
        ]);
    }
}
