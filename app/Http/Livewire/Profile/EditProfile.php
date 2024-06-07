<?php
namespace App\Http\Livewire\Profile;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class EditProfile extends Component
{
    use WithFileUploads;
    public $userId;
    public $user;

    public $ErroPasswordNotRepet;
    public $imagemPerfil;
    public $styleButton;

    public $Nivel;
    public $Status;
    public $Email;
    public $TelemovelUser;
    public $nomeUser;
    public $Senha;
    public $ConfirmeSenha;

    public function mount($userId)
    {
        $this->styleButton = "none";

        $this->userId = $userId;
        $this->user = User::find($userId);

        $this->nomeUser = $this->user->name;
        $this->Email = $this->user->email;
        $this->TelemovelUser = $this->user->telefone;
        $this->Nivel = $this->user->nivel;
        $this->Status = $this->user->status;
    }

    public function editarUser()
    {
        $this->validate([
            'nomeUser' => 'required',
            'Nivel' => 'required',
            'Status' => 'required',
            'Email' => 'required|email',
            'TelemovelUser' => 'required',
        ]);

        if ($this->imagemPerfil) {
            $fileName = $this->imagemPerfil->getClientOriginalName();
        } else {
            $fileName = $this->user->imagem;
        }

        $updateData = [
            'name' => $this->nomeUser,
            'nivel' => $this->Nivel,
            'status' => $this->Status,
            'email' => $this->Email,
            'imagem' => $fileName,
            'telefone' => $this->TelemovelUser,
        ];

        if ($this->Senha) {
            if($this->Senha == $this->ConfirmeSenha){
                $updateData['password'] = Hash::make($this->Senha);
            }else{
                $this->ErroPasswordNotRepet = "Activo";
            }
        }
        User::where('id', $this->userId)->update($updateData);

        return redirect()->route('profile.create')->with('message', 'Usuário atualizado com sucesso!')->with('status', 'success');
    }

    public function deletar()
    {
        User::findOrFail($this->userId)->delete();

        return redirect()->to('profile.create');
    }

    public function updatedImagemPerfil()
    {
        $this->styleButton = "block";
    }
    public function salvarImagem()
    {
        User::where('id', Auth::user()->id)->update([
            'imagem' => $this->imagemPerfil->getClientOriginalName(),
        ]);

        session()->flash('success', "Imagem alterada com sucesso");
        return view('livewire.profile.edit-profile');
    }

    public function render()
    {
        return view('livewire.profile.edit-profile', [
            'user' => $this->user,
        ]);
    }
}

