<div>
    <div class="containe-img-master">
        <div class="containe-img">
            @if($imagemPerfil !== null)
                <img src="{{$imagemPerfil->temporaryUrl()}}" alt="logo do usuario">
            @else
                @if(Auth::user()->imagem == null || Auth::user()->imagem  == "")
                    <div class="img-temporary">{{ ucfirst(substr(Auth::user()->name, 0, 1)) }}</div>
                @else
                    <img src="{{ asset('storage/profile/' . Auth::user()->imagem) }}" alt="logo do usuário">
                @endif
            @endif
            <div class="container-buttons-img">
                <input id="input-open-file" onclick="alternarVisibilidade()" class="input-personalizado" type="file" wire:model="imagemPerfil" style="background-color: rgb(36 54 69 / 50%);">
                <i class="fa fa-camera"></i>
            </div>

            </div>
        
            <button class="btn btn-primary mt-2" type="button" style="display:{{$styleButton}};" wire:click="salvarImagem">  <span class="spinner-border spinner-border-sm" wire:loading.delay aria-hidden="true"></span>  <span role="status">Guardar</span></button>
    </div>

</div>