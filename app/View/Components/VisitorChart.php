<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Shetabit\Visitor\Models\Visit;

class VisitorChart extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // $data = [
        //     'chart_title' => 'Visitors by Months',
        //     'report_type' => 'group_by_date',
        //     'model' => Visit::class,
        //     'group_by_field' => 'created_at',
        //     'group_by_period' => 'month',
        //     'chart_type' => 'bar',
        //     'chart_color' => '#4e54c8', // Custom color
        //     'chart_height' => '400px', // Custom height
        // ];

        // $chart1 = new LaravelChart($data);


        $data = [
            'chart_title' => 'Visitors by Months',
            'report_type' => 'group_by_date',
            'model' => Visit::class,
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
            'chart_color' => '#4e54c8', // Single color string
            'chart_height' => '400px',
        ];

        $chart1 = new LaravelChart($data);


        return view('components.visitor-chart', compact('chart1'));
    }
}
