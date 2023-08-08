<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Support\Str;
use \Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

trait WithBulkActions
{
    public Collection $selectedModels;
    public $selectAll = false;
    public $paginatedModels;


    public function mount()
    {
        $this->selectedModels = new Collection();
    }

    /*
    *
    * Handle the "select all" checkbox toggle event.
    *
    */
    public function updatedSelectAll()
    {
        if ($this->selectAll) {
            $this->selectedModels = collect($this->paginatedModels)->mapWithKeys(function ($model) {
                return [$model['id'] => true];
            });
        } else {
            $this->selectedModels = new Collection();
        }
    }

    public function getSelectedModels()
    {
        return $this->selectedModels->filter(fn ($p) => $p)->keys();
    }

    public function bulkDelete(string $modelClassName, array $modelIds)
    {
        // Delete the records from the specified model using the provided IDs.
        $modelClass = $modelClassName::whereIn('id', $modelIds);
        $modelClass->delete();

        // Get the human-readable model name.
        $modelName = Str::headline(class_basename($modelClassName), ' ');

        // Prepare the message based on the number of deleted entries.
        if (count($modelIds) === 1) {
            $formattedId = sprintf('%04d', $modelIds[0]);
            $message = "{$modelName} ID #" . $formattedId . " has been deleted.";
        } else {
            $message = count($modelIds) . " entries have been deleted.";
        }

        $this->emit('dataChanged', 'Deleted!', $message);
    }

    public function bulkExport(string $exportClass, string $fileName)
    {
        $modelIds = $this->getSelectedModels();
        if ($modelIds->isNotEmpty()) {
            return Excel::download(new $exportClass($modelIds), $fileName);
        }
    }
}
