<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;
use App\Models\Participant;
use Illuminate\Http\JsonResponse;

class ParticipantController extends Controller
{
    /**
     * Alle deelnemers voor de netwerk-weergave
     */
    public function index(): JsonResponse
    {
        $participants = Participant::with([
            'type',
            'layer',
            'themes',
            'projects',
        ])->get();

        return response()->json($participants);
    }

    /**
     * Nieuwe deelnemer aanmaken
     */
    public function store(StoreParticipantRequest $request): JsonResponse
    {
        $participant = Participant::create($request->validated());

        $participant->load(['type', 'layer', 'themes', 'projects']);

        return response()->json($participant, 201);
    }

    /**
     * Eén specifieke deelnemer
     */
    public function show(Participant $participant): JsonResponse
    {
        $participant->load([
            'type',
            'layer',
            'themes',
            'projects',
            'outgoingRelations.toParticipant',
            'incomingRelations.fromParticipant',
        ]);

        return response()->json($participant);
    }

    /**
     * Deelnemer bijwerken
     */
    public function update(UpdateParticipantRequest $request, Participant $participant): JsonResponse
    {
        $participant->update($request->validated());

        $participant->load(['type', 'layer', 'themes', 'projects']);

        return response()->json($participant);
    }

    /**
     * Deelnemer verwijderen
     */
    public function destroy(Participant $participant): JsonResponse
    {
        $participant->delete();

        return response()->json(null, 204);
    }
}
