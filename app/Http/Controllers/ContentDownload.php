<?php

namespace App\Http\Controllers;

use Response;
use Carbon\Carbon;
use App\Models\Migration;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Helpers\CommonHelper;
use Illuminate\Support\Facades\File;
use App\Models\ContentDownload as ModelsContentDownload;

class ContentDownload extends Controller
{
    public function contentUserSurveyResutCsv()
    {
        $contentId = 906;

        $memoryLimit = '512M';
        $maxExecTime = 360;
        ini_set('memory_limit', $memoryLimit);
        ini_set('max_execution_time', $maxExecTime);
        ini_set('max_input_time', $maxExecTime);
        $fileName = 'content-surveys';
        $contents = ModelsContentDownload::select(
            'content_id',
            'content_title as title',
            'start_date as open_date',
            'end_date as end_date',
            'response_date as created_at',
            'system_id as system_id',
            'cardno',
            )->where('content_id', $contentId)->groupBy('system_id')->get()->toArray();
        $AllUser = [];
        foreach ($contents as $content) {
            $content['created_at'] = Carbon::parse($content['created_at'])->locale('jp')->format('Y-m-d h:i:s');
            $currentuser = ModelsContentDownload::where('system_id', $content['system_id'])->orderBy('survay_id','ASC')->pluck('answer')->toArray();
            $answerdata = 1;
            for ($i = 0; $i < 4; $i++) {
                $content['answer' . $answerdata] = $currentuser[$i];
                $answerdata ++ ;
            }
            // $content['answers']= $currentuser;
            $AllUser[] = $content;
        }
        $dataToUseInCsv = $AllUser;
        $qustionText = trans('translation.content_surveys.questions');
        $csvHeader = trans('translation.content_surveys.result_csv_headers_test');
        for ($count = 1; $count <= 4; $count++) {
            $questionTitle['answer' . $count] = $qustionText . $count . 'の回答';
            $csvHeader = Arr::add($csvHeader, 'answer' . $count, $qustionText . $count . 'の回答');
        }
        $fileName = $fileName . '_' . $contentId . '_' . Carbon::now()->format('YmdHis');
        array_unshift($dataToUseInCsv, $csvHeader);
        return response()->streamDownload(
            function () use ($dataToUseInCsv, $contentId) {
                $handle = fopen('php://output', 'w');
                $list = $dataToUseInCsv;
                foreach ($list as $row) {
                    fputcsv($handle, CommonHelper::convertText($row));
                }
                fclose($handle);
                }, $fileName . '.csv');
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function exportCsv(Request $request)
    {
        $users = Migration::get();

        // these are the headers for the csv file.
        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Disposition' => 'attachment; filename=download.csv',
            'Expires' => '0',
            'Pragma' => 'public',
        );


        //I am storing the csv file in public >> files folder. So that why I am creating files folder
        if (!File::exists(public_path()."/files")) {
            File::makeDirectory(public_path() . "/files");
        }

        //creating the download file
        $filename =  public_path("files/download.csv");
        $handle = fopen($filename, 'w');

        //adding the first row
        fputcsv($handle, [
            "id",
            "migration",
        ]);

        //adding the data from the array
        foreach ($users as $each_user) {
            fputcsv($handle, [
                $each_user->id,
                $each_user->migration,
            ]);

        }
        fclose($handle);

        //download command
        return Response::download($filename, "download.csv", $headers);
    }
}
