<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
       
        try {
            $validated = $request->validateWithBag('updatePassword', [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);
    
            $request->user()->update([
                'password' => Hash::make($validated['password']),
            ]);

            session()->flash('success', "Password atualizada com sucesso");
    
            return back()->with('status', 'password-updated');
        } catch (ValidationException $e) {
            $errors = $e->errors();
            // Aqui você pode enviar os erros para o "toaster"
            // Por exemplo, usando o método session()->flash() para enviar mensagens de erro para a próxima requisição
           
            foreach ($errors as $error) {
        
                session()->flash('error', $error[0]);
            }
            return back();
        }
    }
}
