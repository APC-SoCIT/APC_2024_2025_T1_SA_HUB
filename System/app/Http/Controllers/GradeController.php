<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StudentGrade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function gradeChecker(){
        $studGrade = StudentGrade::where('final_grade', '0.0')->get();

        if (!$studGrade) {
            $studGrade->count;
            echo 'there are'.$studGrade.' have failed';
        }else{
            echo 'No SA that has 0.0 grade';
        }
    }


}
