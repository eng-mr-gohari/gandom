<?php


namespace App\Repositories\ProductRepository;


use App\Http\Resources\ProductListResource;
use App\Models\Product;

class EloquentProductRepository implements IEloquentProductRepository
{
    /**********************************
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function listActive()
    {
        return ProductListResource::collection(
            Product::show()->orderByDesc('id')
                ->TakeLast()->get()
        );
    }

    /*************************
     * @param $id
     * @return ProductListResource
     */
    public function showActive($id)
    {
        return ProductListResource::make(
            Product::whereId($id)->Show()->firstOrFail()
        );
    }


}
