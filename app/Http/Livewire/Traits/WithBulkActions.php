<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

trait WithBulkActions
{
    public Collection $selectedModels;
    public bool $selectAll = false;
    public string $searchQuery = "";
    public $paginatedModels;

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
        $this->selectedModels = $this->selectAll
            ? collect($this->paginatedModels)->keyBy('id')
            : new Collection();
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

        if (count($modelIds) === 1) {
            $formattedId = sprintf('%04d', $modelIds[0]);

            $message = "{$modelName} ID #{$formattedId} has been deleted.";
        } else {
            $message = count($modelIds) . " entries have been deleted.";
        }

        $this->dispatchBrowserEvent(
            "swal:notification",
            [
                "type" => "success",
                "title" => "Deleted!",
                "text" => $message,
            ]
        );
    }

    public function confirmDelete(string $modelClassName, array $modelIds)
    {
        $this->dispatchBrowserEvent(
            "swal:confirm_delete",
            [
                "type" => "warning",
                "title" => "Are you sure?",
                "text" => "You won't be able to revert this!",
                "modelName" => $modelClassName,
                "ids" => $modelIds,
            ]
        );
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
