<?php


namespace App\Http\Controllers\Admin;
use App\Models\Candidat;

use App\Http\Controllers\Controller;


class AdminController extends Controller {
    
    public function  index(){
        $totalCandidates = Candidat::count();
        return view('admin.index', compact(
            'totalCandidates'
        ));

        
    } 

}