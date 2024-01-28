<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Comments;
use App\Models\Categories;
use App\Models\Ratings;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
class Posts extends Model
{
    use  HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table ='posts';
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'snippet_content',
        'featured_image',
        'snippet_image',
        'snippet_content',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_image',
        'tags',
        'slug',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'user_id',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function user(){
        $this->belongsTo(User::class,'user_id','id');
    }
    public function category(){
        $this->belongsTo(Categories::class,'category_id','id');
    }
    public function comments(){
        $this->hasMany(Comments::class,'post_id','id');
    }
    public function ratings(){
        $this->hasMany(Ratings::class,'post_id','id');
    }
}
