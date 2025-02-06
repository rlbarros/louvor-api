<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $code = 200, $acao = 'consulta', $sucesso = true)
    {
        $response = [
            'acao' => $acao,
            'codigo_http' => $code,
            'conteudo' => $result,
            'mensagem' => $message,
            'sucesso' => $sucesso,
        ];

        return response()->json($response, $code);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendCreated($result, $message)
    {
        return $this->sendResponse($result, $message, 201, 'criacao');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendUpdated($result, $message)
    {

        return $this->sendResponse($result, $message, 200, 'atualizacao');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendDeleted($result, $message)
    {

        return $this->sendResponse($result, $message, 200, 'exclusao');
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 500)
    {
        $response = [
            'codigo_http' => $code,
            'mensagem' => $error,
            'sucesso' => false,
        ];

        if (!empty($errorMessages)) {
            $response['conteudo'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function sendUnprocessableByMissingId($path)
    {
        return $this->sendError('não foi fornecido o id no final da rota ' . $path . '. era esperado no final o /{:id}', [], 422);
    }

    public function sendUnprocessableByUnmatchingId($pathId, $bodyId)
    {
        return $this->sendError('id fornecido na url: \'' . $pathId, '\'não confere com o id fornecido no corpo da requisição \'' . $bodyId . '\'', [], 422);
    }
}
