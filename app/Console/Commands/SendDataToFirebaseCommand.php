<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database\Reference;

class SendDataToFirebaseCommand extends Command
{
    protected $signature = 'send:StaticPage';

    protected $description = 'Static Pages data to Firebase';

    public function handle()
    {
        // Load Firebase credentials from environment variable
        $serviceAccount = ServiceAccount::fromJsonFile(env('FIREBASE_CREDENTIALS'));

        // Initialize Firebase factory
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri(env('FIREBASE_DATABASE_URL'))
            ->create();

        // Get a reference to the Firebase database
        $database = $firebase->getDatabase();

        // Get the latest data timestamp from Firebase
        $latestTimestamp = $database->getReference('latest_timestamp')->getValue();

        // Retrieve new data from the database table
        $newData = DB::table('static_pages')
            ->where('created_at', '>', $latestTimestamp)
            ->get();

        // Send new data to Firebase
        foreach ($newData as $data) {
            $database->getReference('your_database_path/' . $data->id)->set([
                'title' => $data->title,
                'image' => $data->image,
                'description' => $data->description,
                'category_id' => $data->category_id,
                'created_at' => $data->created_at,
            ]);
        }

        // Update the latest data timestamp in Firebase
        $latestData = DB::table('static_pages')->latest('created_at')->first();
        if ($latestData) {
            $database->getReference('latest_timestamp')->set($latestData->created_at);
        }

        $this->info('Static Pages data sent to Firebase successfully!');
    }
}
