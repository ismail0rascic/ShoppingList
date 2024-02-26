<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImportItems extends Command
{
    protected $signature = 'items:import {file}';

    protected $description = 'Import items from a JSON file';

    public function handle()
    {
        $json = $this->argument('file');

        $jsonContent = file_get_contents($json);
        $items = json_decode($jsonContent, true);

        if ($items === null && json_last_error() !== JSON_ERROR_NONE) {
            $this->error('JSON is not valid.');
            return;
        }

        foreach ($items as $itemData) {
            if (!isset($itemData['id']) || !isset($itemData['description']) || !isset($itemData['created_user_id']) || !isset($itemData['created_at']) || !isset($itemData['updated_at'])) {
                $this->error('JSON is not valid. Some elements are missing.');
                return;
            }

            $existingItem = Item::find($itemData['id']);

            if ($existingItem) {
                $existingItem->update([
                    'description' => $itemData['description'],
                ]);
            } else {
                $currentUserId = Auth::id();
                $user = User::find($itemData['created_user_id']);
                $createdUserId = $user ? $itemData['created_user_id'] : $currentUserId;

                Item::insert([
                    'id' => $itemData['id'],
                    'description' => $itemData['description'],
                    'created_user_id' => $createdUserId,
                    'is_bought' => $itemData['is_bought'],
                     'created_at' => Carbon::parse($itemData['created_at']),
                     'updated_at' => Carbon::parse($itemData['updated_at'])
                ]);
            }
        }

        $this->info('Items imported successfully');
    }
}
