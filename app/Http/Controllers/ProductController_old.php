<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DietaryPrefence;
use App\Models\FoodCategory;
use App\Models\Item;
use App\Models\ItemLabel;
use App\Models\LabelSetting;
use App\Models\Order;
use App\Models\SubCategory;
use App\Models\TopPic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\File\File;
use Yajra\DataTables\DataTables;

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
        //  dd($subcategory_data);
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
       
        $descc = $request->desc;
        if ($catid == 'Parent') {
            $result = Category::where('category', $subcat )->exists();
                if($result == false){
                $categorys = new Category();
                $categorys->category = $subcat;
                $categorys->desc = $descc;
                $categorys->save();
                $latest_catid = Category::where('category', $subcat)->get('id');
                $latest_catid = $latest_catid[0]->id;
                $subcategory = new Subcategory();
                $subcategory->categoryid = $latest_catid;
                $subcategory->category_name = $catid;
                $subcategory->subcategory = $subcat;
                if ($subcategory->save()) {
                    $response = response()->json(['success' => 'Category added successfully'], 200);
                } else {
                    $response = response()->json(['error_success' => 'Category not addedd']);
                }

            } else {
                $response = response()->json(['alreadyfound_error' => 'This Category already found! Enter another...']);
            }

            return $response;
        } else {
            $result2 = Subcategory::where('subcategory', $subcat )->exists();
            if($result2 == false){
            $latest_catname1 = Category::where('id', $catid)->get('category');
            $latest_catname = $latest_catname1[0]->category;
            $subcategory = new Subcategory();
            $subcategory->categoryid = $catid;
            $subcategory->category_name = $latest_catname;
            $subcategory->subcategory = $subcat;
            if ($subcategory->save()) {
                $response = response()->json(['success' => 'SubCategory added successfully'], 200);
            } else {
                $response = response()->json(['error_success' => 'SubCategory not addedd']);
            }
        }else{
            $response = response()->json(['alreadyfound_error' => 'This SubCategory already found! Enter another...']);
        }
            return $response;
        }
    }


    public function items()
    {
        $items = Item::where('position', '>=', 0)->orderBy('position')->get();
        // dd($items);
        //  $itemlabels = $items[0]->labels;
        // dd($itemlabels);
        $category_d = Category::get();
        $labels = LabelSetting::get();
        return view('backend.modules.products.add_item', compact('items', 'category_d', 'labels'));
    }
    public function getsubcategory(Request $request)
    {
        $catname = Category::where('id', $request->catid)->get(['category']);
        $cat_name = $catname[0]->category;
        // dd($cat_name);
        $subcat = SubCategory::where('categoryid', $request->catid)->get();

        //$xys = $subcat[0]->subcategory;
        //   dd($subcat);
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

    public function additem(Request $request)
    {  //dd($request->all());
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
        if ($request->item_image != "") {
            $image = $request->item_image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $image->move(public_path('uploads/items'), $imageName);
            $items->item_image = $imageName;
            if ($items->save()) {
                $lastinsertedId = $items->id;
                $labelArray[] = explode(',', $request->label_id);
                //dd($labelArray);

                // $label_id = $request->label_id;
                $count = 0;
                foreach ($labelArray as $pt) {
                    $count += count($pt);
                }
                //dd($count);
                for ($z = 0; $z < count($labelArray); $z++) {
                    for ($i = 0; $i < $count; $i++) {
                        $items_label = new ItemLabel();
                        $label_id_1 = $labelArray[$z][$i];
                        //     dd($label_id_1);
                        //    $label_id_2 = implode(" ",$label_id_1);

                        $items_label->items_id = $lastinsertedId;
                        $items_label->item_name = $request->item_name;
                        $items_label->label_id = $label_id_1;
                        $items_label->save();
                    }
                }

                $response = response()->json(['success' => 'Item added successfully'], 200);
            } else {
                $response = response()->json(['error_success' => 'Item not addedd']);
            }
            return $response;
        }
    }


    public function statuschange(Request $request)
    {
        $user_id = $request->id;
        $pre_status = Item::where('id', $user_id)->get(['status']);
        if ($pre_status[0]->status == 0) {
            $new_status = 1;
        } else {
            $new_status = 0;
        }
        $update = Item::where('id', $user_id)->update(
            [
                'status' => $new_status
            ]
        );
        if ($update == 1) {
            $response = response()->json(['success' => 'Item Status Changed'], 200);
        } else {
            $response = response()->json(['errors_success' => 'Error in Changing Item Status'], 200);
        }
        return $response;
    }
    public function updateitem(Request $request)
    {//dd($request);
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
        $item_exists = Item::where('id', $id)->get();
        $item = Item::find($id);
        if (!empty($item)) {
            Item::find($id)->delete();
            return response()->json(['success' => 'Item deleted successfully']);
        } else {
            return response()->json(['error_success' => 'Error in deleting item']);
        }
    }
    public function updateSubcat(Request $request)
    {
        // dd($request);
        $cat_id = $request->catid;
        //  dd($cat_id);
        $user_id = $request->id;
        if ($request->catid == 'parent') {
            $response = response()->json(['parent_success' => 'Select Any Other Category']);
        } else {
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
            Category::where('id', $cat_id)->update(
                [
                    'desc' => $request->desc
                ]
            );
            $update = SubCategory::where('id', $user_id)->update(
                [
                    'categoryid' => $request->catid,
                    'subcategory' => $request->subcat
                ]
            );
            if ($update == 1) {
                $response = response()->json(['success' => 'SubCategory updated successfully']);
            } else {
                $response = response()->json(['error_success' => 'SubCategory not updated']);
            }
        }
        return $response;
    }

    public function subcatdelete($id)
    {
        $subcatitem = SubCategory::find($id);
        if (!empty($subcatitem)) {
            SubCategory::find($id)->delete();
            return response()->json(['success' => 'SubCategory deleted successfully']);
        } else {
            return response()->json(['error_success' => 'Error in deleting SubCategory']);
        }
    }
    public function labelsettings()
    {
        $labelsetting = LabelSetting::all();
        return view('backend.modules.products.label_setting', compact('labelsetting'));
    }
    public function addlabel(Request $request)
    {
        // dd($request->all());
        // dd($request);
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
        // dd($request);
        $labels = new LabelSetting();
        $labels->name = $request->label;
        $result = LabelSetting::where('name', $request->label )->exists();
        if($result == false){
        if ($request->label_icon != "") {
            $image = $request->label_icon;
            //  dd($image);
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
    }else{
        $response = response()->json(['alreadyfound_error' => 'Label already found! Enter another..']);
    }
    return $response;
    }
    public function updateLabel(Request $request)
    {
        //  dd($request);
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
        //  dd($request);
        $order = $request->order;
        // $myorder = $order[0]->id;
        // dd($myorder);
        // dd($order);
        foreach ($order as $item) {

            $ids = $item['id'];
            $positions = $item['position'];
            //  dd($id);
            //  Category::where('id', $id)->update(['position' => $position]);
            //  }
            //  return response()->json(['status' => 'success']);
            $update = SubCategory::where('id', $ids)->update(
                [
                    'position' => $positions
                ]
            );
        }
        //dd($update);
        if ($update == 1) {
            $response = response()->json(['success' => 'Position updated successfully']);
        } else {
            $response = response()->json(['error_success' => 'Position not updated']);
        }

        return $response;
    }

    public function itemsPositionUpdate(Request $request)
    {
        // dd($request);
        $order = $request->order;
        // dd($order);
        foreach ($order as $item) {

            $ids = $item['id'];
            $positions = $item['position'];
            $update = Item::where('id', $ids)->update(
                [
                    'position' => $positions
                ]
            );
        }
        //dd($update);
        if ($update == 1) {
            $response = response()->json(['success' => 'Position updated successfully']);
        } else {
            $response = response()->json(['error_success' => 'Position not updated']);
        }

        return $response;
    }
}
