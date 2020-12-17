<?php

namespace NotificationChannels\ExpoPushNotifications\Repositories;

use ExponentPhpSDK\ExpoRepository;
use NotificationChannels\ExpoPushNotifications\Models\Interest;

class ExpoDatabaseDriver implements ExpoRepository
{
    /**
     * Stores an Expo token with a given identifier.
     *
     * @param $key
     * @param $value
     *
     * @return bool
     */
    public function store($key, $value): bool
    {
        $interest = Interest::firstOrCreate([
            'expo_token' => $value,
        ]);

        return $interest instanceof Interest;
    }

    /**
     * Retrieves an Expo token with a given identifier.
     *
     * @param string $key
     *
     * @return array
     */
    public function retrieve(string $key)
    {
        return Interest::where('id', $key)->first()->pluck('expo_token')->toArray();
    }

    /**
     * Removes an Expo token with a given identifier.
     *
     * @param string $key
     * @param string $value
     *
     * @return bool
     */
    public function forget(string $key, string $value = null): bool
    {
        $query = Interest::where('id', $key);

        if ($value) {
            $query->where('expo_token', $value);
        }

        return $query->delete() > 0;
    }
}
