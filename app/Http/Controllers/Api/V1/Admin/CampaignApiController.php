<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Http\Resources\Admin\CampaignResource;
use App\Models\Campaign;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CampaignApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('campaign_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CampaignResource(Campaign::with(['team'])->get());
    }

    public function store(StoreCampaignRequest $request)
    {
        $campaign = Campaign::create($request->validated());

        return (new CampaignResource($campaign))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Campaign $campaign)
    {
        abort_if(Gate::denies('campaign_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CampaignResource($campaign->load(['team']));
    }

    public function update(UpdateCampaignRequest $request, Campaign $campaign)
    {
        $campaign->update($request->validated());

        return (new CampaignResource($campaign))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Campaign $campaign)
    {
        abort_if(Gate::denies('campaign_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $campaign->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
