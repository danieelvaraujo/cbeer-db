<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Redirect,Response,File;
use App\Producao;

class ProducaoController extends Controller
{
    public function index()
    {
        $producao = Producao::all();
        $data = $producao->toArray();

        if (is_null($producao)) {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'Produção não encontrada.'
            ];
            return response()->json($response, 404);
        }

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Lista de produção recebida com sucesso.'
        ];

        return response()->json($response, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $image = $request->file('foto_producao');
        
        $validator = Validator::make($input, [
            // 'foto_producao' => 'nullable|image|mimes:jpeg,jpg,bmp,png',
            'foto_producao' => 'nullable',
            'lote' => 'required',
            'nome_producao' => 'required',
            'nome_produtor' => 'required',
            'data_producao' => 'required',
            'og_producao' => 'required',
            'acompanhamento' => 'nullable',
            'maturacao' => 'required',
            'data_envase' => 'required',
        ]);
     
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Erro de validação',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }

        if ($image) {
           $image->store('images', 'public');
        }

        $producao = Producao::create($input);
        $data = $producao->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Nova produção adicionada ao banco.'
        ];

        return response()->json($response, 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producao = Producao::find($id);
        $data = $producao->toArray();

        if (is_null($producao)) {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'Produção não encontrada.'
            ];
            return response()->json($response, 404);
        }


        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Produção encontrada com sucesso.'
        ];

        return response()->json($response, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producao $producao)
    {
        $input = $request->all();
        $image = $request->file('foto_producao');

        $validator = Validator::make($input, [
            'foto_producao' => 'nullable',
            'lote' => 'required',
            'nome_producao' => 'required',
            'nome_produtor' => 'required',
            'data_producao' => 'required',
            'og_producao' => 'required',            
            'acompanhamento' => 'nullable',
            'maturacao' => 'required',
            'data_envase' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }

        if ($image) {
            $image->store('images', 'public');
         }

        $producao->foto_producao = $input['foto_producao'];
        $producao->lote = $input['lote'];
        $producao->nome_producao = $input['nome_producao'];
        $producao->nome_produtor = $input['nome_produtor'];
        $producao->data_producao = $input['data_producao'];
        $producao->og_producao = $input['og_producao'];
        $producao->acompanhamento = $input['acompanhamento'];
        $producao->maturacao = $input['maturacao'];
        $producao->data_envase = $input['data_envase'];
        $producao->save();

        $data = $producao->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Produção atualizada com sucesso.'
        ];

        return response()->json($response, 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producao $producao)
    {
        $producao->delete();
        $data = $producao->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Produção deletada com sucesso.'
        ];

        return response()->json($response, 200);
    }
}
