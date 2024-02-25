<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        $users = User::all();

        return Inertia::render('List', ['items' => $items, "users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Item/ItemCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $item = new Item;
        $item->description = $request->description;

        $item->save();

        $message = "Item has been successfully added";
        return redirect()->route('list')->withMessage($message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::find($id);

        return Inertia::render('Item/ItemEdit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'description' => 'description',
        ]);

        $item = Item::find($id);
        $item->description = $request->description;

        $item->save();

        $message = "Item has been successfully updated";
        return redirect()->route('list')->withMessage($message);
    }

    public function markAsBought(string $id)
    {

        $item = Item::find($id);
        $item->is_bought = 1;

        $item->save();

        $message = "Item is marked as purchased";
        return redirect()->route('list')->withMessage($message);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        $message = "Your item has been successfully deleted";
        return redirect()->route('list')->withMessage($message);
    }

    public function import()
    {
        return Inertia::render('Item/ItemsImport');
    }


    public function storeImport(Request $request)
    {
        $request->validate([
            'json' => 'required|file',
        ]);

        $json = $request->file('json');

        $jsonContent = file_get_contents($json);
        $items = json_decode($jsonContent, true);

        foreach ($items as $itemData) {
            $existingItem = Item::find($itemData['id']);

            if ($existingItem) {
                $existingItem->update([
                    'description' => $itemData['description'],
                ]);
            } else {
                Item::create([
                    'id' => $itemData['id'],
                    'description' => $itemData['description'],
                ]);
            }
        }
        $message = 'Items imported successfully';
        return redirect()->route('list')->withMessage($message);
    }


    public function export()
    {
        $items = Item::all();

        $jsonData = json_encode($items);

        $fileName = 'items_' . now()->timestamp . '.json';

        Storage::disk('public')->put($fileName, $jsonData);

        return response()->download(storage_path('app/public/' . $fileName));
    }
}
