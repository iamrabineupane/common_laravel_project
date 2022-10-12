<?php

 // use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentDownload;
use App\Http\Controllers\PricingController;
Route::get('/content_download_for', [ContentDownload::class, 'contentUserSurveyResutCsv'])->name("content_download_for");
Route::get('/pricing/index', [PricingController::class, 'index'])->name("pricing.index");
Route::get('/migration_download', [ContentDownload::class, 'exportCsv'])->name("migration_download");
Route::get('/', function () {
    return view('welcome');
});

// use Illuminate\Routing\Router;

// Route::group([
//     'prefix'        => config('admin.route.prefix'),
//     'namespace'     => config('admin.route.namespace'),
// ], function (Router $router) {

    // Route::group([
    //     'middleware'    => config('admin.route.middleware'),
    // ], function (Router $router) {
    //     /* @var \Illuminate\Routing\Router $router */
    //     $authController = config('admin.auth.controller');
    //     $router->get('auth/login', $authController.'@getLogin')->name("auth.login");
    //     $router->post('auth/login', $authController.'@postLogin');
    //     $router->get('auth/logout', $authController.'@getLogout');
    //     $router->get('auth/setting', $authController.'@getSetting')->name("auth.setting");
    //     $router->put('auth/setting', $authController.'@putSetting');

        // Route::group([
        //     'middleware'    => "admin.access_page_by_company_version",
        // ], function (Router $router) {
        //     $router->get('/', 'HomeController@index')->name('admin.home');
        //     $router->get('/notice/{id}', 'HomeController@show')->name('admin.notice.detail');

        //     /* @var \Illuminate\Routing\Router $router */
        //     $router->resource('auth/administrators', 'SystemUserController')->names('admin.auth.users')->middleware('admin.log_data');
        //     $router->resource('auth/roles', 'RoleController')->names('admin.auth.roles');
        //     $router->resource('auth/permissions', 'PermissionController')->names('admin.auth.permissions');
        //     $router->resource('auth/menu', 'MenuController')->names('admin.auth.menu');
        //     $router->resource('auth/logs', 'LogController', ['only' => ['index', 'destroy', 'show']])->names('admin.auth.logs');

        //     $router->post('_handle_form_', '\Encore\Admin\Controllers\HandleController@handleForm')->name('admin.handle-form');
        //     $router->post('_handle_action_', 'HandleController@handleAction')->name('admin.handle-action');

        //     $router->resource('companies', 'CompanyController');
        //     $router->post('companies/restore/{id}', 'CompanyController@restore')->name('companies.restore');
        //     $router->post('companies/upload-logo-css-temp', 'CompanyController@uploadAdminLogoCssTemp')->name("companies.upload-admin-logo-css-temp");
        //     $router->post('companies/delete-logo-css-temp', 'CompanyController@deleteAdminLogoCssTemp')->name("companies.delete-admin-logo-css-temp");
        //     $router->get('companies/download-css/{id}', 'CompanyController@downloadCss')->name("companies.download-css");

        //     // route for medias
        //     $router->resource('medias', 'MediaController');
        //     $router->resource('medias/{media_id}/outer_api', 'ApiClientKeysController')->except([ "edit", 'update','delete']);
        //     $router->post('medias/{media_id}/outer_api/create', 'ApiClientKeysController@create')->name("medias.outer-api-create");
        //     $router->post('medias/{media_id}/outer_api/update', 'ApiClientKeysController@update')->name("medias.outer-api-update");
        //     $router->post('medias/{media_id}/outer_api/delete', 'ApiClientKeysController@delete')->name("medias.outer-api-delete");

        //    $router->post('medias/upload-service-logo', 'MediaController@uploadServiceLogoTmp')->name("medias.upload-service-logo-temp");
        //    $router->post('medias/delete-service-logo', 'MediaController@deleteServiceLogo')->name("medias.delete-service-logo-temp");

        //     $router->resource('notifications', 'NotificationController');
        //     $router->post('notifications/upload-image-temp', 'NotificationController@uploadImageTemp')->name("notifications.upload-image-temp");
        //     $router->post('notifications/delete-image-temp', 'NotificationController@deleteImageTemp')->name("notifications.delete-image-temp");

        //     $router->resource('company_functions', 'CompanyFunctionController');

        //     $router->resource('contents', 'ContentController');
        //     $router->resource('category-contents', 'ContentCategoryController');
        //     $router->post('contents/download', 'ContentController@download')->name("contents.download");
        //     $router->any('report-contents/list', 'ContentController@reportList')->name("contents.report.list");
        //     $router->get('report-contents/detail/{id}', 'ContentController@reportDetail')->name("contents.report.detail");
        //     $router->post('report-contents/detail/download', 'ContentController@reportDetailDownload')->name("contents.report.detail.download");
        //     $router->post('contents/copy/{id}', 'ContentController@copy')->name("contents.copy");
        //     $router->post('contents/action/delivery/{id}', 'ContentController@delivery')->name("contents.delivery");
        //     $router->post('contents/unsubscribe/{id}', 'ContentController@unsubscribe')->name("contents.unsubscribe");
        //     $router->post('contents/upload-image-temp', 'ContentController@uploadImageTemp')->name("contents.upload-image-temp");
        //     $router->post('contents/delete-image-temp', 'ContentController@deleteImageTemp')->name("contents.delete-image-temp");
        //     $router->resource('content-delivery', 'ContentDeliveryController')->only(['update', 'edit']);
        //     $router->post('contents/delivery/htmlProductList', 'ContentDeliveryController@htmlProductList')->name("contents.delivery.html_product_list");
        //     $router->get('contents/download-membercart-error/{id}', 'ContentDeliveryController@downloadErrorCarNoFile')->name("contents.delivery.download-membercart-error");
        //     $router->get('contents_user_survey_resut_csv/{id}', 'ContentUserSurveyController@contentUserSurveyResutCsv')->name("content.user.survey.result.csv");
        //     $router->get('contents/{contentId}/jobs/{jobId}/download', 'ContentDeliveryController@downloadJobErrorList')->name("contents.delivery.download_job_error_list");
        //     $router->post('contents/{contentId}/jobs/{jobId}/confirmed', 'ContentDeliveryController@confirmedJob')->name("contents.delivery.confirmed_job");
        //     $router->get('qrcode/download', 'QrcodeController@index')->name("qrcode.download");

        //     $router->resource('features', 'FeatureController');
        //     $router->post('features/copy/{id}', 'FeatureController@copy')->name("features.copy");
        //     $router->post('features/action/delivery/{id}', 'FeatureController@delivery')->name("features.delivery");
        //     $router->post('features/unsubscribe/{id}', 'FeatureController@unsubscribe')->name("features.unsubscribe");
        //     $router->resource('feature-delivery', 'FeatureDeliveryController')->only(['update', 'edit']);

        //     $router->resource('services', 'ServiceController');
        //     $router->post('services/copy/{id}', 'ServiceController@copy')->name("services.copy");
        //     $router->post('services/action/delivery/{id}', 'ServiceController@delivery')->name("services.delivery");
        //     $router->post('services/unsubscribe/{id}', 'ServiceController@unsubscribe')->name("services.unsubscribe");
        //     $router->resource('service-delivery', 'ServiceDeliveryController')->only(['update', 'edit']);

        //     $router->resource('system-information', 'SystemInformationController');
        //     $router->post('system-information/upload-image-temp', 'SystemInformationController@uploadImageTemp')->name("system-information.upload-image-temp");
        //     $router->post('system-information/delete-image-temp', 'SystemInformationController@deleteImageTemp')->name("system-information.delete-image-temp");

        //     $router->resource('store', 'StoreController');
        //     $router->get('store/download/{chainId?}', 'StoreController@download')->name("store.download_by_chain");

        //     $router->get('prefectures/getPrefectureListAjax', 'PrefectureController@getPrefectureList')->name('prefectures.list_ajax');
        //     $router->get('cities/getCityListAjax', 'CityController@getCityListAjax')->name('cities.list_ajax');

        //     $router->resource('flyers', 'FlyerController');
        //     $router->get('report-flyers/myshop_register_number', 'FlyerController@reportMyShopRegisterNumber')->name('flyer.report.myshop_register_number');
        //     $router->post('report-flyers/myshop_register_number/download', 'FlyerController@downloadMyShopRegisterNumber')->name('flyer.report.myshop_register_number.download');
        //     $router->get('report-flyers/flyer_reviewer_number', 'FlyerController@reportFlyerReviewerNumber')->name('flyer.report.flyer_reviewer_number');
        //     $router->post('report-flyers/flyer_reviewer_number/download', 'FlyerController@downloadFlyerReviewerNumber')->name('flyer.report.flyer_reviewer_number.download');
        //     $router->post('flyers/destroyFlyerDetail/{id}', 'FlyerController@destroyFlyerDetail')->name("flyers.destroy_flyer_detail");
        //     $router->resource('flyers-delivery-store', 'FlyerDeliveryController')->only(['update', 'edit']);
        //     $router->get('flyers-upload', 'FlyerUploadController@create')->name('flyers-upload.upload');
        //     $router->post('flyers-upload', 'FlyerUploadController@store')->name('flyers-upload.store');
        //    /**
        //     * theme upload routes start here
        //     */
        //     $router->post('theme-upload/{flyer_id}', 'ThemesController@ZipUpload')->name('themes.upload');
            
        //     /**
        //      *  theme upload routed end here
        //      */
        //     $router->resource('my-profit', 'MyProfitController');
        //     $router->resource('category-my-profit', 'MyProfitCategoryController');
        //     $router->post('my-profit/download', 'MyProfitController@download')->name("my-profit.download");
        //     $router->any('report-my-profit/list', 'MyProfitController@reportList')->name('my-profit.report_list');
        //     $router->get('report-my-profit/detail/{id}', 'MyProfitController@reportDetail')->name('my-profit.report_detail');
        //     $router->post('report-my-profit/detail/dailyDownload', 'MyProfitController@dailyDownload')->name("my-profit.report_detail.daily_download");
        //     $router->post('report-my-profit/detail/grantPointDownload', 'MyProfitController@grantPointDownload')->name("my-profit.report_detail.grant_point_download");
        //     $router->post('my-profit/copy/{id}', 'MyProfitController@copy')->name("my-profit.copy");
        //     $router->post('my-profit/action/delivery/{id}', 'MyProfitController@delivery')->name("my-profit.delivery");
        //     $router->post('my-profit/unsubscribe/{id}', 'MyProfitController@unsubscribe')->name("my-profit.unsubscribe");
        //     $router->get('my-profit/{id}/delivery', 'MyProfitController@index')->name("my-profit.delivery.edit");
        //     $router->resource('my-profit-delivery', 'MyProfitDeliveryController')->only(['update', 'edit']);
        //     $router->post('my-profit-delivery/htmlProductList', 'MyProfitDeliveryController@htmlProductList')->name("my_profit_delivery.html_product_list");
        //     $router->get('my-profit-delivery/download-membercart-error/{id}', 'MyProfitDeliveryController@downloadErrorCarNoFile')->name("my_profit_delivery.download-membercart-error");
        //     $router->resource('my-profit-grant', 'MyProfitGrantController')->only(['update', 'edit']);
        //     $router->post('my-profit-grant/htmlProductList', 'MyProfitGrantController@htmlProductList')->name("my_profit_grant.html_product_list");
        //     $router->get('my-profit/{contentId}/jobs/{jobId}/download', 'MyProfitDeliveryController@downloadJobErrorList')->name("my-profit.delivery.download_job_error_list");
        //     $router->post('my-profit/{contentId}/jobs/{jobId}/confirmed', 'MyProfitDeliveryController@confirmedJob')->name("my-profit.delivery.confirmed_job");
        //     $router->get('my-profit-grant/reflect-delivery-shop/{id}', 'MyProfitGrantController@reflectDeliveryShop')->name("my-profit.reflect_delivery_shop");
        //     $router->get('my-profit-delivery/{contentId}/jobs/{jobId}/download', 'MyProfitDeliveryController@downloadJobErrorList')->name("my-profit.delivery.download_job_error_list");
        //     $router->post('my-profit-delivery/{contentId}/jobs/{jobId}/confirmed', 'MyProfitDeliveryController@confirmedJob')->name("my-profit.delivery.confirmed_job");
        //     $router->get('my-profit-grant/{contentId}/jobs/{jobId}/download', 'MyProfitGrantController@downloadJobErrorList')->name("my-profit.grant.download_job_error_list");
        //     $router->post('my-profit-grant/{contentId}/jobs/{jobId}/confirmed', 'MyProfitGrantController@confirmedJob')->name("my-profit.grant.confirmed_job");

        //     $router->get('corporate-information', 'CorporateController@show')->name('corporate-information.show');
        //     $router->get('corporate-information/edit', 'CorporateController@edit')->name('corporate-information.edit');
        //     $router->put('corporate-information/edit', 'CorporateController@update')->name('corporate-information.update');
        //     $router->post('corporate-information/upload-image-temp', 'CorporateController@uploadImageTemp')->name("corporate-information.upload-image-temp");
        //     $router->post('corporate-information/delete-image-temp', 'CorporateController@deleteImageTemp')->name("corporate-information.delete-image-temp");

        //     $router->resource('articles', 'ArticleController')->except(['create', "edit", 'update']);
        //     $router->post('articles/approved/{id}/{status}', 'ArticleController@approved')->name('articles.approved');

        //     $router->resource('pops', 'PopController');
        //     $router->post('pops/upload-image-temp', 'PopController@uploadImageTemp')->name("pops.upload-image-temp");
        //     $router->post('pops/delete-image-temp', 'PopController@deleteImageTemp')->name("pops.delete-image-temp");
        //     $router->post('pops/upload-pdf-temp', 'PopController@uploadPdfTemp')->name("pops.upload-pdf-temp");
        //     $router->post('pops/delete-pdf-temp', 'PopController@deletePdfTemp')->name("pops.delete-pdf-temp");
        //     $router->get('pops/downloadAll/{ids?}/{popId?}/{saveDownloadHistory?}', 'PopController@downloadAll')->name("pops.download_all");
        //     $router->get('pops/download/{popId}/{id}', 'PopController@downloadPdf')->name("pops.download_pdf");
        //     $router->post('pops/delivery/{id}', 'PopController@delivery')->name("pops.delivery");
        //     $router->post('pops/unsubscribe/{id}', 'PopController@unsubscribe')->name("pops.unsubscribe");

        //     $router->any('utilization/users', 'UtilizationController@index')->name("utilization.index");
        //     $router->post('utilization/users/download', 'UtilizationController@download')->name("utilization.download");
        //     $router->post('utilization/users/membercard_download', 'UtilizationController@membercardDownload')->name("utilization.membercard_download");

        //     $router->resource('user-pops', 'UserPopController')->only(['index', 'show']);
        //     $router->get('user-pops/download/{popId}/{id}', 'UserPopController@downloadPdf')->name("user-pops.download_pdf");

        //     $router->resource('stamps', 'StampsController');
        //     $router->post('stamps/copy/{id}', 'StampsController@copy')->name("stamps.copy");
        //     $router->post('stamps/action/delivery/{id}', 'StampsController@delivery')->name("stamps.delivery");
        //     $router->post('stamps/unsubscribe/{id}', 'StampsController@unsubscribe')->name("stamps.unsubscribe");
        //     $router->resource('stamps-grant', 'StampGrantController')->only(['update', 'edit']);
        //     $router->post('stamps-grant/htmlProductList', 'StampGrantController@htmlProductList')->name("stamps_grant.html_product_list");
        //     $router->resource('stamps-delivery', 'StampDeliveryController')->only(['update', 'edit']);
        //     $router->post('stamps-delivery/htmlProductList', 'StampDeliveryController@htmlProductList')->name("stamps_delivery.html_product_list");
        //     $router->get('stamps-delivery/download-membercart-error/{id}', 'StampDeliveryController@downloadErrorCarNoFile')->name("stamps-delivery.download-membercart-error");
        //     $router->get('stamps/{contentId}/jobs/{jobId}/download', 'StampDeliveryController@downloadJobErrorList')->name("stamps.delivery.download_job_error_list");
        //     $router->post('stamps/{contentId}/jobs/{jobId}/confirmed', 'StampDeliveryController@confirmedJob')->name("stamps.delivery.confirmed_job");
        //     $router->get('stamps-grant/reflect-delivery-shop/{id}', 'StampGrantController@reflectDeliveryShop')->name("stamps.reflect_delivery_shop");
        //     $router->get('stamps-grant/{contentId}/jobs/{jobId}/download', 'StampGrantController@downloadJobErrorList')->name("stamps.grant.download_job_error_list");
        //     $router->post('stamps-grant/{contentId}/jobs/{jobId}/confirmed', 'StampGrantController@confirmedJob')->name("stamps.grant.confirmed_job");
        //     $router->any('report-stamps/list', 'StampsController@reportList')->name('stamps.report_list');
        //     $router->get('report-stamps/detail/{id}', 'StampsController@reportDetail')->name('stamps.report_detail');
        //     $router->post('report-stamps/detail/dailyDownload', 'StampsController@dailyDownload')->name("stamps.report_detail.daily_download");
        //     $router->post('report-stamps/detail/grantPointDownload', 'StampsController@grantPointDownload')->name("stamps.report_detail.grant_point_download");

        //     $router->get('user-status-search/point-grant-research', 'UserStatusSearchController@pointGrantResearch')->name('user-status-search.point-grant-research');
        //     $router->get('user-status-search/stamp-research', 'UserStatusSearchController@stampResearch')->name('user-status-search.stamp-research');
        //     $router->get('analytics/bi-users', 'AnalyticsController@user')->name('analytics.user');
        //     $router->get('analytics/bi-actives', 'AnalyticsController@active')->name('analytics.active');
        //     $router->get('analytics/bi-medias', 'AnalyticsController@media')->name('analytics.media');
        //     $router->get('analytics/bi-flyers', 'AnalyticsController@flyer')->name('analytics.flyers');
        //     $router->get('analytics/bi-status', 'AnalyticsController@status')->name('analytics.status');
        //     $router->get('analytics/bi-contents', 'AnalyticsController@contentReviewer')->name('analytics.contents');
        //     $router->get('analytics/bi-pricing', 'AnalyticsController@pricing')->name('analytics.pricing');
        //     $router->get('analytics/bi-decile', 'AnalyticsController@decile')->name('analytics.decile');
        //     $router->get('analytics/bi-roi', 'AnalyticsController@roi')->name('analytics.roi');
        //     $router->get('analytics/bi-kpi', 'AnalyticsController@kpi')->name('analytics.kpi');
        //     $router->get('analytics/bi-cluster', 'AnalyticsController@cluster')->name('analytics.cluster');
        //     $router->get('analytics/bi-contents-influence', 'AnalyticsController@contentsInfluence')->name('analytics.contents_influence');
        //     $router->get('analytics/bi-dynamic-pricing-analysis', 'AnalyticsController@dynamicPricingAnalysis')->name('analytics.dynamic_pricing_analysis');
        //     $router->get('analytics/bi-contents-viewer-analysis', 'AnalyticsController@contentAnalysis')->name('analytics.content_analysis');
        //     $router->get('analytics/bi-dynamic-pricing-customer-purchase', 'AnalyticsController@dynamicPricingCustomerPurchase')->name('analytics.dynamic_pricing_customer_purchase');

        //     $router->get('link-line/csv-download', 'LinkLineController@index')->name('link-line.csv-download');
        //     $router->get('link-line/{userId}/jobs/{jobId}/download', 'LinkLineController@downloadJobErrorList')->name("link_line.download_job_error_list");
        //     $router->get('link-line/{userId}/jobs/{jobId}/download-success', 'LinkLineController@downloadJobSuccessList')->name("link_line.download_job_success_list");

        // });
    // });

   
//     $router->get('content_download_for', 'contentDownload@contentUserSurveyResutCsv')->name("admin.content_download_for");
// });


//Route::get('/', function () {
//    return view('welcome');
//})->name("home");

