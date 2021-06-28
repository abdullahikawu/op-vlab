<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Experiment;
use App\Models\User;
use App\Models\School;
use Illuminate\Http\Request;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;


class StatsController extends Controller
{



    public function dataAnalytics()
    {
        $courseCount = Course::count();
        

        $experimentCount = Experiment::count();        

        $school = School::first();   
        
        $studentRole = Util::$roleId['student'];
        
        $learners = intval(User::where('role_id', $studentRole)->count());

        if (!Util::hasInternetConnection()) {
            $analyticsData = -1;
        }else{
            $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));

        }


        return response()->json(['courseCount' =>$courseCount, 'experimentCount'=> $experimentCount, 'learners'=>$learners,'visits'=>$analyticsData, 'school'=>$school], 200);

    



        
    }
}