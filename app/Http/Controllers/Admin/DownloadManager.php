<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ImportResultTemplate;
use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Subject;
use Maatwebsite\Excel\Facades\Excel;

class DownloadManager extends Controller
{
    // to download template for importing results 
    #################################################
    public function import_result_template($token) {
        # echo $token; ## session ** class-room ** subject
        $params = explode("**",base64_decode($token)); 
        $subject_name = Subject::name($params[2]);  ## [2]
        $filename = str_replace("/", "_", $params[0]); ## session [0]
        $filename.= "_".ClassRoom::name($params[1]);    ## [1]
        $filename.= "_".$subject_name."_Import_File.csv";  
        $filename = str_replace(" ", "_", $filename); 
        return Excel::download(new ImportResultTemplate($params[0],$params[1],$params[2]), $filename);
    }
}
