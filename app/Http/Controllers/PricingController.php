<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use Illuminate\Http\Request;
use App\Helpers\CommonHelper;
use Illuminate\Support\Facades\Storage;

class PricingController extends Controller
{
    //
    public function index()
    {
        $results = Pricing::all();
        $formatDate = "Y" . (__("admin.common.year")) . "n" . (__("admin.common.month")) . "j" . (__("admin.common.day"));
        $filename = 'pricings-list_' . (date("YmdHis")) . '_' . microtime(true) . '.csv';
        $handle = fopen(public_path($filename), 'w+');
        $header = [];
        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_id")));
        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_title")));
        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_open_date")));
        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_close_date")));
        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_period_start")));
        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_period_end")));

        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_distribution_target_type")));
        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_target")));
        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_distribution_media_type")));
        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_quantity_amount")));
        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_quantity_limit")));
        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_must_amount")));
        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_count_limit")));
        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_point")));
        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_logic")));

        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_jan_count")));
        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_jan_code")));
        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_product_name")));
        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_unit")));

        array_push($header, CommonHelper::convertText(__("admin.pricing.csv_label_delivery_setting")));
        fputcsv($handle, $header);
        foreach ($results as $item) {
            $record = [];
            // $id= $item
            $openDate = CommonHelper::formatDatetimeByStyle($item->open_date, $formatDate);
            $openDateText = !empty($openDate) ? CommonHelper::convertText($openDate) : '';
            $closeDate = CommonHelper::formatDatetimeByStyle($item->close_date, $formatDate);
            $closeDateText = !empty($closeDate) ? CommonHelper::convertText($closeDate) : '';

            $startDate = CommonHelper::formatDatetimeByStyle($item->period_start, $formatDate);
            $startDateText = !empty($startDate) ? CommonHelper::convertText($startDate) : '';
            $endDate = CommonHelper::formatDatetimeByStyle($item->period_end, $formatDate);
            $endDateText = !empty($endDate) ? CommonHelper::convertText($endDate) : '';
            $deliveryConditionSetting = trans('admin.common.normal');
            $mediaName = 'rabi media';
            array_push($record, $item->id);
            array_push($record, CommonHelper::convertText($item->title));
            array_push($record, $openDateText);
            array_push($record, $closeDateText);
            array_push($record, $startDateText);
            array_push($record, $endDateText);
            array_push($record, CommonHelper::convertText($distributionTargetType[$item->distribution_target_type] ?? ''));
            array_push($record, CommonHelper::convertText($targetList[$item->target] ?? '')); //H
            array_push($record, CommonHelper::convertText(trim($mediaName, ', ')));

            $janboxes = $item->janboxes;
            $janboxes = $janboxes != null ? json_decode($janboxes) : [];
            $logicText = CommonHelper::convertText($logicOption[$item->logic] ?? '');
            $point = $item->point;
            $janboxCount = $item->janbox_count;
            $deliveryConditionSettingText = CommonHelper::convertText($deliveryConditionSetting ?? null);
            $mustAmount = $item->must_amount;
            $quantityLimitText = CommonHelper::convertText($quantityLimitList[$item->quantity_limit] ?? '');
            $countLimitText = CommonHelper::convertText($countLimitList[$item->count_limit] ?? '');
            if (empty($janboxes)) {
                array_push($record, '');
                array_push($record, $quantityLimitText); //
                array_push($record, $mustAmount);
                array_push($record, $countLimitText); //J count_limit
                array_push($record, $point);
                array_push($record, $logicText);
                array_push($record, $janboxCount);
                array_push($record, null);
                array_push($record, null);
                array_push($record, null);
                array_push($record, $deliveryConditionSettingText);
                fputcsv($handle, $record);
            } else {
                foreach ($janboxes as $productData) {
                    $recordProduct = $record;
                    $testdata = [];
                    $janType = $productData->jan_type ?? Pricing::JAN_TYPE_NONE;
                    $mustAmount = '';
                    $quantity = '';
                    $amount = '';
                    if ($janType == Pricing::JAN_TYPE_NONE) {
                        $mustAmount = $item->must_amount;
                    } else {
                        $quantity = $productData->quantity > 0 ? $productData->quantity : '';
                        $amount = $productData->amount > 0 ? $productData->amount : '';
                    }
                    array_push($recordProduct, $amount ? $amount : $quantity);
                    array_push($recordProduct, $quantityLimitText); //
                    array_push($recordProduct, $mustAmount);
                    array_push($recordProduct, $countLimitText); //J count_limit
                    array_push($recordProduct, $point);
                    array_push($recordProduct, $logicText);

                    array_push($testdata, $janboxCount);

                    array_push($testdata, $amount ? $amount : $quantity);
                    array_push($testdata, $quantityLimitText); //
                    array_push($testdata, $mustAmount);
                    array_push($testdata, $countLimitText); //J count_limit
                    array_push($testdata, $point);
                    array_push($testdata, $logicText);

                    array_push($testdata, $janboxCount);


                    $productList = $productData->products ?? [];
                    $productCsvIndex = count($recordProduct);
                    if ($item->id == "4770") {
                        // dd($productList,$janboxes,$productData);
                    }
                    if (isset($productData->specify_type) && $productData->specify_type != 2) {
                        if (!empty($productList)) {
                            foreach ($productList as $p) {
                                $recordProduct[$productCsvIndex] = $p->jancode ?? null;
                                $recordProduct[$productCsvIndex + 1] = CommonHelper::convertText($p->name ?? null);
                                $recordProduct[$productCsvIndex + 2] = $p->unit ?? null;
                                $recordProduct[$productCsvIndex + 3] = $deliveryConditionSettingText;

                                $testdata[$productCsvIndex] = $p->jancode ?? null;
                                $testdata[$productCsvIndex + 1] = CommonHelper::convertText($p->name ?? null);
                                $testdata[$productCsvIndex + 2] = $p->unit ?? null;
                                $testdata[$productCsvIndex + 3] = $deliveryConditionSettingText;


                                fputcsv($handle, $recordProduct);
                            }
                        } else {
                            array_push($recordProduct, null);
                            array_push($recordProduct, null);
                            array_push($recordProduct, null);
                            array_push($recordProduct, $deliveryConditionSettingText);


                            array_push($testdata, null);
                            array_push($testdata, null);
                            array_push($testdata, null);
                            array_push($testdata, $deliveryConditionSettingText);

                            fputcsv($handle, $recordProduct);
                        }
                    } else {
                        array_push($recordProduct, null);
                        array_push($recordProduct, null);
                        array_push($recordProduct, null);
                        array_push($recordProduct, $deliveryConditionSettingText);

                        array_push($testdata, null);
                        array_push($testdata, null);
                        array_push($testdata, null);
                        array_push($testdata, $deliveryConditionSettingText);

                        fputcsv($handle, $recordProduct);
                    }
                }
            }
        }
        dd($record,$testdata);
        fclose($handle);
        Storage::disk(config('filesystems.temporary'))->put($filename, file_get_contents(public_path($filename)));
        unlink(public_path($filename));
        $fileName = $filename;
        $path = Storage::disk(config('filesystems.temporary'))->path($fileName);
        $file = file_get_contents($path);
        Storage::disk(config('filesystems.temporary'))->delete($fileName);
        return response()->streamDownload(function () use ($file) {
            echo $file;
        }, $fileName);
    }
}
