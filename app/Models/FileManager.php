<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileManager extends Model
{
    use HasFactory, SoftDeletes, ClearsResponseCache;

    /**
     * Default Root Folder Id
     * 
     * @var const
     */
    public const ROOT = '00000000-00000000-00000000-00000000';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'file_manager';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'folder_slug', 'folder_id'];
}
