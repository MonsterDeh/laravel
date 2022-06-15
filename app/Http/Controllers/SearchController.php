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
        // dd($request->get('Search_date'),$request->all());
        
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
            'Search_date'   => $request->get('Search_date')??false
        ]);
            

       return redirect()->route('AdminHome',);
    }
}
