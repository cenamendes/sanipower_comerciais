<div>

    <div class="modal-body">
        <div class="containe-img-master">
            <div class="containe-img">
                @if($imagemPerfil !== null)
                    <img src="{{$imagemPerfil->temporaryUrl()}}" style="width: 120px;height: 120px;border-radius: 150px;" alt="logo do usuario">
                @else
                    <div class="img-temporary">A</div>
                @endif
                <div class="container-buttons-img">
                    <input id="input-open-file" class="input-personalizado" type="file" wire:model="imagemPerfil" style="background-color: rgb(36 54 69 / 50%);">
                    <i class="fa fa-camera"></i>
                </div>
            </div>
            <button class="btn btn-primary mt-2" type="button" style="display:{{$styleButton}};" wire:click="salvarImagem">   <span role="status">Guardar</span></button>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-12">
                        <label class="mt-2">Nome do Utilizador</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nome do Cliente" wire:model.lazy="nomeUser">
                        </div>
                        @error('nomeUser')  <span class="text-danger">O campo Choose file da promoçao é obrigatório.</span> @enderror
                    </div>
                    <div class="col-lg-12">
                        <label class="mt-2">Email</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Número do Cliente" wire:model.lazy="Email">
                        </div>
                        @error('Email')  <span class="text-danger">O campo Choose file da promoçao é obrigatório.</span> @enderror
                    </div>
                    <div class="col-lg-3">
                        <label class="mt-2">Status</label>
                        <select class="form-control selectpicker" wire:model.lazy="Status">
                            <option value="">Status</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                        @error('Status')  <span class="text-danger">O campo Choose file da promoçao é obrigatório.</span> @enderror
                    </div>
                    <div class="col-lg-3">
                        <label class="mt-2">Nivel</label>
                        <select class="form-control selectpicker" wire:model.lazy="Nivel">
                            <option value="1">Nivel 1</option>
                            <option value="2">Nivel 2</option>
                            <option value="3">Nivel 3</option>
                        </select>
                        @error('Nivel')  <span class="text-danger">O campo Choose file da promoçao é obrigatório.</span> @enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="mt-2">Telemóvel</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Telemóvel" wire:model.lazy="TelemovelUser">
                        </div>
                        @error('TelemovelUser')  <span class="text-danger">O campo Choose file da promoçao é obrigatório.</span> @enderror
                    </div>
                    <div class="col-lg-12">
                        <label class="mt-2">Palavra-Passe</label>
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Palavra-Passe" wire:model.lazy="Senha">
                        </div>
                        @error('Senha')  <span class="text-danger">O campo Choose file da promoçao é obrigatório.</span> @enderror
                    </div>
                    <div class="col-lg-12">
                        <label class="mt-2">Confirme a Palavra-Passe</label>
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Confirme a Palavra-Passe" wire:model.lazy="ConfirmeSenha">
                        </div>
                        @if($ErroPasswordNotRepet == "Activo")
                            <span class="text-danger">As senhas não correspondem.</span>
                        @else
                            @error('ConfirmeSenha')  <span class="text-danger">O campo Choose file da promoçao é obrigatório.</span> @enderror
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-success" wire:click="CriarUser" >Criar</button>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
    </div>
</div>