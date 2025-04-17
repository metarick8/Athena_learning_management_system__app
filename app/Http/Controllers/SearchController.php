<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Subscription;
use App\Models\Tutor;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function TutorSearch(Request $request, $id)
    {
        return response()->json([
            "message" => "No Results"
        ]);
    }
    public function CourseSearch(Request $request)
    {
        $query = $request->quary;
        $pricedir = 'asc';
        $pricedir = $request->price ;//asc desc null
        if($pricedir=== null)
        $pricedir=0;
        elseif($pricedir==='desc')
        $pricedir=-1;
        else
        $pricedir=1;
        $difficulty = $request->difficulty;
        $categoryName = $request->category;
        $category = Category::where('name', $categoryName)->first();

        $ratingdir = $request->rating;//asc desc null
        if($ratingdir=== null)
        $ratingdir=0;
        elseif($ratingdir==='desc')
        $ratingdir=-1;
        else
        $ratingdir=1;
        $populardir = $request->popular;//asc desc null
        if($populardir=== null)
        $populardir=0;
        elseif($populardir==='desc')
        $populardir=-1;
        else
        $populardir=1;
        $Results = Course::where('title', 'like', '%' . $query . '%')
            ->when($category, function ($query, $category) {
                return $query->where('category_id', $category->category_id);
            })
            ->when($difficulty, function ($query, $difficulty) {
                return $query->where('level', $difficulty);
            })
            // ->orderBy('price', $pricedir)
            // ->orderBy('rate',$ratingdir)
            ->get();
        $arr = array();
        for ($i = 0; $i < count($Results); $i++) {
            $arr[$i] = [
                'price' => $pricedir * $Results[$i]['price'],
                'rate' => $ratingdir * $Results[$i]['rate'],
                'Subscribers' => $populardir * $Results[$i]['Subscribers'],
                'index' => $i
            ];
        }
        sort($arr);
        $Res = array();
        for ($i = 0; $i < count($arr); $i++) {
            $Res[$i] = $Results[$arr[$i]['index']];
        }
        return response()->json($Res);
    }
}
