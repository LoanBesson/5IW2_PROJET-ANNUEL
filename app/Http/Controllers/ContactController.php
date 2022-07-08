<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Twilio\Rest\Client;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\ContactResource;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Notifications\NewContactNotification;
use App\Notifications\NewContactOwnerStateNotification;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('isAdmin'))
            return response()->json(['error' => 'You are not authorized to show all contacts.'], 403);

        return ContactResource::collection(Contact::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        if (Gate::denies('create-contact', $request->property_id))
            return response()->json(['error' => 'You are not authorized to create a contact for this property.'], 403);

        $contact = Auth::user()->contacts()->create($request->all());

        // TODO: Send Mail notification to property owner
        $property = $contact->property;
        $property->user->notify(new NewContactNotification());

        // TODO: Send SMS notification to property owner if phone number is provided
        if ($phone_number = $property->user->phone_number) {
            $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
            $client->messages->create(
                "+33". (int)$phone_number,
                [
                    'from' => env('TWILIO_NUMBER'),
                    'body' => 'Vous avez reçu une nouvelle demande de RDV. EasyHouse.'
                ]
            );
        }

        return response()->json([
            'message' => 'Contact added successfully!',
            'data' => new ContactResource($contact)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        if (Gate::denies('access-contact', $contact))
            return response()->json(['error' => 'You are not authorized to view this contact.'], 403);

        return new ContactResource($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        if (Gate::denies('access-contact', $contact))
            return response()->json(['error' => 'You are not authorized to update this contact.'], 403);

        $contact->update($request->all());

        // Send mail notification to property owner if the auth user is the prospect
        if (Auth::user()->id === $contact->prospect_id) {
            $contact->property->user->notify(new NewContactOwnerStateNotification());

            if ($phone_number = $contact->property->user->phone_number) {
                $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
                $client->messages->create(
                    "+33". (int)$phone_number,
                    [
                        'from' => env('TWILIO_NUMBER'),
                        'body' => 'Un statut de RDV a été modifié par un prospect. EasyHouse.'
                    ]
                );
            }
        } else {
            $contact->prospect->notify(new NewContactNotification());

            if ($phone_number = $contact->prospect->phone_number) {
                $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
                $client->messages->create(
                    "+33". (int)$phone_number,
                    [
                        'from' => env('TWILIO_NUMBER'),
                        'body' => 'Un statut de RDV a été modifié par un propriétaire. EasyHouse.'
                    ]
                );
            }
        }

        return response()->json([
            'message' => 'Contact updated successfully!',
            'data' => new ContactResource($contact)
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        if (Gate::denies('access-contact', $contact))
            return response()->json(['error' => 'You are not authorized to destroy this contact.'], 403);

        $contact->delete();

        return response('', 204);
    }
}
