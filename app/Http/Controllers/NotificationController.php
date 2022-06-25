<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\notification;
use App\Http\Requests\StorenotificationRequest;
use App\Http\Requests\UpdatenotificationRequest;
use App\Http\Resources\NotificationResource;

class NotificationController extends Controller
{

    /**
     * It returns an array of two keys, one for read notifications and one for unread notifications
     * 
     * @return \Illuminate\Http\Response An array of read and unread notifications.
     */
    public function index()
    {
        return [
            'read' => NotificationResource::collection(User::find(auth()->user()->id)->readNotifications),
            'unread' => NotificationResource::collection(User::find(auth()->user()->id)->unreadNotifications),
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * It marks as read the notifications of the authenticated user, when the id is present in the
     * request, it filters the notifications by id
     * 
     * @param \App\Http\Requests\StorenotificationRequest  $request The request object.
     * 
     * @return \Illuminate\Http\Response A 204 No Content response.
     */
    public function markAsRead(StorenotificationRequest $request)
    {
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatenotificationRequest  $request
     * @param  \App\Models\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatenotificationRequest $request, notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(notification $notification)
    {
        //
    }
}