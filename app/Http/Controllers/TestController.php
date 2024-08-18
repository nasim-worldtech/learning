<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use App\Jobs\SimpleLogMessage;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function learningQueue()
    {
        // raw queue push pop
        // Queue::pushRaw('test message', 'test');
        // $job = Queue::pop('test');
        // dd($job->getRawBody());

        // worker -> php script
        // php artisan queue:work // default queue
        // php artisan queue:work --queue=email
        // php artisan make:job SimpleLogMessage

        // Using Jobs and Queues
        // Queue::push(new SimpleLogMessage());
        for($i=0;$i<10;$i++){
            Queue::push(new SimpleLogMessage('ABC'));
        }
    }
    public function getForm()
    {
        $data['files'] = File::get();

        return view('test.upload', $data);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'disk' => 'required',
            'avatar' => 'required|mimes:jpeg,png,jpg,pdf,xlsx,xls',
        ]);

        $avatar = $request->file('avatar');
        // $path = $avatar->store();

        // dump($avatar->isValid());
        // dump($avatar->getSize());
        // dump($avatar->getMimeType());
        // dump($avatar->getClientOriginalName());
        // dd($avatar);
        // profile/hashValue

        $disk = $request->get('disk');
        File::create([
            'mimeType' => $avatar->getMimeType(),
            'original_name' => $avatar->getClientOriginalName(),
            'disk' => $disk,
            // 'path' => $avatar->store(),
            'path' => $avatar->store('profile', $disk),
            'size' => $avatar->getSize(),
        ]);

        return redirect()->back()->with('success', 'Avatar uploaded successfully');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $form)
    {
        Storage::disk($form->disk)->delete($form->path);
        $form->delete();

        return redirect()->back()->with('success', 'Avatar deleted successfully');
    }
}
