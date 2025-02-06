<?php

namespace App\Http\Controllers;

use App\Enums\App\AppCrudAction;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


abstract class CrudController extends BaseController
{

    abstract function model(): Model;

    abstract function validations(): array;

    abstract function modelName(): string;

    /** overridable functions  */
    function view(): Model
    {
        return $this->model();
    }

    function cache()
    {
        return false;
    }

    /** end overridable functions  */


    public function validation(Request $request)
    {
        return $this->sendObject($this->validations(), $request, 'registros validados com sucesso');
    }


    function afterCrudAction($action, $old, $new) {}

    public function index(Request $request)
    {
        $registros = $this->view()->get();
        return $this->sendResponse($registros, 'registros retornados com sucesso com sucesso.');
    }

    public function id(Request $request)
    {
        $id = $request->route('id');
        if (empty($id)) {
            return $this->sendUnprocessableByMissingId($request->path());
        }

        $object = $this->view()::find($id);

        if (empty($object)) {
            return $this->sendError('id ' . $id . ' nnão encontrado', null, 404);
        }
        return $this->sendResponse($object, $request);
    }

    public function save(Request $request)
    {

        $request->validate($this->validacoes());

        $id = $request->get('id');
        $data = $request->all();


        DB::beginTransaction();
        try {
            if (empty($id)) {
                try {
                    $object = $this->model();
                    $object->fill($data);
                    $object->save();
                    $this->afterCrudAction(AppCrudAction::save, null, $object);
                    $message =  "registro de " . $this->modelName() . " criado com sucesso";
                    return $this->sendCreated($data, $message);
                } catch (Exception $e) {
                    return $this->sendError($e->getMessage(), $data, 422);
                }
            } else {

                $object = $this->model()::find($id);
                $updateObject =  clone $object;

                foreach ($data as $prop => $value) {
                    $updateObject->{$prop} = $value;
                }
                try {
                    $updateObject->save();
                    $this->afterCrudAction(AppCrudAction::update,  $object, $updateObject);
                    $message =  "registro de " . $this->modelName() . " " .  $updateObject->toStringClass() . " atualizado com sucesso";
                    return $this->sendUpdated($updateObject, $message);
                } catch (Exception $e) {
                    return $this->sendError($e->getMessage(), $data, 422);
                }
            }
        } catch (Exception  $e) {
            DB::rollBack();
            return $this->sendError('erro na transação', $e->getMessage());
        }
    }


    public function delete(Request $request)
    {

        $id = $request->route('id');
        if (empty($id)) {
            return $this->sendUnprocessableByMissingId($request->path());
        }

        $model = $this->model()::find($id);
        if (empty($model)) {
            return $this->sendError('object not found', null, 404);
        }
        try {
            $model->delete();
            $this->afterCrudAction(AppCrudAction::delete, $model, null);
            return $this->sendDeleted($model, 'registro de ' . $this->modelName() . ' ' . $model->toStringClass() . ' excluido com sucesso.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), $model, 422);
        }
    }
}
