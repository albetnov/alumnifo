<?php

namespace App\Http\Livewire\Modules;

use Carbon\Carbon;

trait BaseTable
{
    public $filter;
    public $from;
    public $to;
    public $search;
    public $filter_date;
    public $byYear;

    public function closeAll()
    {
    }

    public function updatedBase($fields)
    {
        if ($fields == 'to' || $fields == 'from') {
            if ($this->byYear) {
                $this->validate([
                    'from' => 'required|numeric|digits:4',
                    'to' => 'required_with:from|numeric|digits:4'
                ]);
            } else {
                $this->validate([
                    'from' => 'required',
                    'to'   => 'required_with:from|date|after:from',
                ]);
            }

            return;
        }
        if ($fields == 'search') {
            return;
        }
        $this->validateOnly($fields);
    }

    public function clearFilter()
    {
        $this->from = '';
        $this->to = '';
        $this->closeAll();
        $this->filter_date = false;
        $this->filter = false;
    }

    public function updatedTo()
    {
        if ($this->byYear) {
            $this->validate([
                'from' => 'required|numeric|digits:4',
                'to' => 'required_with:from|numeric|digits:4|after_or_equal:from'
            ]);
        } else {
            $this->validate([
                'from' => 'required',
                'to'   => 'required_with:from|date|after_or_equal:from',
            ]);
            $this->from = Carbon::parse($this->from)->format('Y-m-d');
            $this->to = Carbon::parse($this->to)->format('Y-m-d');
        }
        $this->filter_date = true;
        $this->filter = true;
        $this->closeAll();
    }

    public function filterUsingYear(Bool $boolean)
    {
        $this->byYear = $boolean;
    }

    public function baseRender($model)
    {
        header('referrer-policy:same-origin');
        $models = $this->search ? $model::search($this->search) : $model::latest();
        if ($this->filter_date) {
            if ($this->byYear) {
                $models->where('tahun_kerja', '<=', $this->to)->where('tahun_kerja', '>=', $this->from);
            } else {
                $models->whereDate('created_at', '<=', $this->to)->whereDate('created_at', '>=', $this->from);
            }
        }

        return $models;
    }
}
