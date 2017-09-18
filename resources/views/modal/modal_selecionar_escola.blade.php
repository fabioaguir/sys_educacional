<!-- Modal principal de disciplinas -->
<div id="modal-escolas" class="modal fade modal-profile" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalProfile" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%;">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                {{--<button class="close" type="button" data-dismiss="modal">X</button>--}}
                <h4 class="modal-title">Selecione a escola</h4>
            </div>

            {!! Form::open(['route'=>'default.changeescola', 'id' => 'form', 'method' => "POST" ]) !!}
            <div class="modal-body" style="alignment-baseline: central">
                <div class="modal-body">
                    <select class="form-control" name="escola">
                        @if(Session::has('escolas'))
                            @foreach(Session::get('escolas') as $escola)
                                <option value="{{ $escola->id }}">{{ $escola->nome }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Selecionar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>