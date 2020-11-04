<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
    private $post_id, $remote_ip;

    /**
     * Author the post belongs to
     */
    public function tags() {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * Get the post's author
     */
    public function author() {
        return $this->belongsTo(User::class);
    }

    /**
     * Views counter
     *
     * Simple posts visits counter. This will help display to the writers some statistics.
     *
     * @uses post id
     *
     * @return boolean
     */
    public function visitor_counter($post, $remote_ip) {

        $this->post_id = $post;
        $this->remote_ip = $remote_ip;

        /**
         * Search for any previous sessions. If the same person visited the same post multiple
         * times, from the same computer, a new visit will only be registered after 30 minutes
         * have passed. All interactions within 30 minutes that come from the same IP will be
         * considered as part of the same session.
         */

        $record = DB::table('post_views')
            ->where('post_id', $this->post_id)
            ->where('ip_address', $this->remote_ip)
            ->where('updated_at', '>', Carbon::now()->subMinutes(30)->toDateTimeString() )
            ->get()
            ->toArray();

        if ( count( $record ) < 1) {
            // Create record on database.
            DB::table('post_views')->insert([
                'post_id' => $this->post_id,
                'ip_address' => $this->remote_ip,
                'views' => 1,
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        }
    }
}
