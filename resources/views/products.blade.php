<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Produtos</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="w-100" style="background-color: #EEE;">
        <div class="d-flex justify-content-center">
            <div id="msg-popup" class="animate__animated">
                <i></i>
                <span></span>
                <form id="form-delete" name="form-delete" class="btns-delete d-none text-center">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="route-delete" name="route-delete"  value="{{ route('del.product.do') }}">
                    <input type="hidden" id="idDelete" name="idDelete">
                    <button type="button" class="n-user btn btn-success btn-sm">Cancelar</button>
                    <button type="submit" class="y-user btn btn-danger btn-sm">Excluir</button>
                </form>
                <div class="time-bar bar" data-style="smooth"></div>
            </div>
        </div>
        <div id="modal-info" class="animate__animated animate__fadeInDownBig py-4 px-4" data-status="off" style="width: 50%;left: 25%;">
            <div class="d-flex justify-content-center">
                <h4 class="w-100 text-center"><b>INFORMAÇÕES</b></h4>
                <a href="#" class="btn btn-danger btn-close-modal-info"><b class="text-white">X</b></a>
            </div>
            <ul id="container-info" class="row pt-3">
            </ul>
        </div>
        <div id="container-products">
            <p class="m-3 p-3 bg-secondary text-white"><i class="bi bi-caret-right-fill text-white"></i> Módulo Produtos</p>
            <div class="m-3 p-4 row bg-white">
                <form id="form-search" name="form-search" autocomplete="off" method="GET" style="padding-left: 0;" class="animate_animated animate__fadeInDownBig">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" id="src" name="src" class="form-control" data-module="product" placeholder="Buscar produto">
                        <div class="input-group-append">
                            <button id="btn-search" name="btn-search" class="btn btn-primary text-white" type="button">
                                <span class="text-white bi bi-search"> buscar</span>
                            </button>
                            <a href="{{ url('/product') }}" class="btn btn-success text-white">
                                <span class="text-white bi bi-plus-square"> novo</span>
                            </a>
                        </div>
                    </div>
                </form>
                <ul id="container-list" name="container-list" class="list-group">
                    <li class="list-group-item list-group-item-secondary">
                        <div class="col-7 fw-bolder text-secondary">Listagem</div>
                    </li>

                    @if(@$products->isEmpty() && @$search['src'] != '')

                        <li class="list-group-item">
                            <div class="col-7 pt-1">Não há registro(s) de produto(s) com o termo digitado (<b class="fw-bold">{{ @$search['src']; }}</b>).</div>
                            <div class="col-2 fw-bolder pt-1"></div>
                            <div class="container-actions col-3 fw-bolder text-end"></div>
                        </li>

                    @else

                        @if(@$products->isEmpty())

                            <li class="list-group-item">
                                <div class="col-7 pt-1">Não há registro(s) de produto(s) cadastrado(s).</div>
                                <div class="col-2 pt-1"></div>
                                <div class="container-actions col-3 fw-bolder text-end"></div>
                            </li>

                        @else

                            @foreach($products as $product)

                            <li id="line-{{ $product->id }}" class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="col-4 pt-1">{{ $product->nome }}</div>
                                <div class="container-actions col-3 fw-bolder text-end">
                                    <a type="button" href="#" target="_self" data-product="{{ @$product->id }}" class="info-product btn btn-secondary btn-sm text-white">
                                        <i class="bi bi-info-circle pt-1 me-1 text-white"></i>Detalhes
                                    </a>
                                    <a type="button" href="{{ route('edit.product', @$product->id) }}" target="_self" class="edit-user btn btn-primary btn-sm text-white">
                                        <i class="bi bi-pencil-fill pt-1 me-1 text-white"></i>Editar
                                    </a>
                                    <button type="submit" data-id="{{ $product->id }}" data-module="user" class="delete btn btn-danger btn-sm">
                                        <i class="bi bi-trash-fill pt-1 me-1 text-white"></i>Excluir
                                    </button>
                                </div>
                            </li>

                            @endforeach

                        @endif

                    @endif

                </ul>
            </div>
        </div>
    </body>
</html>
