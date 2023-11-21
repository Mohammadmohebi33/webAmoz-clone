<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\FFMpeg\FFProbe;

class EpisodeController extends Controller
{
    public function index()
    {
        $sessions = Episode::query()->paginate(10);
        return view('panel.session.index', compact('sessions'));
    }


    public function showCourseSessions(Course $course)
    {
        $sessions = $course->sessions()->paginate(10);
        return view('panel.session.index' , compact('sessions'));
    }


    public function create()
    {
        $courses = Course::all();
        return view('panel.session.create' , compact('courses'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'course_id' => 'required',
            'video' => 'required|mimes:mp4,mov,ogg,qt|max:2000000',
            'status' => 'required'
        ]);


        $video = $data['video'];
        $videoName = md5($data['course_id']) .'-'.Str::random(15);
        $video->move(public_path('sessions') , $videoName);


        $videoPath = public_path('sessions') . '/' . $videoName;

        $ffprobe = FFProbe::create();
        $format = $ffprobe->format($videoPath);
        $duration = $format->get('duration');

        $course = Course::query()->where('id' , $data['course_id'])->first();

        $course->episodes()->create([
            'title' => $data['title'],
            'video_url' => $videoName,
            'time' => (int) $duration,
            'status' => $data['status']
        ]);
        $course->update(['time' => $course->time + $duration]);
        return to_route('session.index');
    }


    public function edit(Episode $session)
    {
        $courses = Course::all();
        return view('panel.session.edit' , compact('session', 'courses'));
    }


    public function update(Request $request, Episode $session)
    {
        $data = $request->validate([
            'title' => 'required',
            'course_id' => 'required',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:200000'
        ]);

        $session->update([
            'title' => $data['title'],
            'course_id' => $data['course_id'],
        ]);

        if ($request->hasFile('video')){
            $video = $data['video'];
            $videoName = md5($data['course_id']) .'-'.Str::random(15);

            //remove previous video
            $previousVideo = $session->video_url;
            if ($previousVideo) {
                $previousImagePath = public_path('sessions') . '/' . $previousVideo;
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }

                $video->move(public_path('sessions'), $videoName);
                $session->update(['video_url' => $videoName]);
            }
        }

        return to_route('session.index');
    }



    public function destroy(Episode $session)
    {
        $session->delete();
        return back();
    }
}
