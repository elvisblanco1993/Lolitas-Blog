<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Charts\PostsByVisitsChart;
use App\Models\Post;
use Carbon\Carbon;

class DashboardController extends Controller
{

    /**
     * Returns dashboard view
     */
    public function display () {
        $most_visited = $this->posts_by_visits();
        $total_views = DB::table('post_views')->get()->count();

        return view('dashboard', [
            'total_views' => $total_views,
            'most_visited' => $most_visited,
            'chart_post_by_visits' => $this->graph_post_by_visits(),
        ]);
    }

    /**
     *  Rank posts by view
     */
    public function posts_by_visits () {
        return DB::table('post_views')
                ->select(DB::raw('post_id, count(*) as visits'))
                ->groupBy('post_id')
                ->orderByDesc('visits')
                ->get();
    }


    /**
     * Total Count Graph on Dashboard
     *
     * @return Graph
     */
    public function graph_post_by_visits () {
        $from = new Carbon;
        $from = $from->subWeek();
        $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(array_column($this->yearly_total_count(), 'month'))
        ->datasets([
            [
                "label" => "Monthly Total Views",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => array_column($this->yearly_total_count(), 'views'),
            ],
        ])
        ->options([]);

        return $chartjs;
    }

    /**
     * Yearly total views counter by month
     *
     * @return Array
     */
    protected function yearly_total_count () {
        return DB::table('post_views')
                ->whereYear('created_at', Carbon::now())
                ->select(DB::raw("strftime('%m', created_at) as month"),DB::raw("count('views') as views"))
                ->groupBy('month')
                ->get()
                ->toArray();
    }
}
