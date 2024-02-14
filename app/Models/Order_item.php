<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $order_item_id
 * @property integer $order_id
 * @property integer $product_id
 * @property string $product_name
 * @property integer $product_price
 * @property integer $qty
 * @property integer $subtotal
 * @property Product $product
 * @property Order $order
 */
class Order_item extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'order_item_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['order_id', 'product_id', 'product_name', 'product_price', 'qty', 'subtotal'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', null, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order', null, 'order_id');
    }
}
