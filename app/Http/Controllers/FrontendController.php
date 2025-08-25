<?php

namespace App\Http\Controllers;

use App\Models\ProjectCase;
use App\Models\News;
use App\Models\Contact;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function home()
    {
        $featuredCases = ProjectCase::with('casePhotos')
            ->where('status', true)
            ->latest()
            ->take(6)
            ->get();

        $latestNews = News::where('is_active', true)
            ->latest('created_at')
            ->take(3)
            ->get();

        $sliders = Slider::where('is_active', true)
            ->orderBy('sort')
            ->get();

        return view(
            'home',
            compact(
                'featuredCases',
                'latestNews',
                'sliders'
            )
        );
    }

    public function cases(Request $request)
    {
        $query = ProjectCase::with('casePhotos')->where('status', true);

        // Sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'name':
                $query->orderBy('name');
                break;
            default:
                $query->latest();
                break;
        }

        $cases = $query->paginate(9);

        return view('cases', compact('cases'));
    }

    public function caseDetail($id)
    {
        $case = ProjectCase::with(['casePhotos' => function ($query) {
            $query->orderBy('sort_order');
        }])->where('status', true)->findOrFail($id);

        // 取得其他相關案例（排除當前案例）
        $relatedCases = ProjectCase::with('casePhotos')
            ->where('status', true)
            ->where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();

        return view('case-detail', compact('case', 'relatedCases'));
    }

    public function news(Request $request)
    {
        $query = News::where('is_active', true);

        $news = $query->latest('created_at')->paginate(9);

        return view('news', compact('news'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function storeContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'privacy' => 'required|accepted',
        ], [
            'name.required' => '請輸入姓名',
            'email.required' => '請輸入電子郵件',
            'email.email' => '請輸入有效的電子郵件格式',
            'subject.required' => '請輸入主旨',
            'message.required' => '請輸入訊息內容',
            'privacy.required' => '請同意隱私政策',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Contact::create($request->all());

        return back()->with('success', '訊息已成功發送，我們會盡快回覆您！');
    }

    // API endpoints for AJAX requests
    public function getCase($id)
    {
        $case = ProjectCase::with('casePhotos')->findOrFail($id);

        return response()->json([
            'id' => $case->id,
            'name' => $case->name,
            'sub_name' => $case->sub_name,
            'url' => $case->url,
            'content' => $case->content,
            'status' => $case->status,
            'created_at' => $case->created_at,
            'case_photos' => $case->casePhotos->map(function ($photo) {
                return [
                    'id' => $photo->id,
                    'image' => $photo->image,
                    'sort_order' => $photo->sort_order,
                ];
            }),
        ]);
    }

    public function getNews($id)
    {
        $news = News::findOrFail($id);

        return response()->json([
            'id' => $news->id,
            'title' => $news->title,
            'content' => $news->content,
            'image' => $news->image,
            'published_at' => $news->published_at,
            'is_active' => $news->is_active,
        ]);
    }
}
 