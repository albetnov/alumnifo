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

    public function baseRender($model, $field = null, ...$custom)
    {
        header('referrer-policy:same-origin');
        if (!is_null($field)) {
            $models = $this->search ? $model::where($field, 'like', "%{$this->search}%") : $model::latest();
        } else {
            $models = $this->search ? $model::where('name', 'like', "%{$this->search}%") : $model::latest();
        }
        if ($custom) {
            foreach ($custom as $custom) {
                $models = $this->search ? $models->orWhere($custom, 'like', "%{$this->search}%") : $model::latest();
            }
        }
        if ($this->filter_date) {
            $models->whereDate('created_at', '<=', $this->to)->whereDate('created_at', '>=', $this->from);
        }
        return $models;
    }
}
