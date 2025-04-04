<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CompanyProfile;
use App\Models\Item;
use App\Models\ItemLabel;
use App\Models\Order;
use App\Models\SubCategory;
use App\Models\LabelSetting;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $category_data = Category::get();
        $labels = LabelSetting::get();
        $cart = session()->get('cart', []);
        return view('frontend.index', compact('category_data', 'labels', 'cart'));
    }
    public function filterdata(Request $request)
    {
        $c_name = CompanyProfile::where('id', 1)->get();
        $primary_color = $c_name[0]->primary_color ?? '';
        $items_data = '';
        $VNmenuId = $request->VNmenuId;
        $labelMenuID = $request->labelMenuID;
        $category_data = Category::orderBy('position')->get();
        $output = '';
        foreach ($category_data as $categorys) {
            $cat_name = $categorys->category;
            $output .= ' <div class="col-12 content-wrapper px-4">
            <div class="accordion" id="accordionExample' . $categorys->id . '">
            <h2 class="accordion-header" id="headingOne">
                            <div class="d-flex justify-content-between" id="cat_menu' . $categorys->id . '">
                              <h5><a href="#mcat-' . $categorys->id . '" style="color: ' . $primary_color . 'f2;text-decoration: none;">' . $categorys->category . '</a></h5>
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#mcat-' . $categorys->id . '" aria-expanded="true" aria-controls="mcat-' . $categorys->id . '">
                            </div>
                              <div  id="mcat-' . $categorys->id . '" class="item-wrapper content accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample' . $categorys->id . '">
                               <p class="pb-1 border-bottom"><small>' . $categorys->desc . '</small></p>';
            $subcategory_data = SubCategory::where('categoryid', $categorys->id)->orderBy('position')->get();
            foreach ($subcategory_data as $subcat) {
                if ($labelMenuID == '' && $VNmenuId == '') {
                    $items_data = Item::where('subcategoryid', $subcat->id)
                        ->where('status', 'Active')
                        ->orderBy('position')
                        ->get();
                } else if ($labelMenuID != '' && $VNmenuId == '') {
                    $items_ids = ItemLabel::whereIn('label_id', $labelMenuID)->get(['items_id']);
                    $items_data = Item::where('subcategoryid', $subcat->id)
                        ->where('status', 'Active')
                        ->whereIn('id', $items_ids)
                        ->orderBy('position')
                        ->get();
                } else if ($labelMenuID == '' && $VNmenuId != '') {
                    $items_data = Item::where('subcategoryid', $subcat->id)
                        ->where('status', 'Active')
                        ->whereIn('f_category', $VNmenuId)
                        ->orderBy('position')
                        ->get();
                } else {
                    $items_ids = ItemLabel::whereIn('label_id', $labelMenuID)->get(['items_id']);
                    $items_data = Item::where('subcategoryid', $subcat->id)
                        ->where('status', 'Active')
                        ->whereIn('id', $items_ids)
                        ->whereIn('f_category', $VNmenuId)
                        ->orderBy('position')
                        ->get();
                }
                $items_found = $items_data->isEmpty();
                if ($items_found == false) {
                    $output .= ' <div class="d-flex justify-content-between" id="subcat_menu' . $subcat->id . '">';
                    if ($subcat->subcategory != $cat_name) {
                        $output .= '<h6><a href="#subcat-' . $subcat->id . '" style="color: ' . $primary_color . 'cc;text-decoration: none;">' . $subcat->subcategory . '</a></h6>
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#subcat-' . $subcat->id . '" aria-expanded="true" aria-controls="subcat-' . $subcat->id . '" style="margin-top: -3px;">
                            </div>
                  <div  id="subcat-' . $subcat->id . '" class="item-wrapper content accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#subcat-' . $subcat->id . '">';
                        foreach ($items_data as $items) {
                            $stringlimit = substr($items->desc, 0, 50);
                            $Itemlabel = $items->labels;
                            $labelArray = explode(',', $Itemlabel);
                            $output .= '<div class="item d-flex justify-content-between border-bottom mt-2 mb-2 pb-4">
                                    <div class="item-detail me-4">
                                    <div class="mb-2 d-flex flex-wrap">';
                            if ($items->f_category == 1) {
                                $output .= '<img src="frontend/assets/images/veg.png" alt="veg" width="20"height="20" onclick="showItem(' . $items->f_category . ')"/>';
                            } else {
                                $output .= '<img src="frontend/assets/images/nonveg.png" alt="nonveg" width="20"height="20" onclick="showItem(' . $items->f_category . ')"/></span>';
                            }
                            foreach ($labelArray as $labelid) {
                                $labelName = LabelSetting::where('id', $labelid)->get();
                                $labelicon = $labelName[0]->label_icon;
                                $labelname = $labelName[0]->name;
                                $output .= '<p class="mb-1"><span class="badge rounded bg-white text-dark border ms-2"><span class="me-2">';
                                $output .= '<span id="labelfilter' . $labelName[0]->id . '"><span onclick="showItemfilter(' . $labelName[0]->id . ')"><img src="uploads/label_icon/' . $labelicon . '"width="10px"/>' . $labelname . '</span></span></span></span></p>';
                            }
                            $output .= '</div><h4>' . $items->item_name . '</h4>
                                  <h5><span class="price text-decoration-line-through me-3 text-muted">₹' . $items->mrp . '</span>
                                      <span class="price">₹ ' . $items->offer_price . '</span>
                                  </h5>
                                        <p class="mb-3"><span id="strlimit' . $items->id . '">' . $stringlimit . '</span><span id="dots' . $items->id . '">...</span><span id="more' . $items->id . '"style="display:none;">' . $items->desc . '</span><span class="ms-1 fw-bold"
                                             onclick="longDescription(' . $items->id . ')" id="myBtn' . $items->id . '">read more</span><span class="ms-1 fw-bold"
                                             onclick="longDescription(' . $items->id . ')" id="myBtn2' . $items->id . '" style="display:none;">read less</span></p>
                                </div>
                                        <div class="item-image"><img src="uploads/items/' . $items->item_image . '" height="144" width="156"
                                            alt="item" class="rounded" data-bs-toggle="modal"
                                             data-bs-target="#exampleModal" onclick="getimage(this.src,' . $items->id . ',`' . $items->item_name . '`,' . $items->offer_price . ',`' . $items->desc . '`)" style="border-radius: 12px !important;"/>
                                           <div class="text-center quantity-selector" data-bs-toggle="modal"
                                                data-bs-target="//#itemSummaryModal" onclick="//getmodelimage(' . $items->id . ',`' . $items->item_image . '`,`' . $items->item_name . '`,' . $items->offer_price . ')">
                                            <button class="add-btn" onclick="addItemToCart(' . $items->id . ',' . $items->offer_price . ')">Add</button>
                                            <div class="qty-controls" style="display:none;" data-item-id="{{ $items->id }}">
                                             <span class="decrement" onclick="adjustQuantity(' . $items->id . ',' . $items->offer_price . ', -1)">-</span>
                                             <span class="qty">1</span>
                                             <span class="increment" onclick="adjustQuantity(' . $items->id . ',' . $items->offer_price . ', 1)">+</span>
                                             </div>
                                            </div>
                                        </div>
                               </div>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content front_image_modal">
                                       <button type="button" class="btn-close" data-bs-dismiss="modal"style="height: 33px;width: 30px;"
                                        aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                                       <div class="modal-body viewImage p-0 alt="Item Image" width="100%">
                                       </div>
                                       </div>
                                        <div class="modal-content">
                                        <div class="modal-body viewImage-details" style="background-color:#fff; border-radius:0px 0px 15px 15px;">
                              </div>
                            </div>
                        </div>
                    </div>';
                        }
                    }
                    $output .= '</div>';
                }
            }
            $output .= '</div></div></div>';
        }
        $response = response()->json(['output' => $output], 200);
        return $response;
    }

    public function addItem(Request $request)
    {
        $orders = new Order();
        $orders->orderid = 'HY' . random_int(10000, 99999);
        $orders->itemid = $request->id;
        $orders->item_name = $request->item_name;
        $orders->quantity = $request->quantity;
        $orders->price = $request->order_price;
        $orders->total_price = $request->order_price * $request->quantity;
        if ($orders->save()) {
            $response = response()->json(['success' => 'Order Sent To Restaurant Successfully'], 200);
        } else {
            $response = response()->json(['error_success' => 'Order not sent']);
        }
        return $response;
    }
}
