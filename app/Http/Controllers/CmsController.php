<?php

namespace App\Http\Controllers;

use App\Models\CmsPage;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function index()
    {
        $pages = CmsPage::all();
        
        // If no pages exist, seed them
        if ($pages->isEmpty()) {
            $defaultPages = [
                ['title' => 'Hero Banner', 'slug' => 'hero-banner'],
                ['title' => 'Clients', 'slug' => 'clients'],
                ['title' => 'Services', 'slug' => 'services'],
                ['title' => 'Packages', 'slug' => 'packages'],
                ['title' => 'Gallery', 'slug' => 'gallery'],
                ['title' => 'Contact', 'slug' => 'contact'],
            ];

            foreach ($defaultPages as $page) {
                CmsPage::create($page);
            }
            $pages = CmsPage::all();
        }

        return view('cms.index', compact('pages'));
    }

    public function edit($slug)
    {
        $page = CmsPage::where('slug', $slug)->firstOrFail();
        return view('cms.edit', compact('page'));
    }

    public function update(Request $request, $slug)
    {
        $page = CmsPage::where('slug', $slug)->firstOrFail();
        $oldContent = json_decode($page->content, true) ?: [];

        $rules = [
            'title' => 'required|string|max:255',
        ];
        
        $validated = $request->validate($rules);
        $contentData = $request->except(['_token', '_method', 'title', 'content_image', 'item_images']);

        // Handle items/lists specifically
        if (isset($contentData['items']) && is_array($contentData['items'])) {
            $items = $contentData['items'];
            
            // Remove the _exists helper key and handle array-like strings (like features in packages)
            foreach ($items as $index => $item) {
                if (isset($item['_exists'])) {
                    unset($items[$index]['_exists']);
                }
                
                // Special case for packages features which might be sent as comma-separated or newline-separated string
                if (isset($item['features']) && is_string($item['features'])) {
                    $items[$index]['features'] = array_filter(array_map('trim', explode("\n", $item['features'])));
                }
            }

            // Handle image uploads for items
            if ($request->hasFile('item_images')) {
                $images = $request->file('item_images');
                foreach ($images as $index => $file) {
                    if ($file && $file->isValid()) {
                        $path = $file->store('cms', 'public');
                        $items[$index]['image'] = $path;
                    }
                }
            }

            // Merge with existing images if not re-uploaded
            if (isset($oldContent['items'])) {
                foreach ($items as $index => $item) {
                    if (isset($oldContent['items'][$index])) {
                        // Preserve existing image if no new one uploaded
                        if (!isset($items[$index]['image']) && isset($oldContent['items'][$index]['image'])) {
                            $items[$index]['image'] = $oldContent['items'][$index]['image'];
                        }
                    }
                }
            }
            
            $contentData['items'] = array_values($items);
        }

        // Handle Hero Banner slides specifically
        if ($slug === 'hero-banner' && isset($contentData['slides']) && is_array($contentData['slides'])) {
            $slides = $contentData['slides'];
            
            if ($request->hasFile('slide_images')) {
                $images = $request->file('slide_images');
                foreach ($images as $index => $file) {
                    if ($file && $file->isValid()) {
                        $path = $file->store('cms', 'public');
                        $slides[$index]['image'] = $path;
                    }
                }
            }

            if (isset($oldContent['slides'])) {
                foreach ($slides as $index => $slide) {
                    if (isset($oldContent['slides'][$index])) {
                        if (!isset($slides[$index]['image']) && isset($oldContent['slides'][$index]['image'])) {
                            $slides[$index]['image'] = $oldContent['slides'][$index]['image'];
                        }
                    }
                }
            }
            $contentData['slides'] = array_values($slides);
        }

        // Handle single image upload (for sections that might use it)
        if ($request->hasFile('content_image')) {
            $path = $request->file('content_image')->store('cms', 'public');
            $contentData['image'] = $path;
        } elseif (isset($oldContent['image'])) {
            $contentData['image'] = $oldContent['image'];
        }

        $page->title = $validated['title'];
        $page->content = json_encode($contentData);
        $page->save();

        return redirect()->route('cms.index')->with('success', 'Konten ' . $page->title . ' berhasil diperbarui.');
    }
}