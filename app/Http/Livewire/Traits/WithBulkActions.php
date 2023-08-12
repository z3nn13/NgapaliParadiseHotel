<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

trait WithBulkActions
{
    /**
     * Collection to hold the selected models.
     *
     * @var Collection
     */
    public Collection $selectedModels;

    /**
     * Flag to determine if "select all" is checked.
     *
     * @var bool
     */
    public $selectAll = false;

    /**
     * String to store search query inputs.
     *
     * @var bool
     */
    public $searchQuery = "";

    /**
     * Collection to store paginated models.
     *
     * @var mixed
     */
    public $paginatedModels;

    /**
     * Initialize the selected models collection.
     *
     * @return void
     */
    public function mount()
    {
        $this->selectedModels = new Collection();
    }

    /**
     * Load paginated items for the given model class and items per page.
     *
     * @param string $modelClass
     * @param int $items_per_page
     * @return mixed
     */
    public function loadPageItems($modelClass, $items_per_page)
    {
        $data = $modelClass::when($this->searchQuery, fn ($query) => $query
            ->searchBy(trim($this->searchQuery)))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($items_per_page);

        $this->paginatedModels = $data->items();
        return $data;
    }

    /**
     * Handle the change event of the "select all" checkbox.
     *
     * @return void
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

    /**
     * Get the selected models' keys.
     *
     * @return mixed
     */
    public function getSelectedModels()
    {
        return $this->selectedModels->filter(fn ($p) => $p)->keys();
    }

    /**
     * Perform bulk delete operation on selected models.
     *
     * @param string $modelClassName
     * @param array $modelIds
     * @return void
     */
    public function bulkDelete(string $modelClassName, array $modelIds)
    {
        $modelClass = $modelClassName::whereIn('id', $modelIds);
        $modelClass->delete();

        $modelName = Str::headline(class_basename($modelClassName), ' ');

        /* Prepare the message based on the number of deleted entries. */
        if (count($modelIds) === 1) {
            $formattedId = sprintf('%04d', $modelIds[0]);
            $message = "{$modelName} ID #" . $formattedId . " has been deleted.";
        } else {
            $message = count($modelIds) . " entries have been deleted.";
        }

        $this->emit('dataChanged', 'Deleted!', $message);
    }

    /**
     * Perform bulk export of selected models.
     *
     * @param string $exportClass
     * @param string $fileName
     * @return mixed
     */
    public function bulkExport(string $exportClass, string $fileName)
    {
        $modelIds = $this->getSelectedModels();
        if ($modelIds->isNotEmpty()) {
            return Excel::download(new $exportClass($modelIds), $fileName);
        }
    }
}
