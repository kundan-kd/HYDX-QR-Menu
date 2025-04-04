<?php

use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CompanyController;
use App\Http\Controllers\backend\dashboard\DashboardController;
use App\Http\Controllers\backend\ApiController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;


/*------------Frontend Route------------------*/
Route::get('/', [IndexController::class, 'index'])->name('frontend.index');
Route::post('/filter', [IndexController::class, 'filterdata'])->name('frontend.filterdata');
Route::post('/ItemAdd', [IndexController::class, 'addItem'])->name('frontend.addItem');
Route::post('/cart', [CartController::class, 'addToCart'])->name('frontend.addToCart');
Route::post('/cartItemClear', [CartController::class, 'clearCartItems'])->name('frontend.clearCartItems');
Route::post('/cartClear', [CartController::class, 'clearCart'])->name('frontend.clearCart');

/*------------Backend Route------------------*/
Route::get('/admin', [HomeController::class, 'index'])->name('index');

Route::post('logged_in', [LoginController::class, 'authenticate'])->name('backend.login');
Route::post('/admin-passwordReset', [LoginController::class, 'passwordreset'])->name('backend.passwordreset');
Route::post('/admin-otpVerify', [LoginController::class, 'verifyotp'])->name('backend.verify_otp');
Route::post('/admin-passwordChange', [LoginController::class, 'updatepass'])->name('backend.update_pass');
Route::get('/admin-forgetPassword', [DashboardController::class, 'forgetpass'])->name('backend.forgetpass');
Route::post('/admin-sendMail', [MailController::class, 'index'])->name('backend.sendmail');

Route::group(['middleware' => ['auth'],], function () {
    Route::get('/admin-dashboad', [DashboardController::class, 'dashboad'])->name('dashboard.dashboard');
    Route::get('/admin-myProfile', [DashboardController::class, 'profile'])->name('dashboard.profile');

    Route::get('/admin-subcategory', [ProductController::class, 'subcategory'])->name('product.subcategory');
    Route::post('/admin-subcategoryAdd', [ProductController::class, 'addsubcategory'])->name('product.addsubcategory');
    Route::get('/admin-getCategoryList', [ProductController::class, 'getCategoryList'])->name('product.getCategoryList');
    Route::get('/admin-productIitem', [ProductController::class, 'items'])->name('product.items');
    Route::post('/admin-getSubCategoryList', [ProductController::class, 'getsubcategory'])->name('product.getsubcategory');
    Route::post('/admin-getSubCategorySelect', [ProductController::class, 'getsubcategoryselet'])->name('product.getsubcategoryselet');
    Route::get('/admin-subCategoryList', [ProductController::class, 'viewsubCategoryList'])->name('product.viewsubCategoryList');
    Route::post('/admin-itemAdd', [ProductController::class, 'additem'])->name('product.additem');
    Route::get('/admin-itemList', [ProductController::class, 'viewitemList'])->name('product.viewitemList');
    Route::post('/admin-itemListUpdate', [ProductController::class, 'statuschange'])->name('product.status');
    Route::post('/admin-itemsUpdate', [ProductController::class, 'updateitem'])->name('product.updateitem');
    Route::delete('/admin-deleteItem/{id}', [ProductController::class, 'itemdelete'])->name('product.itemdelete');
    Route::post('/admin-subcategoryUpdate', [ProductController::class, 'updateSubcat'])->name('product.updateSubcat');
    Route::delete('/admin-subcategoryDelete/{id}', [ProductController::class, 'subcatdelete'])->name('product.subcatdelete');
    Route::post('/admin-subcategoryPosition', [ProductController::class, 'subcatPositionUpdate'])->name('product.subcatPositionUpdate');
    Route::post('/admin-itemsPosition', [ProductController::class, 'itemsPositionUpdate'])->name('product.itemsPositionUpdate');
    Route::get('/admin-labels', [ProductController::class, 'labelsettings'])->name('product.labelsettings');
    Route::post('/admin-labelAdd', [ProductController::class, 'addlabel'])->name('product.addlabel');
    Route::post('/admin-labelUpdate', [ProductController::class, 'updateLabel'])->name('product.updateLabel');
    Route::delete('/admin-labelDelete/{id}', [ProductController::class, 'deleteLabel'])->name('product.deleteLabel');

    Route::resource('/admin-receivedOrder', OrderController::class);
    Route::get('/admin-receivedOrderList', [OrderController::class, 'orderReceivedList'])->name('order.orderReceivedList');
    Route::get('/admin-category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/admin-categoryAdd', [CategoryController::class, 'addCategory'])->name('category.addCategory');
    Route::post('/admin-categoryUpdate', [CategoryController::class, 'updateCat'])->name('category.updateCat');
    Route::post('/admin-categoryPosition', [CategoryController::class, 'catPositionUpdate'])->name('category.catPositionUpdate');
    Route::post('/admin-categoryPosition2', [CategoryController::class, 'catPositionUpdate2'])->name('category.catPositionUpdate2');
    Route::delete('/admin-categoryDelete/{id}', [CategoryController::class, 'catdelete'])->name('category.catdelete');
    Route::post('/admin-categoryValue', [CategoryController::class, 'getcatval'])->name('category.getcatval');
    Route::post('/admin-categoryData', [CategoryController::class, 'getcatData'])->name('category.getcatData');

    Route::post('/admin-subcategoryData', [SubcategoryController::class, 'getSubcatData'])->name('getSubcatData');
    Route::post('/admin-subcategoryTotal', [SubcategoryController::class, 'getSubcattotal'])->name('getSubcattotal');
    Route::post('/admin-subcatval', [SubcategoryController::class, 'getsubcatval'])->name('getsubcatval');

    Route::post('/admin-itemData', [ItemController::class, 'getItemData'])->name('getItemData');
    Route::post('/admin-itemTotal', [ItemController::class, 'getitemtotal'])->name('getitemtotal');

    Route::get('/admin-companyProfile', [CompanyController::class, 'index'])->name('company.index');
    Route::post('/admin-colorPrimary', [CompanyController::class, 'primaryColor'])->name('company.primaryColor');
    Route::post('/admin-colorName', [CompanyController::class, 'nameColor'])->name('company.nameColor');
    Route::post('/admin-logoUpload', [CompanyController::class, 'uploadlogo'])->name('company.uploadlogo');
    Route::post('/admin-companyName', [CompanyController::class, 'nameUpdate'])->name('company.nameUpdate');

    Route::get('/get-monitors', [ApiController::class, 'getMonitors'])->name('api_data');
});
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');
