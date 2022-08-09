<?php

namespace App\Services;

use App\Http\Requests\PositionRequest;
use App\Models\Position;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PositionService
{

    public function store(PositionRequest $request, ?Position $position = null)
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['image'] = $this->imageUpload($data['image'], $position);
        }
        if (isset($position)){
            $position->update($data);
        }else{
            $position = Position::create($data);
        }
        $this->updloadValues($request->all(), $position);
    }

    private function updloadValues(array $data, Position $position)
    {
        $values = $this->getValues($data);
        $position->values()->sync($values);
    }

    private function imageUpload(UploadedFile $file, ?Position $position = null)
    {
        if (isset($position)) Storage::delete($position->image);
        return Storage::put('/images', $file);
    }

    private function getValues(array $data): array
    {
        $values = [];
        foreach ($data as $k => $item) {
            if (is_int($k)) {
                $values[] = $item;
            }
        }
        return $values;
    }
}
