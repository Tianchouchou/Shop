<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AddressModel extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'address';
    /**
     * 关联到模型的主键
     *
     * @var string
     */
    protected  $primaryKey='id';
    /**
     * 执行模型是否自动维护时间戳.
     *
     * @var bool
     */
    public $timestamps = false;
}
