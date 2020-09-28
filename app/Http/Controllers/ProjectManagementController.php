<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ImplementorAgencyList;
use App\MonitoredByList;
use DB;
use App\Http\Controllers\FileController;
use PDF;
use Storage;
class ProjectManagementController extends Controller
{

    public function getImplementorAgencyList()
    {
        return ImplementorAgencyList::get();
    }
    public function create(Request $request, Project $project)
    {

        $validate = $request->validate([
                'title' => 'required',
                'control_number' => 'required|unique:projects',
                'implementing_agency' => 'required',
                'sector' => 'required',
                'project_cost' => 'required|numeric',
                'loc_municipality' => 'required',
                'fund_source' => 'required',
                'mode_of_implementation' => 'required',
        ]);

        $create = $project::create([
            'title' => $request->input('title'),
            'control_number' => $request->input('control_number'),
            'mode_of_implementation' => $request->input('mode_of_implementation'),
            'contractor' => $request->input('contractor'),
            'loc_barangay' => $request->input('loc_barangay'),
            'loc_municipality' => $request->input('loc_municipality'),
            'implementing_agency' => $request->input('implementing_agency'),
            'other_implementing_agency' => $request->input('other_implementing_agency'),
            'municipality' => $request->input('municipality'),
            'fund_source' => $request->input('fund_source'),
            'fund_source_year' => $request->input('fund_source_year'),
            'specific_fund_source' => $request->input('specific_fund_source'),
            'sector' => $request->input('sector'),
            'project_cost' => $request->input('project_cost'),
            'status' => $request->input('status'),
        ]);

        if($create)
        {
            return 'success';
        }else{
            return 'error';
        }
    }

    public function update(Request $request, Project $project)
    {
        $validate = $request->validate([
                'id' => 'required',
                'title' => 'required',
                'implementing_agency' => 'required',
                'sector' => 'required',
                'project_cost' => 'required|numeric',
                'loc_municipality' => 'required',
                'fund_source' => 'required',
                'mode_of_implementation' => 'required',
        ]);

        $update = $project::where('id', $request->input('id'))
                            ->update([
                                        'title' => $request->input('title'),
                                        'mode_of_implementation' => $request->input('mode_of_implementation'),
                                        'contractor' => $request->input('contractor'),
                                        'loc_barangay' => $request->input('loc_barangay'),
                                        'loc_municipality' => $request->input('loc_municipality'),
                                        'implementing_agency' => $request->input('implementing_agency'),
                                        'other_implementing_agency' => $request->input('other_implementing_agency'),
                                        'municipality' => $request->input('municipality'),
                                        'fund_source' => $request->input('fund_source'),
                                        'fund_source_year' => $request->input('fund_source_year'),
                                        'specific_fund_source' => $request->input('specific_fund_source'),
                                        'sector' => $request->input('sector'),
                                        'project_cost' => $request->input('project_cost'),
                                        'status' => $request->input('status'),
                                ]);
        if($update)
        {
            return 'success';
        }else{
            return 'error';
        }           
    }

    public function delete(Request $request, Project $project)
    {
        $validate = $request->validate([
            'id' => 'required'
        ]);

        $delete = $project::where('id', $request->input('id'))->delete();
        if($delete)
        {
            return 'success';
        }else{
            return 'error';
        }
    }

    public function get(Project $project)
    {
        return $project::join('monitored_by_lists', 'monitored_by_lists.id','=','projects.monitored_by')->select('projects.*','monitored_by_lists.monitor as monitored_by')->orderBy('id', 'DESC')->get();
    }

    public function find(Request $request, Project $project)
    {
        $validate = $request->validate([
            'id' => 'required'
        ]);

        $info = $project::where('id', $request->input('id'))
                        ->first();
        return $info;
    }

