<?php
namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemLabel;
use App\Models\LabelSetting;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        //
    }
    public function subcategory()
    {
        $category_data = Category::get(['id', 'category']);
        $subcategory_data = SubCategory::where('position', '>=', 0)->orderBy('position')->get();
        return view('backend.modules.products.sub_category', compact('category_data', 'subcategory_data'));
    }
    public function addsubcategory(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'catid' => ['required'],
                'subcategory' => ['required'],
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'errors_validation' => $validator->errors()->all(),
                ], 200);
            }
        }
        $catid = $request->catid;
        $subcat = $request->subcategory;
        $total_subcat_old = Category::where('id', $catid)->get();
        $total_subcat = $total_subcat_old[0]->total_subcat;
        $cat_name = $total_subcat_old[0]->category;
        $result = Subcategory::where('subcategory', $subcat)->exists();
        if ($result == false) {
            $subcategory = new Subcategory();
            $subcategory->categoryid = $catid;
            $subcategory->category_name = $cat_name;
            $subcategory->subcategory = $subcat;
            if ($subcategory->save()) {
                Category::where('id', $catid)->update([
                    'total_subcat' => $total_subcat + 1
                ]);
                $response = response()->json(['success' => 'SubCategory added successfully'], 200);
            } else {
                $response = response()->json(['error_success' => 'SubCategory not addedd']);
            }
        } else {
            $response = response()->json(['alreadyfound_error' => 'This SubCategory already found! Enter another...']);
        }
        return $response;

    }
    public function items()
    {
        $items = Item::where('position', '>=', 0)->orderBy('position')->get();
        $category_d = Category::get();
        $labels = LabelSetting::get();
        return view('backend.modules.products.add_item', compact('items', 'category_d', 'labels'));
    }
    public function getsubcategory(Request $request)
    {
        $catname = Category::where('id', $request->catid)->get(['category']);
        $cat_name = $catname[0]->category;
        $subcat = SubCategory::where('categoryid', $request->catid)->get();
        $output = '<option value="">Select Sub Category</option>';
        if (!empty($subcat)) {
            foreach ($subcat as $subcat_data) {

                if ($subcat_data->subcategory != $cat_name) {
                    $output .= '<option value="' . $subcat_data->id . '">' . $subcat_data->subcategory . '</option>';
                }
            }
        }
        return response()->json(['success' => 'SubCategory added successfully', 'subcat' => $output], 200);
    }
    public function getsubcategoryselet(Request $request)
    {
        $subcat = SubCategory::where('id', $request->subcatid)->get();
        $output = '<option value="' . $subcat[0]->id . '">' . $subcat[0]->subcategory . '</option>';
        return response()->json(['success' => 'SubCategory added successfully', 'subcatselect' => $output], 200);
    }

     public function additem(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'catid' => ['required'],
                'subcatid' => ['required'],
                'item_name' => ['required'],
                'mrp' => ['required'],
                'offer_price' => ['required'],
                // 'label_id' => ['required'],
                'item_image' => ['required'],
                'desc' => ['required'],
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'error_validation' => $validator->errors()->all(),
                ], 200);
            }
        }
        $label_data = $request->label_id;
        $item_mrp = $request->mrp;
        $item_offer_price = $request->offer_price;
        $items = new Item();
        $items->categoryid = $request->catid;
        $items->subcategoryid = $request->subcatid;
        $items->item_name = $request->item_name;
        $items->labels = $request->label_id;
        $items->f_category = $request->f_category;
        $items->mrp = $request->mrp;
        $items->offer_price = $request->offer_price;
        $items->desc = $request->desc;
        $image = $request->item_image;
        if ($item_mrp >= $item_offer_price) {
            if ($request->item_image != "") {
                $image = $request->item_image;
                $ext = $image->getClientOriginalExtension();
                $imageName = time() . '.' . $ext;
                $image->move(public_path('uploads/items'), $imageName);
                $items->item_image = $imageName;
                if ($items->save()) {
                    if ($label_data != null) {
                    $lastinsertedId = $items->id;
                    $labelArray[] = explode(',', $request->label_id);
                    $count = 0;
                    foreach ($labelArray as $pt) {
                        $count += count($pt);
                    }
                    for ($z = 0; $z < count($labelArray); $z++) {
                        for ($i = 0; $i < $count; $i++) {
                            
                                $items_label = new ItemLabel();
                                $label_id_1 = $labelArray[$z][$i];
                                $items_label->items_id = $lastinsertedId;
                                $items_label->item_name = $request->item_name;
                                $items_label->label_id = $label_id_1;
                                $items_label->save();
                            }
                        }
                    }
                    $response = response()->json(['success' => 'Item added successfully'], 200);
                } else {
                    $response = response()->json(['error_success' => 'Item not addedd']);
                }
            }
        } else {
            $response = response()->json(['error_success_price' => 'MRP is less the Offer Price!']);
        }
        return $response;
    }
    public function statuschange(Request $request)
    {
        $user_id = $request->id;
        $pre_status = Item::where('id', $user_id)->get(['status']);
        if ($pre_status[0]->status == 'Active') {
            $new_status = 'Hidden';
        } else {
            $new_status = 'Active';
        }
        $update = Item::where('id', $user_id)->update(
            [
                'status' => $new_status
            ]
        );
        if ($update == 1) {
            $response = response()->json(['success' => 'Item Status Changed','ssts'=>$new_status], 200);
        } else {
            $response = response()->json(['errors_success' => 'Error in Changing Item Status'], 200);
        }
        return $response;
    }
    public function updateitem(Request $request)
    {
        $user_id = $request->id;
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'catid' => ['required'],
                'item_name' => ['required'],
                'desc' => ['required'],
                'subcatid' => ['required'],
                'f_category' => ['required'],
                'mrp' => ['required'],
                'offer_price' => ['required'],
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'error_validation' => $validator->errors()->all(),
                ], 200);
            }
        }
        $itemdata = Item::where('id', $user_id)->get(['labels', 'item_image']);
        $old_imageName = $itemdata[0]->item_image;
        $item_image = $request->item_image;
        if ($item_image == "undefined") {
            $new_img = $old_imageName;
        } else {
            $item_img_new = $item_image;
            $ext = $item_img_new->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $item_img_new->move(public_path('uploads/items'), $imageName);
            $new_img = $imageName;
        }
        $old_labels = $itemdata[0]->labels;
        $label_ids = $request->label_id;
        if ($label_ids == "") {
            $new_labels = $old_labels;
        } else {
            $new_labels = $label_ids;
        }
        $update = Item::where('id', $user_id)->update(
            [
                'categoryid' => $request->catid,
                'subcategoryid' => $request->subcatid,
                'item_name' => $request->item_name,
                'f_category' => $request->f_category,
                'mrp' => $request->mrp,
                'offer_price' => $request->offer_price,
                'labels' => $new_labels,
                'desc' => $request->desc,
                'item_image' => $new_img
            ]
        );
        if ($update == 1) {
            $response = response()->json(['success' => 'Item updated successfully']);
        } else {
            $response = response()->json(['error_success' => 'Item not updated']);
        }
        return $response;
    }
    public function itemdelete($id)
    {
        $item_subcat = Item::where('id', $id)->get(['subcategoryid']);
        $subcatid = $item_subcat[0]->subcategoryid;
        $item_total = SubCategory::where('id', $subcatid)->get(['total_items']);
        $subcat_items = $item_total[0]->total_items;
        $item = Item::find($id);
        if (!empty($item)) {
            Item::find($id)->delete();
            SubCategory::where('id', $subcatid)->update(
                [
                    'total_items' => $subcat_items - 1
                ]
            );
            return response()->json(['success' => 'Item deleted successfully']);
        } else {
            return response()->json(['error_success' => 'Error in deleting item']);
        }
    }
    public function updateSubcat(Request $request)
    {
        $user_id = $request->id;
        $catid = $request->catid;
        $old_cat = SubCategory::where('id', $user_id)->get(['categoryid']);
        $old_catid = $old_cat[0]->categoryid;
        $old_cat_total_subcat = Category::where('id', $old_catid)->get(['total_subcat']);
        $oldcat_total_subcat = $old_cat_total_subcat[0]->total_subcat;
        $category_name = Category::where('id', $catid)->get();
        $total_subcat = $category_name[0]->total_subcat;
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'catid' => ['required'],
                'subcat' => ['required'],
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'error_validation' => $validator->errors()->all(),
                ], 200);
            }
        }
        $update = SubCategory::where('id', $user_id)->update(
            [
                'categoryid' => $request->catid,
                'category_name' => $category_name[0]->category,
                'subcategory' => $request->subcat
            ]
        );
        if ($update == 1) {
            Category::where('id', $old_catid)->update([
                'total_subcat' => $oldcat_total_subcat - 1
            ]);
            Category::where('id', $catid)->update([
                'total_subcat' => $total_subcat + 1
            ]);
            $response = response()->json(['success' => 'SubCategory updated successfully']);
        } else {
            $response = response()->json(['error_success' => 'SubCategory not updated']);
        }

        return $response;
    }

    public function subcatdelete($id)
    {
        $getcatID = SubCategory::where('id', $id)->get(['categoryid']);
        $catID = $getcatID[0]->categoryid;
        $gettotal_subcat = Category::where('id', $catID)->get(['total_subcat']);
        $total_subcat = $gettotal_subcat[0]->total_subcat;
        $subcatitem = SubCategory::find($id);
        $result = Item::where('subcategoryid', $id)->exists();
        if ($result == false) {
            if (!empty($subcatitem)) {
                Category::where('id', $catID)->update([
                    'total_subcat' => $total_subcat - 1
                ]);
                SubCategory::find($id)->delete();
                $response = response()->json(['success' => 'SubCategory deleted successfully']);
            } else {
                $response = response()->json(data: ['error_success' => 'Error in deleting SubCategory']);
            }
        } else {
            $response = response()->json(data: ['error_success' => 'sorry! You have items in this Sub Category']);
        }
        return $response;
    }
    public function labelsettings()
    {
        $labelsetting = LabelSetting::all();
        return view('backend.modules.products.label_setting', compact('labelsetting'));
    }

    public function addlabel(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'label' => 'required',
                'label_icon' => 'required|image',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'errors_validation' => $validator->errors()->all(),
                ], 200);
            }
        }
        $labels = new LabelSetting();
        $labels->name = $request->label;
        $result = LabelSetting::where('name', $request->label)->exists();
        if ($result == false) {
            if ($request->label_icon != "") {
                $image = $request->label_icon;
                $ext = $image->getClientOriginalExtension();
                $imageName = time() . '.' . $ext;
                $image->move(public_path('uploads/label_icon'), $imageName);
                $labels->label_icon = $imageName;
                if ($labels->save()) {
                    $response = response()->json(['success' => 'Label added successfully'], 200);
                } else {
                    $response = response()->json(['error_success' => 'Label not addedd']);
                }
            }
        } else {
            $response = response()->json(['alreadyfound_error' => 'Label already found! Enter another..']);
        }
        return $response;
    }
    public function updateLabel(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'name' => ['required'],
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'error_validation' => $validator->errors()->all(),
                ], 200);
            }
        }
        $label_id = $request->id;
        $old_icon = LabelSetting::where('id', $label_id)->get(['label_icon']);
        $old_iconName = $old_icon[0]->label_icon;
        $label_icon = $request->label_icon;
        if ($label_icon == "undefined") {
            $label_icon_new_img = $old_iconName;
        } else {
            $label_icon_new = $label_icon;
            $ext = $label_icon_new->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $label_icon_new->move(public_path('uploads/label_icon'), $imageName);
            $label_icon_new_img = $imageName;
        }
        $update = LabelSetting::where('id', $label_id)->update(
            [
                'name' => $request->name,
                'label_icon' => $label_icon_new_img
            ]
        );
        if ($update == 1) {
            $response = response()->json(['success' => 'Label updated successfully']);
        } else {
            $response = response()->json(['error_success' => 'Label not updated']);
        }
        return $response;
    }
    public function deleteLabel($id)
    {
        $subcatitem = LabelSetting::find($id);
        if (!empty($subcatitem)) {
            LabelSetting::find($id)->delete();
            return response()->json(['success' => 'Label deleted successfully']);
        } else {
            return response()->json(['error_success' => 'Error in deleting Label']);
        }
    }
    public function subcatPositionUpdate(Request $request)
    {
        $order = $request->order;
        foreach ($order as $item) {

            $ids = $item['id'];
            $positions = $item['position'];
            $update = SubCategory::where('id', $ids)->update(
                [
                    'position' => $positions
                ]
            );
        }
        if ($update == 1) {
            $response = response()->json(['success' => 'Position updated successfully']);
        } else {
            $response = response()->json(['error_success' => 'Position not updated']);
        }
        return $response;
    }

    public function itemsPositionUpdate(Request $request)
    {
        $order = $request->order;
        foreach ($order as $item) {
            $ids = $item['id'];
            $positions = $item['position'];
            $update = Item::where('id', $ids)->update(
                [
                    'position' => $positions
                ]
            );
        }
        if ($update == 1) {
            $response = response()->json(['success' => 'Position updated successfully']);
        } else {
            $response = response()->json(['error_success' => 'Position not updated']);
        }
        return $response;
    }
}
