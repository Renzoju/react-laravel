<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRelationRequest;
use App\Http\Requests\UpdateRelationRequest;
use App\Models\Relation;
use Illuminate\Http\JsonResponse;

class RelationController extends Controller
{
    /**
     * Alle relaties edges voor de netwerk-graph.
     */

    public function index(): JsonResponse
    {
        $relations = Relation::with([
            'fromParticipant',
            'toParticipant',
            'type',
        ])->get();

        return response()->json($relations);
    }

    /**
     * Nieuwe relatie aanmaken
     */
    public function store(StoreRelationRequest $request): JsonResponse
    {
        $relation = Relation::create($request->validated());

        $relation->load(['fromParticipant', 'toParticipant', 'type']);

        return response()->json($relation, 201);
    }

    /**
     * Eén specifieke relatie.
     */
    public function show(Relation $relation): JsonResponse
    {
        $relation->load(['fromParticipant', 'toParticipant', 'type']);

        return response()->json($relation);
    }

    /**
     * Relatie bijwerken.
     */
    public function update(UpdateRelationRequest $request, Relation $relation): JsonResponse
    {
        $relation->update($request->validated());

        $relation->load(['fromParticipant', 'toParticipant', 'type']);

        return response()->json($relation);
    }

    /**
     * Relatie verwijderen.
     */
    public function destroy(Relation $relation): JsonResponse
    {
        $relation->delete();

        return response()->json(null, 204);
    }
}