    public function getMonitoringList()
    {
        return MonitoredByList::get();
    }
    public function updateMonitor(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'monitored_by' => 'required',
            'date_monitored' => 'required',
        ]);

        $update = Project::where('id', $request->input('id'))
                            ->update([
                                'monitored_by' => $request->input('monitored_by'),
                                'date_monitored' => $request->input('date_monitored'),
                                'monitoring_status' => 1,
                            ]);
        return 'success';
    }

    public function updateLink(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $update =Project::where('id', $request->input('id'))
                    ->update(['link' => $request->input('link')]);

        return 'success';
    }

    public function print_report(Request $request)
    {

        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', 600);

        $report_fields = [];
        if($request->input('control_number') == "control_number")
        {
            $report_fields[] = "control_number";
        }
        if($request->input('title') == "title")
        {
            $report_fields[] = "title";
        }
        if($request->input('location') == "location")
        {
            $report_fields[] = "location";
        }
        if($request->input('project_cost') == "project_cost")
        {
            $report_fields[] = "project_cost";
        }
        if($request->input('fund_source') == "fund_source")
        {
            $report_fields[] = "fund_source";
        }
        if($request->input('mode_of_implementation') == "mode_of_implementation")
        {
            $report_fields[] = "mode_of_implementation";
        }

        if($request->input('contractor') == "contractor")
        {
            $report_fields[] = "contractor";
        }

        if($request->input('date_monitored') == "date_monitored")
        {
            $report_fields[] = "date_monitored";
        }
        
        if($request->input('field_month') == "month")
        {
            $report_fields[] = "field_month";
        }
        if($request->input('field_year') == "year")
        {
            $report_fields[] = "field_year";
        }

        
        if($request->input('monitored_by') == "monitored_by")
        {
            $report_fields[] = "monitored_by";
        }


        

        $quarter[0] = [1,2,3,4,5,6,7,8,9,10,11,12];
        $quarter[1] = [1,2,3];
        $quarter[2] = [4,5,6];
        $quarter[3] = [7,8,9];
        $quarter[4] = [10,11,12];
        $quarter_number = 0;
        $month_selected = 0;
        $project = [];
        $type = 0;
        $monitoring_team = $request->input('monitoring_team');
        $year = 0;

        $selected_quarter = [];

        switch ($request->input('report_type')) {
            case "0":
                 $month_selected = $request->input('month');
                 $type = 1;
                break;
            case "1":
                $quarter_number = $request->input('quarter');
                $year = $request->input('quarter_year');
                $type = 3;
                $selected_quarter = $quarter[$request->input('quarter')];
                break;
            case "2":
                $year = $request->input('year');
                $type = 2;
                break;
        }

        $project = Project::where(function($query) use ($request, $monitoring_team, $selected_quarter, $year){

                 switch ($request->input('report_type')) {
                    case "0":
                        $month_selected = $request->input('month');
                        $month = date("n", strtotime($month_selected));
                        $year = date("o", strtotime($month_selected));

                        $query->whereMonth('date_monitored', $month);
                        $query->whereYear('date_monitored', $year);
                        break;
                    case "1":
                        $query->whereIn(DB::raw('MONTH(date_monitored)'), $selected_quarter);
                        $query->whereYear('date_monitored', $year);
                        break;
                    case "2":
                        $query->whereYear('date_monitored', $request->input('year'));
                        break;
                    case "all":
                        break;
                }


                if($request->input('municipality') != "")
                {
                    $query->where('loc_municipality', $request->input('municipality'));
                }

                if($monitoring_team != "")
                {
                    $query->where('monitored_by', $monitoring_team);
                }

                if($request->input('fund_sources') != "")
                {
                    $query->where('fund_sources', $request->input('fund_sources'));
                }

                if($request->input('fund_source_year') != "")
                {
                    $query->where('fund_source_year', $request->input('fund_source_year'));
                }
            })
            ->where('monitoring_status', 1)
            ->with('rel_implementing_agency', 'rel_municipality', 'rel_monitor_by','location_barangay', 'location_municipality')
            ->get();
            // ->toSql();

        // dd($request->input('fund_sources'));
        $arrs = [];

        // foreach ($project as $value) {
        //     $mode_of_implementation = "";
        //     if($value->mode_of_implementation == 0)
        //     {
        //         $mode_of_implementation = "By Contract";
        //     }else{
        //         $mode_of_implementation = "By Administration";
        //     }
        //     $location = "";
        //     if(!!$value->location_barangay)
        //     {
        //         $location .= $value->location_barangay->barangay . ", ";
        //     }
        //     $arrs[] = [
        //         'title' => $value->title,
        //         'location' => $location . $value->location_municipality->municipality ?? "",
        //         'project_cost' => 'PHP ' . $value->project_cost,
        //         'fund_source' => $this->fund_source($value->fund_source, $value->specific_fund_source) . ' (' . $value->fund_source_year . ')',
        //         'mode_of_implementation' => $mode_of_implementation,
        //         'contractor' => $value->contractor ?? "-",
        //         'field_month' => date('F', strtotime($value->date_monitored)),
        //         'field_year' => date('Y', strtotime($value->date_monitored)),
        //         'monitored_by' => $value->rel_monitor_by->monitor ?? "Not set",
        //     ];
        // }
        // 

        return view('print.project', compact('arrs','report_fields','type','quarter_number','month_selected','year', 'project'));
        $pdf = PDF::loadView('print.project', compact('arrs','report_fields','type','quarter_number','month_selected','year','project'));
        $pdf->setPaper($request->input('paper_size'), $request->input('page_orientation'));
        // dd($arrs);
        return $pdf->download('project_' . date('dmyGis') .'.pdf');
    }
    public static function fund_source($fund_source, $others)
    {
        $fund_source -= 1;
        $arr = [
            "20% Development Fund",
            "General Fund",
            "Special Education Fund",
            "Trust Fund",
            "Performance Challenge Fund",
            "Local Government Support Fund",
            "Others",
        ];

        if($fund_source == 6)
        {
            return $arr[$fund_source] . ' ' . $others;
        }

        return $arr[$fund_source];
    }

    public function uploadAttachedFiles(Request $request)
    {
        ini_set('post_max_size', '128M');
        ini_set('memory_limit', '128M');
        ini_set('upload_max_filesize', '128M');


        $control_number = $request->input('control_number');
        // $files = $request->input('files');
        $files = $request->file('files');
        
        $make_directory = mkdir('/');
        foreach ($files as $value) {
            Storage::disk('public')->putFileAs('/'. $control_number, $value, $value->getClientOriginalName());
            // Storage::disk('public')->put('/'. $control_number . "/" . $value->getClientOriginalName(), $value, 'public');
            // FileController::uf_base64($value,'/' . $control_number, $value->getClientOriginalName());
        }
        return "success";
    }
    public function getAttachedFile(Request $request)
    {
        $control_number = $request->input('control_number');
        $files_list = Storage::disk('public')->allFiles("/".$control_number . '/');
        $arr = [];
        foreach ($files_list as $list) {
            $link = Storage::disk('public')->url($list);
            $arr[] = $this->fileInfo(pathinfo($link), Storage::url($list));
        }
        return $arr;
    }
    public function getInfo(Request $request)
    {
        $id = $request->input('id');
        return Project::with('location_barangay', 'location_municipality')->where('id', $id)->first();
    }



    public function fileInfo($file, $link)
    {
        $arr = [];
        $arr["filename"] = $file["filename"];
        $arr['extension'] = $file["extension"];
        $arr["url"] = $link;
        return $arr;
    }

    public function getFundSourceYear()
    {
        return Project::whereNotNull('fund_source_year')
                        ->groupBy('fund_source_year')
                        ->select('fund_source_year')
                        ->get();
    }

    public function removeFile(Request $request)
    {
        $url = $request->input('url');
        $url = str_replace("/storage/", "", $url);
        Storage::disk('public')->delete($url);
        return $url;
    }
}
