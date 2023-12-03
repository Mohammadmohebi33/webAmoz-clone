<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\FFMpeg\FFProbe;
use function back;
use function public_path;
use function request;
use function to_route;
use function view;

class EpisodeController extends Controller
{
    public function index()
    {
        if (request()->has('course_id')){
            $episodes = Course::query()->find(\request()->input('course_id'))->episodes()->paginate(10);
        }else{
            $episodes = Episode::query()->paginate(10);
        }
        $courses = Course::all();
        return view('panel.episodes.index', compact('episodes', 'courses'));
    }


    public function showCourseSessions(Course $course)
    {
        $episodes = $course->episodes()->paginate(10);
        return view('panel.episodes.index' , compact('episodes'));
    }


    public function create()
    {
        $courses = Course::all();
        return view('panel.episodes.create' , compact('courses'));
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
        return to_route('episodes.index');
    }


    public function edit(Episode $episode)
    {
        $courses = Course::all();
        return view('panel.episodes.edit' , compact('episode', 'courses'));
    }


    public function update(Request $request, Episode $episode)
    {
        $data = $request->validate([
            'title' => 'required',
            'course_id' => 'required',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:200000'
        ]);

        $episode->update([
            'title' => $data['title'],
            'course_id' => $data['course_id'],
        ]);

        if ($request->hasFile('video')){
            $video = $data['video'];
            $videoName = md5($data['course_id']) .'-'.Str::random(15);

            //remove previous video
            $previousVideo = $episode->video_url;
            if ($previousVideo) {
                $previousImagePath = public_path('sessions') . '/' . $previousVideo;
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }

                $video->move(public_path('sessions'), $videoName);
                $episode->update(['video_url' => $videoName]);
            }
        }

        return to_route('episodes.index');
    }



    public function destroy(Episode $episode)
    {
        $episode->delete();
        return back();
    }
}
