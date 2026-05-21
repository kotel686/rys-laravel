<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validates the public "nezávazná poptávka" contact form submission.
 */
class ContactRequest extends FormRequest
{
    /**
     * Anyone may submit the contact form.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules. The `website` field is a honeypot — bots tend to
     * fill every visible input, but legitimate users never see it and
     * leave it empty.
     *
     * @return array<string, array<int, mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:120'],
            'email' => ['required', 'email:rfc,dns', 'max:190'],
            'phone' => ['nullable', 'string', 'max:32', 'regex:/^[\d \+\-\(\)]{6,32}$/'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'website' => ['nullable', 'size:0'],
            'consent' => ['accepted'],
            'source' => ['nullable', 'string', 'in:vyskoveprace,lezeckastena'],
        ];
    }

    /**
     * Friendlier validation messages in Czech.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Vyplňte prosím jméno.',
            'email.required' => 'Vyplňte prosím e-mail.',
            'email.email' => 'Zadejte platný e-mail.',
            'message.required' => 'Napište prosím zprávu.',
            'message.min' => 'Zpráva je příliš krátká.',
            'phone.regex' => 'Telefon obsahuje nepovolené znaky.',
            'website.size' => 'Detekován spam.',
            'consent.accepted' => 'Pro odeslání musíte souhlasit se zpracováním osobních údajů.',
        ];
    }
}
