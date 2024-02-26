<?php 
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class ExportItems extends Command
{
    protected $signature = 'items:export';

    protected $description = 'Export items to a JSON file';

    public function handle()
    {
        $items = Item::all();

        $jsonData = json_encode($items);

        $fileName = 'items_' . now()->timestamp . '.json';

        Storage::disk('public')->put($fileName, $jsonData);

        $this->info('Items exported successfully to ' . storage_path('app/public/' . $fileName));
    }
}
