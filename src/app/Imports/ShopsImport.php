<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;
use App\Models\Shop;


class ShopsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $validator = Validator::make($row, [
            'shop_name'   => 'required|string|max:50',
            'area_id'     => 'required',
            'genre_id'    => 'required',
            'description' => 'required|string|max:400',
            'image'       => 'required|url',
        ]);


        if ($validator->fails()) {
            throw new \Exception('バリデーションエラー: ' . implode(' , ', $validator->errors()->all()));
        }

        $imageUrl = $row['image'];
        $path = parse_url($imageUrl, PHP_URL_PATH); // URL からパス部分を取得
        $extension = pathinfo($path, PATHINFO_EXTENSION); // パス部分から拡張子を取得

        if(!in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
            throw new \Exception('画像ULRはjpegまたはpng形式のみアップロード可能です');
        }


        return new Shop([
            'shop_name'   => $row['shop_name'],
            'area_id'     => $row['area_id'],
            'genre_id'    => $row['genre_id'],
            'description' => $row['description'],
            'image'       => $row['image'],
        ]);
    }

}
