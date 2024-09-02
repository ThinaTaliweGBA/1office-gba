<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

// {{-- define a class that encapsulates the behavior of fetching data and generating JavaScript for pie charts --}}
public class DistributionReport
{
    private $table;
    private $column;
    private $labelMapping = [];

    public function __construct(string $table, string $column)
    {
        $this->table = $table;
        $this->column = $column;
    }

    public function setLabelMapping(array $mapping)
    {
        $this->labelMapping = $mapping;
    }

    public function fetchData()
    {
        return DB::table($this->table)
            ->select($this->column, DB::raw('count(*) as count'))
            ->groupBy($this->column)
            ->get();
    }

    public function getLabels()
    {
        return $this->fetchData()->map(function ($data) {
            return $this->labelMapping[$data->{$this->column}] ?? 'Unknown';
        });
    }

    public function getValues()
    {
        return $this->fetchData()->pluck('count');
    }
}
