<?php

namespace App\Http\Livewire\Modules;

use Carbon\Carbon;

trait BaseTable
{
    public $filter, $from, $to, $search, $filter_date;

    public function closeAll()
    {
        return;
    }

    public function updated($fields)
    {
        if ($fields == 'to' || $fields == 'from') {
            $this->validate([
                'from' => 'required',
                'to' => 'required_with:from|date|after:from'
            ]);
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
        $this->validate([
            'from' => 'required',
            'to' => 'required_with:from|date|after_or_equal:from'
        ]);
        $this->filter_date = true;
        $this->filter = true;
        $this->from = Carbon::parse($this->from)->format('Y-m-d');
        $this->to = Carbon::parse($this->to)->format('Y-m-d');
        $this->closeAll();
    }

    public function baseRender($model)
    {
        header('referrer-policy:same-origin');
        $models = $this->search ? $model::search($this->search) : $model::latest();
        if ($this->filter_date) {
            $models->whereDate('created_at', '<=', $this->to)->whereDate('created_at', '>=', $this->from);
        }
        return $models;
    }
}