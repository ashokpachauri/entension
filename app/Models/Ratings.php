<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
class Ratings extends Model
{
    use  HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table ='post_ratings';
    protected $fillable = [
        'user_id',
        'posts_id',
        'content',
        'rating',
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
    public function posts(){
        $this->belongsTo(Posts::class,'posts_id','id');
    }
}
