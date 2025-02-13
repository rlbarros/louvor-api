<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\CrudController;
use App\Models\Music\Music;
use App\Models\Music\Style;
use App\Models\Service\Service;
use App\Models\Service\ServiceMusic;
use App\Models\Service\ServiceMusicView;
use App\Models\Service\ServiceType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ServiceMusicController extends CrudController
{

    function model(): Model
    {
        return new ServiceMusic();
    }

    function view(): Model
    {
        return new ServiceMusicView();
    }

    function validations(): array
    {
        return [
            'service_id' => 'required',
            'music_id' => 'required'
        ];
    }

    function modelName(): string
    {
        return "música do culto";
    }

    function suggest(Request $request)
    {

        $serviceId = $request->get('service_id');
        if (empty($serviceId)) {
            return;
        }
        $service = Service::query()->where('id', $serviceId)->first();
        if (empty($service)) {
            return $this->sendError('object not found', null, 404);
        }
        $serviceType = ServiceType::query()->where('id', $service->service_type_id)->first();

        $musicCount = $serviceType->music_count;

        $musics = Music::all()->toArray();
        $styles = Style::all()->toArray();

        $stylesMusics = array();
        foreach ($styles as $style) {
            $styleId = $style['id'];

            $musicsStyle = array_filter(
                $musics,
                function ($item) use ($styleId) {
                    return $item['style_id'] == $styleId;
                },
                ARRAY_FILTER_USE_BOTH
            );
            $stylesMusics[$styleId] = $musicsStyle;
        }

        $division = floor($musicCount / count($styles));
        $rest = $musicCount % count($styles);
        $pickArray = array();
        for ($i = 0; $i < count($styles); $i++) {
            if ($i == 0) {
                if ($rest > 0) {
                    array_push($pickArray, $rest + $division);
                } else {
                    array_push($pickArray, $division);
                }
            } else {
                array_push($pickArray, $division);
            }
        }

        $randomMusics = array();
        for ($i = 0; $i < count($styles); $i++) {
            $style = $styles[$i];
            $styleId = $style['id'];
            $pickCount = $pickArray[$i];
            $pickedMusics = $stylesMusics[$styleId];
            if ($pickedMusics) {
                $randomItems = array_rand($pickedMusics, $pickCount);
                foreach ($randomItems as $randomIndex) {
                    $randomItem = $pickedMusics[$randomIndex];
                    array_push($randomMusics, $randomItem);
                }
            }
        }

        $servicesMusicsIds = array();

        for ($i = 0; $i < count($randomMusics); $i++) {
            $randomMusic = $randomMusics[$i];
            $serviceMusic = new ServiceMusic();
            $serviceMusic->music_id = $randomMusic['id'];
            $serviceMusic->service_id = $service->id;
            $serviceMusic->save();
            array_push($servicesMusicsIds, $serviceMusic->id);
        }

        $servicesMusicsView = ServiceMusicView::whereIn('id', $servicesMusicsIds)->get();

        return $this->sendResponse($servicesMusicsView, 'registros retornados com sucesso com sucesso.');
    }
}
