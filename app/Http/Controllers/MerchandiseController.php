<?php

// 命名空間
namespace App\Http\Controllers;

use App\Shop\Entity\Merchandise;
use Validator; // 使用驗證器

class MerchandiseController extends Controller {

    // 新增商品
    public function merchandiseCreateProcess(){
        
        // 建立商品基本資訊
        $merchandise_data = [
            'status' => 'C', // 建立中
            'name' => '', // 商品名稱
            'name_en' => '', // 商品英文名稱
            'introduction' => '', // 商品介紹
            'introduction_en' => '', // 商品英文介紹
            'photo' => '', // 商品照片
            'price' => '', // 價格
            'reamin_count' => '', // 商品剩餘數量
        ];
        $Merchandise = Merchandise::create($merchandise_data);

        // 重新導向至商品編輯頁
        return redirect('/merchandise/' . $Merchandise->id . '/edit');
    }

    // 商品編輯
    public function merchandiseItemEditPage($merchandise_id)
    {
        // 撈取商品資料
        $Merchandise = Merchandise::findOrFail($merchandise_id);

        if(!is_null($Merchandise->photo)) {
            // 設定商品照片網址
            $Merchandise->photo = url($Merchandise->photo);
        }

        $binding = [
            'teitle' => '編輯商品',
            'Merchandise' => $Merchandise,
        ];
        return view('merchandise.editMerchandise', $binding);
    }

    // 商品資料更新處理
    public function merchandiseItemUpdateProcess($merchandise_id)
    {
        // 撈取商品資料
        $Merchandise = Merchandise::findOrFail($merchandise_id);
        // 接收輸入資料
        $input = request()->all();

        // 驗證規則
        $rules = [
            // 商品狀態
            'status' => [
                'required',
                'in:C,S',
            ],
            // 商品名稱
            'name' => [
                'required',
                'max:80',
            ],
            // 商品英文名稱
            'name_en' => [
                'required',
                'max:80',
            ],
            // 商品介紹
            'introduction' => [
                'required',
                'max:2000',
            ],
            // 商品英文介紹
            'introduction_en' => [
                'required',
                'max:2000',
            ],
            // 商品照片
            'photo' => [
                'file', // 必須為檔案
                'image', // 必須為圖片
                'max:10240', // 10MB
            ],
            // 商品價格
            'price' => [
                'required',
                'integer',
                'min:0',
            ],
            // 商品剩餘數量
            'remain_count' => [
                'required',
                'integer',
                'min:0',
            ],
        ];

        // 驗證資料
        $validator = Validator::make($input, $rules);

        if($validator->fails()) {
            // 資料驗證錯誤
            return redirect('/merchandise/' . $Merchandise->id . '/edit')->withErrors($validator)->withInput();
        }

        if(isset($input['photo'])) {
            // 有上傳圖片
            $photo = $input['photo'];
            // 檔案副檔名
            $file_extension = $photo->getClientOriginalExtension();
            // 產生自訂隨機檔案名稱
            $file_name = uniqid() . '.' . $file_extension;
            // 檔案相對路徑
            $file_relative_path = 'images/merchandise/' . $filename;
            // 檔案存放目錄為對外公開 public 目錄下的相對位置
            $file_path = public_path($file_relative_path);
            // 裁切圖片
            $image = Image::make($photo)->fit(450, 300)->save($file_path);
            // 設定圖片檔案相對位置
            $input['photo'] = $file_relative_path;
        }

        $Merchandise->update($input);

        // 重新導向到商品編輯頁
        return redirect('/merchandise/' . $Merchandise->id . '/edit');
    }
}