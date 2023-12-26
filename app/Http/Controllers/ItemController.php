<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Events\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Purchase;
use App\Notifications\ItemPurchasedNotification; // Adjust the namespace as needed



class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('item.index', [
            'items' => Item::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => ['required', 'string'],
            'category' => ['required', 'string'],
            'qty' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Store the image in the 'images' directory
            $data['image_path'] = $imagePath;
        }

        $log_entry = auth()->user()->name.' has added an item to the list.';

        UserLog::dispatch($log_entry); //calling the UserLog event with dispatch method and passed the $log_entry as parameter

        $item = Item::create($data);

        return redirect('/items')->with('success', 'Item has been added to the list.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('item.show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        // dd($item);
        return view('item.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'item_name' => ['required', 'string'],
            'category' => ['required', 'string'],
            'qty' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $data = [];

        if ($request->hasFile('image')) {
            // Delete the old image file (if it exists)
            if ($item->image_path) {
                Storage::disk('public')->delete($item->image_path);
            }

            // Store the new image in the 'images' directory
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image_path'] = $imagePath;
        }

        $log_entry = auth()->user()->name.' has updated an item from the list.';

        UserLog::dispatch($log_entry); //calling the UserLog event with dispatch method and passed the $log_entry as parameter

        $item->update($data);

        return redirect('/items')->with('success', 'Item has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        $log_entry = auth()->user()->name.' has removed an item from the list.';

        UserLog::dispatch($log_entry); //calling the UserLog event with dispatch method and passed the $log_entry as parameter

        return back()->with('success', 'Item has been removed from the list.');
    }

    public function buy(Item $item)
{
    if ($item->qty > 0) {
        // Check if the user is authenticated (you may adjust this as needed)
        if (auth()->check()) {
            // Calculate the new quantity after the purchase
            $newQuantity = $item->qty - 1;

            // Calculate the amount based on the item's price
            $amount = $item->price;

            // Update the item's quantity
            $item->update(['qty' => $newQuantity]);

            // Record the purchase in your database
            $purchase = Purchase::create([
                'user_id' => auth()->user()->id,
                'item_id' => $item->id,
                'price' => $item->price,
                'amount' => $amount, // Set the 'amount' column here
            ]);

            auth()->user()->notify(new ItemPurchasedNotification($purchase));

            $log_entry = auth()->user()->name . ' has bought an item from the list.';

            UserLog::dispatch($log_entry);

            return redirect('/items')->with('success', 'Item purchased successfully.');
        } else {
            // If the user is not authenticated, you can redirect to a login page or handle it as needed
            return redirect()->route('login')->with('error', 'Please log in to make a purchase.');
        }
    } else {
        return redirect()->back()->with('error', 'Item is out of stock.');
    }
}
}
