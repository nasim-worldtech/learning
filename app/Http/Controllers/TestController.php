<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Models\File;
use App\Models\User;
use Illuminate\Bus\Batchable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    use Batchable;
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
        // Queue::push(new SimpleLogMessage('ABC'));
        // dispatch(new SimpleLogMessage('DEF'));
        // Bus::dispatch(new SimpleLogMessage('GHI'));
        // SimpleLogMessage::dispatch('JKL')->onQueue('email');

        // $post = Post::query()->first();
        // NewPostNotification::dispatch($post)->onQueue('subscription');

        // Initialize an empty array to hold the jobs
        $jobs = [];

        // Use chunking to handle large datasets efficiently
        User::chunk(100, function ($users) use (&$jobs) {
            foreach ($users as $user) {
                $jobs[] = new SendMailJob($user);
            }

            // Dispatch the batch once the chunk processing is done
            Bus::batch($jobs)
                ->name('Send Mail Batch')
                ->dispatch();
        });

        dump('success');
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
