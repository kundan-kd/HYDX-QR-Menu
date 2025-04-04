<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $category_data = Category::where('position', '>=', 0)->orderBy('position')->get();
        return view('backend.modules.products.category', compact('category_data'));
    }
    public function addCategory(Request $request)
    { $new_category = $request->category;
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'category' => ['required'],
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'error_validation' => $validator->errors()->all(),
                ], 200);
            }
        }
        $result = Category::where('category', $new_category)->exists();
        if ($result == false) {
            $category_table = new Category();
            $category_table->category = $new_category;
            $category_table->desc = $request->desc;
            if ($category_table->save()) {
                $response = response()->json(['success' => 'Category added successfully'], 200);
            } else {
                $response = response()->json(['error_success' => 'Category not updated']);
            }
        } else {
            $response = response()->json(['alreadyfound_error' => 'This Category already found! Enter another...']);
        }
        return $response;
    }
    public function updateCat(Request $request)
    {
        $id = $request->id;
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'category' => ['required'],
                'desc' => ['required'],
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'error_validation' => $validator->errors()->all(),
                ], 200);
            }
        }
        $update = Category::where('id', $id)->update(
            [
                'category' => $request->category,
                'desc' => $request->desc
            ]
        );
        if ($update == 1) {
            $response = response()->json(['success' => 'Category updated successfully']);
        } else {
            $response = response()->json(['error_success' => 'Category not updated']);
        }
        return $response;
    }

    public function catPositionUpdate(Request $request)
    {
        $order = $request->order;
        foreach ($order as $item) {
            $ids = $item['id'];
            $positions = $item['position'];
            $update = Category::where('id', $ids)->update(
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
    public function catPositionUpdate2(Request $request)
    {
        $order = $request->order;
        foreach ($order as $item) {
            $ids = $item['id'];
            $positions = $item['position'];
            $update = Category::where('id', $ids)->update(
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

    public function catdelete($id)
    {
        $catitem = Category::find($id);
        $result = SubCategory::where('categoryid', $id)->exists();
        if ($result == false) {
            if (!empty($catitem)) {
                Category::find($id)->delete();
                $response = response()->json(['success' => 'Category deleted successfully']);
            } else {
                $response = response()->json(data: ['error_success' => 'Error in deleting SubCategory']);
            }
        } else {
            $response = response()->json(data: ['error_success' => 'sorry! You have Sub Category in this Category']);
        }
        return $response;
    }
    public function getcatData(Request $request)
    {
        $id = $request->id;
        $Cat_Data = Category::where('id', $id)->get();
        $cat_name = $Cat_Data[0]->category;
        $desc = $Cat_Data[0]->desc;
        $response = ['id' => $id,'cat_name' => $cat_name, 'desc' => $desc];
        return $response;
    }
}
