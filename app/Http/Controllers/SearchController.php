<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class SearchController extends Controller
{
    public function AdminServiceSearcher(Request $request ,$id)
    {   
        
        $One_user=($request->exists('One_user'))? 1:0;

        $Search_status=(($request->get('Search_status')=='y')
        ? 
            1 //true
            :
            (($request->get('Search_status')=='n')           // ----------
            ?                                               //||
                0                                           //||    false
                :                                           //||
                2                                          //||
            )
        );

        session([
            'Search_status' => $Search_status,
            'Search_date'   => $request->get('Search_date')??false,
            'one_user'=>$One_user
        ]);
            

       return redirect()->route('AdminHome',);
    }
}
