<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsModel;

class ProductsController extends Controller
{
    // Ação para acessar a pagina do módulo de produtos
    public function CPanelProducts(Request $request)
    {
        $search = $request->validate([
            'src' => 'nullable|string',
        ]);

        $query = ProductsModel::orderBy(
                'nome', 'ASC'
            )->where(
                'status', 1
            );

        if ($search) {
            $query->where(
                'nome', 'like', '%' . $search['src'] . '%'
            );
        }

        $products = $query->get();

        return view('products', [
            'search' => $search,
            'products' => $products
        ]);
    }

    public function CadProduct() {
        return view('product');
    }

    public function EditProduct(ProductsModel $product)
    {
        return view('/product', [
            'product' => $product
        ]);
    }
    // Ação para efetuar o cadastro e edição do produto
    public function ProductDo(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'quantidade' => 'required|integer',
            'preco' => 'required|string',
            'descricao' => 'nullable|string'
        ]);

        $brPrice = str_replace(['.', ','], ['', '.'], $request->preco);

        ProductsModel::updateOrCreate(
            [
                'id' => $request->id
            ],[
                'nome' => $request->nome,
                'quantidade' => $request->quantidade,
                'preco' => $brPrice,
                'descricao' => $request->descricao
            ]
        );

        return response()->json([
            'status' => "success",
            'message' => "Dados salvos com sucesso."
        ]);
    }
    // Ação para excluir o registro no BD
    public function DelProductDo(Request $request)
    {
        if (!empty($request)) {
            ProductsModel::where(
                'id',$request->idDelete
            )->update([
                'status' => 2
            ]);

            return response()->json([
                'status' => "success",
                'message' => "Registro excluido com sucesso."
            ]);
        }
    }
    // Ação para visualizar as informações do produto selecionado
    public function ProductInfo(Request $request)
    {
        $product = ProductsModel::where(
            'id', $request->idProduct
        )->first();

        $HTML = "<li class=\"col-12\"><b>Produto:</b> " . $product->nome . "</li>
                <li class=\"col-12\"><b>Quantidade:</b> " . $product->quantidade . "</li>
                <li class=\"col-12\"><b>Preço:</b> R$ " . number_format($product->preco, 2, ',', '.') . "</li>
                <li class=\"col-12\"><b>Descrição:</b> " . $product->descricao . "</li>";

        return response()->json([
            'status' => "success",
            'message' => "Informação encontrada com sucesso.",
            'html' => $HTML
        ]);
    }
}
