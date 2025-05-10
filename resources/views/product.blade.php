<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Produtos</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="w-100" style="background-color: #EEE;">
        <div class="d-flex justify-content-center">
            <div id="msg-popup" class="animate__animated">
                <i></i>
                <span></span>
                <div class="time-bar bar" data-style="smooth"></div>
            </div>
        </div>
        <div id="container-products">
            <p class="m-3 p-3 bg-secondary text-white"><i class="bi bi-caret-right-fill text-white"></i> <a href="{{ route('cpanel.products') }}" target="_self" class="text-white text-decoration-none">Módulo Produtos</a> <i class="bi bi-caret-right-fill text-white"></i> {{ @$product ? 'Editar' : 'Cadastrar' }} Produto</p>
            <div class="m-3 px-2 pt-4 py-2 row bg-white">
                <form id="form-product" name="form-product" class="row" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                    <div class="col-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nome" name="nome" value="{{ @$product->nome }}" required>
                            <label for="nome">Nome*</small></label>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="quantidade" name="quantidade" value="{{ @$product ? $product->quantidade : 1 }}" required>
                            <label for="quantidade">Quantidade*</small></label>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="preco" name="preco" value="{{ old('preco', @$product->preco) }}" required>

                            <label for="preco">Preço*</small></label>
                        </div>
                    </div>

                    <div class="col-12 mt-1">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="4">{{ @$product->descricao }}</textarea>
                    </div>

                    <div class="mt-3 gap-2">
                        <input type="hidden" id="id" name="id" value="{{ @$product->id }}">
                        <input type="hidden" id="route" name="route" value="{{ route('product.do') }}">
                        <input id="salvar" type="submit" value="SALVAR" class="btn btn-success btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
